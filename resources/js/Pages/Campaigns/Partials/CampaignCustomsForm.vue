<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Textarea from "@/Components/Textarea.vue";

const props = defineProps<{
    campaign: ICampaign,
}>()

const form = useForm({
    custom_script: '',
    custom_css: '',
})

</script>
<template>
    <Card>
        <template #header>
            Customize your landing page
        </template>

        <template #subtitle>
            You can customize your landing page by adding javascript and css.
        </template>

        <form @submit.prevent="form.put(route('campaigns.update',{campaign: campaign?.id}))" class="space-y-6">
            <Textarea
                v-model="form.custom_script"
                label="Script"
                placeholder="Place your javascript script here"
                :validation-status="form.errors.custom_script ? 'error' : 'success'"
                :error-message="form.errors.custom_script"
            />

            <Textarea
                v-model="form.custom_css"
                label="CSS"
                placeholder="Place your CSS here"
                :validation-status="form.errors.custom_css ? 'error' : 'success'"
                :error-message="form.errors.custom_css"
            />


            <div class="flex items-center gap-4">
                <Button variant="primary" :loading="form.processing" :disabled="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
