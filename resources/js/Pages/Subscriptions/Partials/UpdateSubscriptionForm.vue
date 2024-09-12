<script lang="ts" setup>
import {useForm} from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Input from "@/Components/Input.vue";

const props = defineProps({
    subscription: Object,
})

const form = useForm({
    quantity: props.subscription?.quantity,
});
</script>

<template>

    <Alert v-if="$page.props.auth.user.is_premium">
        You have an active subscription.
    </Alert>

    <Card>
        <template #header>
            Subscription Information
        </template>

        <form class="space-y-6" @submit.prevent="form.put(route('subscriptions.update'))">
            <Input
                v-model="form.quantity"
                autocomplete="quantity"
                autofocus
                label="Quantity"
                required
                type="number"
                :min="1"
                :max="999"
                :error-message="form.errors.quantity"
                :validation-status="form.errors.quantity ? 'error' : 'success'"
            />

            <div class="flex items-center gap-4">
                <Button variant="primary" :disabled="form.processing" :loading="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
