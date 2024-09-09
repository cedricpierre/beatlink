<script setup lang="ts">

import {Link, router, useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import {computed, ComputedRef, onMounted, ref, watch} from "vue";
import Card from "@/Components/Card.vue";
import {IPlatform} from "@/Interfaces/Platform";
import Autocomplete from "@/Components/Autocomplete.vue";
import Modal from "@/Components/Modal.vue";
import Input from "@/Components/Input.vue";
import Select from "@/Components/Select.vue";

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
    if (selectedPlatform) {
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

        <table v-if="campaign?.links.length" class="table mb-4">
            <thead>
            <th></th>
            <th>Platform</th>
            <th>URL</th>
            <th>Views</th>
            <th class="w-4">Actions</th>
            </thead>
            <tbody>
            <tr v-for="link in campaign?.links" :key="campaign.id">
                <td class="px-2">
                    <div class="w-4" v-html="link.platform?.icon"></div>
                </td>
                <td>{{ link.platform?.name }}</td>
                <td :title="link.url">
                    <a class="text-blue-600" :href="link.url" target="_blank">open</a>
                </td>
                <td class="text-center">{{ link.leads_count }}</td>
                <td class="w-4">
                    <Link class="btn btn-error btn-sm" :href="route('campaigns.links.destroy', {campaign: campaign?.id, link: link.id})" method="DELETE"
                          as="button"
                          preserve-scroll>
                        Delete
                    </Link>
                </td>
            </tr>
            </tbody>
        </table>

        <div class="flex items-center gap-4">
            <Button variant="primary" :loading="form.processing" @click="isAddingLink = true" :disabled="form.processing">Add link</button>

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
                        <Select
                            v-model="form.platform_id"
                            :options="platforms.map((platform) => {
                                return {
                                    value: platform.id,
                                    text: platform.name,
                                }
                            })"
                            :validation-status="form.errors.platform_id ? 'error' : 'success'"
                            :error-message="form.errors.platform_id"
                        />

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
                    <Button variant="neutral" @click="isAddingLink = false">Cancel</button>
                    <Button variant="primary" class="ms-3" :loading="form.processing">
                        Save
                    </button>
                </template>
            </Modal>
        </form>
    </Card>
</template>
