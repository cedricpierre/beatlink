<script lang="ts" setup>

import {useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Textarea from "@/Components/Textarea.vue";
import {PropType} from "vue";

const props = defineProps({
    campaign: Object as PropType<ICampaign>
})

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

        <form class="space-y-6" @submit.prevent="form.put(route('campaigns.update',{campaign: props.campaign?.id}))">
            <Textarea
                v-model="form.custom_script"
                :error-message="form.errors.custom_script"
                :validation-status="form.errors.custom_script ? 'error' : 'success'"
                label="Script"
                placeholder="Place your javascript script here"
            />

            <Textarea
                v-model="form.custom_css"
                :error-message="form.errors.custom_css"
                :validation-status="form.errors.custom_css ? 'error' : 'success'"
                label="CSS"
                placeholder="Place your CSS here"
            />


            <div class="flex items-center gap-4">
                <Button :disabled="form.processing" :loading="form.processing" variant="primary">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
