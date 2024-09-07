<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import BCard from "@/Components/BCard.vue";
import {FwbButton, FwbTextarea} from "flowbite-vue";
import Saved from "@/Components/Saved.vue";

const props = defineProps<{
    campaign: ICampaign,
}>()

const form = useForm({
    custom_script: '',
    custom_css: '',
})

</script>
<template>
    <BCard>
        <template #header>
            Customize your landing page
        </template>

        <template #subtitle>
            You can customize your landing page by adding javascript and css.
        </template>

        <form @submit.prevent="form.put(route('campaigns.update',{campaign: campaign?.id}))" class="space-y-6">
            <fwb-textarea
                v-model="form.custom_script"
                label="Script"
                placeholder="Place your javascript script here"
                :validation-status="form.errors.custom_script ? 'error' : 'success'"
            >
            </fwb-textarea>

            <fwb-textarea
                v-model="form.custom_css"
                label="CSS"
                placeholder="Place your CSS here"
                :validation-status="form.errors.custom_css ? 'error' : 'success'"
            >
            </fwb-textarea>


            <div class="flex items-center gap-4">
                <fwb-button :loading="form.processing" :disabled="form.processing">Save</fwb-button>

                <Saved :form="form"/>
            </div>
        </form>
    </BCard>
</template>
