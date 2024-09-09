<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password"/>

        <div class="mb-4 text-sm text-blue-600 dark:text-blue-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <form @submit.prevent="submit">
            <div>
                <Input
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    :error-message="form.errors.email"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button variant="primary" :loading="form.processing" :disabled="form.processing">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
