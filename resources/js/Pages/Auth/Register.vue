<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";

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

        <form @submit.prevent="submit">
            <div>
                <Input
                    v-model="form.name"
                    autocomplete="name"
                    autofocus
                    label="name"
                    required
                    :validation-status="form.errors.name ? 'error' : 'success'"
                    :error-message="form.errors.name"
                />
            </div>

            <div class="mt-4">
                <Input
                    v-model="form.email"
                    label="Email"
                    required
                    type="email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    :error-message="form.errors.email"
                />
            </div>

            <div class="mt-4">
                <Input
                    v-model="form.password"
                    label="Password"
                    required
                    type="password"
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    :error-message="form.errors.password"
                />
            </div>

            <div class="mt-4">
                <Input
                    label="Confirm Password"
                    v-model="form.password_confirmation"
                    required
                    type="password"
                    :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                    :error-message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-blue-800"
                >
                    Already registered?
                </Link>

                <button class="btn btn-primary ms-3" :disabled="form.processing" :loading="form.processing">
                    Register
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
