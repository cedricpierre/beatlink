<script lang="ts" setup>

import {Link, router, useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import {computed, ComputedRef, onMounted, PropType, ref, watch} from "vue";
import Card from "@/Components/Card.vue";
import {IPlatform} from "@/Interfaces/Platform";
import Autocomplete from "@/Components/Autocomplete.vue";
import Modal from "@/Components/Modal.vue";
import Select from "@/Components/Select.vue";
import Alert from "@/Components/Alert.vue";
import {useAsset} from "@/Compasable/asset";

const asset = useAsset()

const lookup = ref('')

const props = defineProps({
    campaign: Object as PropType<ICampaign>,
    platforms: Array<IPlatform>,
})

const isAddingLink = ref(false)

const items = ref([])

const form = useForm({
    platform_id: null,
    url: null,
    name: null,
    type: null,
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
    return props.platforms?.find((p: IPlatform) => p.id === form.platform_id)
})

const loading = ref(false)

const search = async (lookup: string) => {
    if (selectedPlatform) {
        loading.value = true
        const url = route('platforms.search', {platform: selectedPlatform.value?.slug})
        const response = await fetch(`${url}?search=${lookup}`)
        const results = await response.json()

        items.value = []

        for (const key in results) {
            const obj = {
                name: key,
                children: results[key]
            } as never

            items.value.push(obj)
        }

        loading.value = false
    }
}

const onSelect = (event: any) => {
    console.log(event)
    form.url = event.url
    form.name = event.name
    form.type = event.type
}


onMounted(fetchPlatforms)

watch(isAddingLink, (value) => {
    if (value) {
        form.reset()
        fetchPlatforms()
    }
})

const columns = ref([
    {key: 'platform', name: 'Platform'},
    {key: 'name', name: 'name'},
    {key: 'type', name: 'type', align: 'center'},
    {key: 'views', name: 'Views', align: 'center'},
    {key: 'actions', name: '', align: 'right'},
])
</script>
<template>
    <Card>
        <template #header>
            Add links to your campaign
        </template>

	    <Table responsive v-if="props.campaign?.links.length" :columns="columns" :items="props.campaign?.links">

            <template #item.name="{item}">
	            <div class="whitespace-nowrap">
		            {{ item.name }}
	            </div>
            </template>

            <template #item.type="{item}">
                {{ item.type }}
            </template>

            <template #item.platform="{item}">
                <div class="flex items-center">
                    <img class="w-4 mr-2" :src="asset(item.platform?.icon)"/>
                    <span>{{ item.platform?.name }}</span>
                </div>
            </template>
            <template #item.views="{item}">
                <Badge>{{ item.leads_count }}</Badge>
            </template>
            <template #item.actions="{item}">
                <div class="space-x-2 whitespace-nowrap">
                    <a :href="item.url" target="_blank">
                        <Button size="sm">
                            Preview
                        </Button>
                    </a>
                    <Button variant="error" size="sm" :href="route('campaigns.links.destroy', {campaign: campaign?.id, link: item.id})"
                          method="delete"
                          preserve-scroll>
                        Delete
                    </Button>
                </div>
            </template>
        </Table>
        <Alert variant="warning" v-else>No links found</Alert>

        <div class="flex items-center gap-4 mt-4">
            <Button :disabled="form.processing" :loading="form.processing" @click="isAddingLink = true">Add link</button>

            <Transition
                enter-active-class="transition ease-in-out"
                enter-from-class="opacity-0"
                leave-active-class="transition ease-in-out"
                leave-to-class="opacity-0"
            >
                <p v-if="form.recentlySuccessful" class="text-sm text-primary-600 dark:text-primary-400">Saved.</p>
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
                            :error-message="form.errors.platform_id"
                            :options="props.platforms?.map((platform) => {
                                return {
                                    value: platform.id,
                                    text: platform.name,
                                }
                            })"
                            :validation-status="form.errors.platform_id ? 'error' : 'success'"
                        />

                        <Autocomplete
                            v-model="lookup"
                            :disabled="!form.platform_id"
                            :items="items"
                            :loading="loading"
                            @change="search"
                            @select="onSelect"
                            placeholder="Search artists, albums, playlist,..."
                        />
                    </div>
                </template>
                <template #footer>
                    <Button @click="isAddingLink = false">Cancel</button>
                    <Button :disabled="!lookup" :loading="form.processing" class="ms-3">
                        Save
                    </button>
                </template>
            </Modal>
        </form>
    </Card>
</template>
