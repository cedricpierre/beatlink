<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import UpdateSubscriptionForm from "@/Pages/Subscriptions/Partials/UpdateSubscriptionForm.vue";
import CancelSubscriptionForm from "@/Pages/Subscriptions/Partials/CancelSubscriptionForm.vue";
import ResumeSubscriptionForm from "@/Pages/Subscriptions/Partials/ResumeSubscriptionForm.vue";

const props = defineProps({
    subscription: Object,
})
</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>Profile</h2>
        </template>
        <template #subtitle>
            <p>Edit your profile informations</p>
        </template>

        <div class="lg:max-w-screen-sm mx-auto space-y-6">
            <UpdateSubscriptionForm v-if="$page.props.auth.user.is_premium" :subscription="subscription"/>
            <CancelSubscriptionForm v-if="$page.props.auth.user.is_premium"/>
            <ResumeSubscriptionForm v-else/>
        </div>
    </AuthenticatedLayout>
</template>
