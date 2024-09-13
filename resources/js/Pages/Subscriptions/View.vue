<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Alert from "@/Components/Alert.vue";
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2>Subscription</h2>
        </template>
        <template #actions>
            <Link :href="route('dashboard')" class="btn btn-primary ms-3">
                Go to dashboard
            </Link>
        </template>

        <div class="lg:max-w-screen-sm mx-auto">
            <Alert v-if="$page.props.auth.user.is_premium" variant="success">Congratulations ! You are now subscribed !</Alert>
            <Alert variant="success" v-else>
                Your subscription is canceled. You need to upgrade your subscription.
                <template #action>
                    <Link class="btn btn-primary btn-sm" :href="route('subscriptions.edit')">Upgrade</Link>
                </template>
            </Alert>
        </div>
    </AuthenticatedLayout>
</template>
