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
    <Card>
        <template #header>
            Subscription Information
        </template>

        <form class="space-y-6" @submit.prevent="form.put(route('subscriptions.update'))">
            <Input
                v-model="form.quantity"
                :error-message="form.errors.quantity"
                :max="999"
                :min="1"
                :validation-status="form.errors.quantity ? 'error' : 'success'"
                autocomplete="quantity"
                autofocus
                label="Quantity"
                required
                type="number"
            />

            <div class="flex items-center gap-4">
                <Button :disabled="form.processing" :loading="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
