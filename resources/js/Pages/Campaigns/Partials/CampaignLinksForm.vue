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

const columns = ref([
    {key: 'icon', name: 'Icon'},
    {key: 'platform', name: 'Platform'},
    {key: 'url', name: 'Url'},
    {key: 'views', name: 'Views', align: 'center'},
    {key: 'actions', name: '', align: 'right'},
])
</script>
<template>
    <Card>
        <template #header>
            Add links to your campaign
        </template>

        <Table :columns="columns" :items="props.campaign?.links">
            <template #item.icon="{item}">
                <div class="w-4" v-html="item.platform?.icon"></div>
            </template>
            <template #item.url="{item}">
                <a class="text-blue-600" :href="item.url" target="_blank">open</a>
            </template>
            <template #item.platform="{item}">
                <Badge>{{ item.platform?.name }}</Badge>
            </template>
            <template #item.views="{item}">
                <Badge>{{ item.leads_count }}</Badge>
            </template>
            <template #item.actions="{item}">
                <Link class="btn btn-error btn-sm" :href="route('campaigns.links.destroy', {campaign: campaign?.id, link: item.id})" method="DELETE"
                      as="button"
                      preserve-scroll>
                    Delete
                </Link>
            </template>
        </Table>

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
                    <Button @click="isAddingLink = false">Cancel</button>
                    <Button variant="primary" class="ms-3" :loading="form.processing">
                        Save
                    </button>
                </template>
            </Modal>
        </form>
    </Card>
</template>
