<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import UpdateSubscriptionForm from "@/Pages/Subscriptions/Partials/UpdateSubscriptionForm.vue";
import CancelSubscriptionForm from "@/Pages/Subscriptions/Partials/CancelSubscriptionForm.vue";
import ResumeSubscriptionForm from "@/Pages/Subscriptions/Partials/ResumeSubscriptionForm.vue";
import Alert from "@/Components/Alert.vue";

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
            <Alert variant="success" v-if="$page.props.auth.user?.is_premium">
                You have an active subscription.
            </Alert>

            <Alert variant="warning" v-if="$page.props.auth.user?.campaigns_count >= subscription.quantity">
                You need to upgrade your account to continue creating new campaigns.
            </Alert>


            <UpdateSubscriptionForm v-if="$page.props.auth.user?.is_premium" :subscription="subscription"/>
            <CancelSubscriptionForm v-if="$page.props.auth.user?.is_premium"/>
            <ResumeSubscriptionForm v-else/>
        </div>
    </AuthenticatedLayout>
</template>
