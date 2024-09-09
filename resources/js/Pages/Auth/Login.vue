<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";
import Checkbox from "@/Components/Checkbox.vue";

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in"/>

        <form @submit.prevent="submit">
            <div>
                <Input
                    v-model="form.email"
                    label="Email"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    :error-message="form.errors.email"
                />

            </div>

            <div class="mt-4">
                <Input
                    v-model="form.password"
                    label="Password"
                    type="password"
                    required
                    autocomplete="current-password"
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    :error-message="form.errors.password"
                />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox
                        v-model="form.remember"
                        label="Remember me"
                        name="remember"
                    />
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('password.request')"
                    class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-blue-800"
                >
                    Forgot your password?
                </Link>

                <button class="btn btn-primary ms-3" :loading="form.processing" :disabled="form.processing">
                    Log in
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
