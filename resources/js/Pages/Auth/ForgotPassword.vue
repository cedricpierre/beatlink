<script lang="ts" setup>
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

        <div class="mb-4 text-sm text-primary-600 dark:text-primary-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <form @submit.prevent="submit">
            <div>
                <Input
                    v-model="form.email"
                    :error-message="form.errors.email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    autocomplete="username"
                    autofocus
                    required
                    type="email"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button :disabled="form.processing" :loading="form.processing" variant="primary">
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
