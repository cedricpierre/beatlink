<script setup lang="ts">

import {Link, router, useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import {computed, ComputedRef, onMounted, ref, watch} from "vue";
import Card from "@/Components/Card.vue";
import {FwbSelect, FwbTable, FwbTableBody, FwbTableCell, FwbTableHead, FwbTableHeadCell, FwbTableRow} from "flowbite-vue";
import {IPlatform} from "@/Interfaces/Platform";
import Autocomplete from "@/Components/Autocomplete.vue";
import Modal from "@/Components/Modal.vue";
import Input from "@/Components/Input.vue";

const props = defineProps<{
    campaign: ICampaign,
    platforms: Array<IPlatform>
}>()

const isAddingLink = ref(false)

const items = ref([])

const form = useForm({
    platform_id: null,
    url: 'https://',
})

const addLink = () => {
    form.post(route('campaigns.links.store', {id: props.campaign?.id}), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            isAddingLink.value = false;
        },
        onError: () => {
        },
    })
}

const fetchPlatforms = () => {
    router.reload({
        only: ['platforms'],
    })
}

const selectedPlatform: ComputedRef<IPlatform | undefined> = computed(() => {
    return props.platforms.find((p) => p.id === form.platform_id)
})

const search = async (lookup: string) => {
    const url = route('platforms.search', {platform: selectedPlatform.value?.slug})
    const response = await fetch(`${url}?search=${lookup}`)
    const results = await response.json()

    items.value = []

    for (const key in results) {
        const obj = {
            name: key,
            children: results[key]
        }

        items.value.push(obj)
    }
}


onMounted(fetchPlatforms)

watch(isAddingLink, (value) => {
    if (value) fetchPlatforms()
})

</script>
<template>
    <Card>
        <template #header>
            Add links to your campaign
        </template>

        <fwb-table v-if="campaign?.links.length" class="mb-4">
            <fwb-table-head>
                <fwb-table-head-cell></fwb-table-head-cell>
                <fwb-table-head-cell>Platform</fwb-table-head-cell>
                <fwb-table-head-cell>URL</fwb-table-head-cell>
                <fwb-table-head-cell>Views</fwb-table-head-cell>
                <fwb-table-head-cell class="w-4">Actions</fwb-table-head-cell>
            </fwb-table-head>
            <fwb-table-body>
                <fwb-table-row v-for="link in campaign?.links" :key="campaign.id">
                    <fwb-table-cell class="px-2">
                        <div class="w-4" v-html="link.platform?.icon"></div>
                    </fwb-table-cell>
                    <fwb-table-cell>{{ link.platform?.name }}</fwb-table-cell>
                    <fwb-table-cell :title="link.url">
                        <a class="text-blue-600" :href="link.url" target="_blank">open</a>
                    </fwb-table-cell>
                    <fwb-table-cell class="text-center">{{ link.leads_count }}</fwb-table-cell>
                    <fwb-table-cell class="w-4">
                        <Link :href="route('campaigns.links.destroy', {campaign: campaign?.id, link: link.id})" method="DELETE" as="button">
                            <button class="btn btn-error btn-sm">Delete</button>
                        </Link>
                    </fwb-table-cell>
                </fwb-table-row>
            </fwb-table-body>
        </fwb-table>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary" :loading="form.processing" @click="isAddingLink = true" :disabled="form.processing">Add link</button>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
            >
                <p v-if="form.recentlySuccessful" class="text-sm text-blue-600 dark:text-blue-400">Saved.</p>
            </Transition>
        </div>

        <form @submit.prevent="addLink">
            <Modal v-model="isAddingLink">
                <template #header>
                    <h2>
                        Add a link to your campaign
                    </h2>
                </template>
                <template #body>
                    <div class="space-y-6">
                        <fwb-select
                            v-model="form.platform_id"
                            :options="platforms.map((platform) => {
                            return {
                                value: platform.id,
                                name: platform.name,
                            }
                        })"
                            :validation-status="form.errors.platform_id ? 'error' : 'success'"
                        >
                            <template #validationMessage>
                                {{ form.errors.platform_id }}
                            </template>
                        </fwb-select>

                        <Autocomplete
                            :items="items"
                            :disabled="!form.platform_id"
                            @change="search"
                            @select="form.url = $event.url"
                        />

                        <Input
                            v-model="form.url"
                            :disabled="!form.platform_id"
                            label="URL"
                            placeholder="https://"
                            :validation-status="form.errors.url ? 'error' : 'success'"
                            :error-message="form.errors.url"
                        />
                    </div>
                </template>
                <template #footer>
                    <button class="btn btn-secondary" @click="isAddingLink = false">Cancel</button>
                    <button class="btn btn-primary ms-3" :loading="form.processing">
                        Save
                    </button>
                </template>
            </Modal>
        </form>
    </Card>
</template>
