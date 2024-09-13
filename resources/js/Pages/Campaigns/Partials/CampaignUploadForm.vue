<script setup lang="ts">
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
        <form @submit.prevent="form.post(route('campaigns.upload', {campaign: props.campaign?.id}),{forceFormData: true, preserveScroll: true})"
              class="space-y-6">
            <div class="flex">
                <div v-if="props.campaign?.background_url">
                    <h2 class="mb-2 text-gray-400 dark:text-white">Background</h2>
                    <img :src="'/storage/'+props.campaign?.background_url" class="h-40 mb-4 rounded rounded-2xl" alt="">
                    <Link :href="route('campaigns.update', {campaign: props.campaign?.id})" :data="{background_url: null}" method="put"
                          preserve-scroll>
                        <Button variant="error" size="sm">Delete</button>
                    </Link>
                </div>
                <InputFile
                    v-else
                    v-model="form.background"
                    label="Background"
                    :validation-status="form.errors.background ? 'error' : 'success'"
                    :error-message="form.errors.background"
                />
            </div>
            <div class="flex">
                <div v-if="props.campaign?.image_url">
                    <h2 class="mb-2 text-gray-400 dark:text-white">Image</h2>
                    <img :src="'/storage/'+props.campaign?.image_url" class="h-40 mb-4 rounded rounded-2xl" alt="">
                    <Link class="btn btn-error btn-sm" :href="route('campaigns.update', {campaign: props.campaign?.id})" :data="{image_url: null}"
                          method="put" preserve-scroll>
                        Delete
                    </Link>
                </div>
                <InputFile
                    v-else
                    v-model="form.image"
                    label="Image"
                    :validation-status="form.errors.image ? 'error' : 'success'"
                    :error-message="form.errors.image"
                />
            </div>

            <div class="flex items-center gap-4">
                <Button variant="primary" :loading="form.processing" :disabled="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
