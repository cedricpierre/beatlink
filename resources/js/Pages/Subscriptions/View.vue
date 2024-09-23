<script lang="ts" setup>
import {Link, usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Alert from "@/Components/Alert.vue";
import {IUser} from "@/Interfaces/User";

const user = usePage().props.auth?.user as IUser

</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2>Subscription</h2>
        </template>
        <template #actions>
            <Link as="Button" :href="route('dashboard')" class="ms-3">
                Go to dashboard
            </Link>
        </template>

        <div class="lg:max-w-screen-sm mx-auto">
            <Alert v-if="user.is_premium" variant="success">Congratulations ! You are now subscribed !</Alert>
            <Alert v-else>
                Your subscription is canceled. You need to subscribe to reactivate your campaigns.
                <template #action>
                    <Link :href="route('subscriptions.subscribe')">
                        <Button size="sm">Subscribe</Button>
                    </Link>
                </template>
            </Alert>
        </div>
    </AuthenticatedLayout>
</template>
