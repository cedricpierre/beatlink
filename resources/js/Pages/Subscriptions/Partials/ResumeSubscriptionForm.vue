<script lang="ts" setup>
import Card from "@/Components/Card.vue";
import {Link, usePage} from "@inertiajs/vue3";
import {IUser} from "@/Interfaces/User";

const user = usePage().props.auth.user as IUser

</script>

<template>
    <Card>
        <template #header>
            Resume subscription
        </template>

        <template #subtitle>
            <template v-if="user.is_on_grace_period">
                By resuming your subscription, you will reactive all your campaigns.
            </template>
            <template v-else>
                Your grace period has ended. You must start a new subscription.
            </template>
        </template>

        <Link v-if="user.is_on_grace_period" :href="route('subscriptions.resume')" method="post">
            <Button variant="success">
                Resume subscription
            </Button>
        </Link>

        <Link v-else :href="route('subscriptions.subscribe')">
            <Button variant="success">Start a new subscription</Button>
        </Link>

    </Card>
</template>
