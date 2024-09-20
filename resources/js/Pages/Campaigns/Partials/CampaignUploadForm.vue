<script lang="ts" setup>
import {Link, useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import InputFile from "@/Components/InputFile.vue";
import {PropType} from "vue";

const props = defineProps({
    campaign: Object as PropType<ICampaign>
})

const form = useForm({
    background: null,
    image: null,
})
</script>
<template>
    <Card>
        <template #header>
            Upload image
        </template>
        <form class="space-y-6"
              @submit.prevent="form.post(route('campaigns.upload', {campaign: props.campaign?.id}),{forceFormData: true, preserveScroll: true})">
            <Alert variant="error">
                Maximum file size is 4096Ko.
            </Alert>
            <div class="flex">
                <div v-if="props.campaign?.background_url">
                    <h2 class="mb-2 text-gray-400 dark:text-white">Background</h2>
                    <img :src="props.campaign?.background_url" alt="" class="h-40 mb-4 rounded rounded-2xl">
                    <Link as="button" :data="{background_url: null}" :href="route('campaigns.update', {campaign: props.campaign?.id})" method="put"
                          preserve-scroll>
                        <Button size="sm" variant="error">Delete</button>
                    </Link>
                </div>
                <InputFile
                    v-else
                    v-model="form.background"
                    :error-message="form.errors.background"
                    :validation-status="form.errors.background ? 'error' : 'success'"
                    label="Background"
                />
            </div>
            <div class="flex">
                <div v-if="props.campaign?.image_url">
                    <h2 class="mb-2 text-gray-400 dark:text-white">Image</h2>
                    <img :src="props.campaign?.image_url" alt="" class="h-40 mb-4 rounded rounded-2xl">
                    <Link :data="{image_url: null}" :href="route('campaigns.update', {campaign: props.campaign?.id})"
                          method="put" preserve-scroll>
                        <Button variant="error" size="sm">Delete</Button>
                    </Link>
                </div>
                <InputFile
                    v-else
                    v-model="form.image"
                    :error-message="form.errors.image"
                    :validation-status="form.errors.image ? 'error' : 'success'"
                    label="Image"
                />
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="form.processing" :loading="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
