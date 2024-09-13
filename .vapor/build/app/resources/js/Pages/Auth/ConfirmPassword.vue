<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password"/>

        <div class="mb-4 text-sm text-primary-600 dark:text-primary-400">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <Input
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    :error-message="form.errors.password"
                />
            </div>

            <div class="flex justify-end mt-4">
                <Button variant="primary" :loading="form.processing" :disabled="form.processing">
                    Confirm
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
