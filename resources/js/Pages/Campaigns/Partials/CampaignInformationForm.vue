<script setup lang="ts">

import {useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import {FwbButton, FwbCheckbox, FwbInput} from "flowbite-vue";
import Saved from "@/Components/Saved.vue";

const props = defineProps<{
    campaign: ICampaign
}>()

const form = useForm({
    name: props.campaign?.name,
    slug: props.campaign?.slug,
    is_dark: props.campaign?.is_dark,
})
</script>
<template>
    <Card>
        <template #header>
            General informations
        </template>
        <form @submit.prevent="$emit('save', form)" class="space-y-6">
            <fwb-input
                v-model="form.name"
                label="Name"
                :validation-status="form.errors.name ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{ form.errors.name }}
                </template>
            </fwb-input>

            <fwb-input
                v-model="form.slug"
                label="Slug"
                :validation-status="form.errors.slug ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{ form.errors.slug }}
                </template>
            </fwb-input>

            <fwb-checkbox
                v-model="form.is_dark"
                label="Dark mode"
                :validation-status="form.errors.is_dark ? 'error' : 'success'"
            >
            </fwb-checkbox>


            <div class="flex items-center gap-4">
                <button class="btn btn-primary" :loading="form.processing" :disabled="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
