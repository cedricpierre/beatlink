<script setup lang="ts">
import {Link, useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import {FwbButton, FwbFileInput, FwbProgress} from "flowbite-vue";
import Saved from "@/Components/Saved.vue";

const props = defineProps<{
    campaign: ICampaign
}>()

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
        <form @submit.prevent="form.post(route('campaigns.upload', {campaign: campaign.id}),{forceFormData: true, preserveScroll: true})" class="space-y-6">
            <div class="flex">
                <div v-if="campaign.background_url">
                    <h2 class="mb-2 text-blue-600 dark:text-white">Background</h2>
                    <img :src="'/storage/'+campaign.background_url" class="w-60 mb-4 rounded rounded-2xl" alt="">
                    <Link :href="route('campaigns.update', {campaign: campaign.id})" :data="{background_url: null}" as="button" method="put" preserve-scroll>
                        <button class="btn btn-error btn-sm">Delete</button>
                    </Link>
                </div>
                <fwb-file-input
                    v-else
                    v-model="form.background"
                    label="Background"
                    :validation-status="form.errors.background ? 'error' : 'success'"
                >
                    <template #default>
                        <div class="text-red-600 dark:text-red-500 text-sm" v-if="form.errors.background">{{ form.errors.background }}</div>
                    </template>
                </fwb-file-input>
            </div>
            <div class="flex">
                <div v-if="campaign.image_url">
                    <h2 class="mb-2 text-blue-600 dark:text-white">Image</h2>
                    <img :src="'/storage/'+campaign.image_url" class="w-60 mb-4 rounded rounded-2xl" alt="">
                    <Link :href="route('campaigns.update', {campaign: campaign.id})" :data="{image_url: null}" as="button" method="put" preserve-scroll>
                        <button class="btn btn-error btn-sm">Delete</button>
                    </Link>
                </div>
                <fwb-file-input
                    v-else
                    v-model="form.image"
                    label="Image"
                    :validation-status="form.errors.image ? 'error' : 'success'"
                >
                    <template #default>
                        <div class="text-red-600 dark:text-red-500 text-sm" v-if="form.errors.image">{{ form.errors.image }}</div>
                    </template>
                </fwb-file-input>
            </div>

            <div class="flex items-center gap-4">
                <button class="btn btn-primary" :loading="form.processing" :disabled="form.processing">Save</button>

                <fwb-progress v-if="form.progress" :progress="form.progress.percentage">
                    {{ form.progress.percentage }}%
                </fwb-progress>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
