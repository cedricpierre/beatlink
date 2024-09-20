<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register"/>

        <form class="space-y-6" @submit.prevent="submit">
            <div>
                <Input
                    v-model="form.name"
                    :error-message="form.errors.name"
                    :validation-status="form.errors.name ? 'error' : 'success'"
                    autocomplete="name"
                    autofocus
                    label="name"
                    required
                />
            </div>

            <div>
                <Input
                    v-model="form.email"
                    :error-message="form.errors.email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    label="Email"
                    required
                    type="email"
                />
            </div>

            <div>
                <Input
                    v-model="form.password"
                    :error-message="form.errors.password"
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    label="Password"
                    required
                    type="password"
                />
            </div>

            <div>
                <Input
                    v-model="form.password_confirmation"
                    :error-message="form.errors.password_confirmation"
                    :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                    label="Confirm Password"
                    required
                    type="password"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-primary-800"
                >
                    Already registered?
                </Link>

                <Button :disabled="form.processing" :loading="form.processing" class="ms-3">
                    Register
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
