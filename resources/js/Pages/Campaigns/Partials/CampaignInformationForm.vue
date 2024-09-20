<script lang="ts" setup>

import {useForm} from "@inertiajs/vue3";
import {ICampaign} from "@/Interfaces/Campaign";
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Textarea from "@/Components/Textarea.vue";
import {PropType} from "vue";

const props = defineProps({
    campaign: Object as PropType<ICampaign>
})

const form = useForm({
    name: props.campaign?.name,
    slug: props.campaign?.slug,
    description: props.campaign?.description,
    is_dark: props.campaign?.is_dark,
})
</script>
<template>
    <Card>
        <template #header>
            General informations
        </template>
        <form class="space-y-6" @submit.prevent="$emit('save', form)">
            <Input
                v-model="form.name"
                :error-message="form.errors.name"
                :validation-status="form.errors.name ? 'error' : 'success'"
                label="Name"
            />

            <Textarea
                v-model="form.description"
                :error-message="form.errors.description"
                :validation-status="form.errors.description ? 'error' : 'success'"
                label="Description"
            />

            <Input
                v-model="form.slug"
                :error-message="form.errors.slug"
                :validation-status="form.errors.slug ? 'error' : 'success'"
                label="Slug"
            />

            <Checkbox
                v-model="form.is_dark"
                :error-message="form.errors.is_dark"
                :validation-status="form.errors.is_dark ? 'error' : 'success'"
                label="Dark mode"
            />


            <div class="flex items-center gap-4">
                <Button :disabled="form.processing" :loading="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
