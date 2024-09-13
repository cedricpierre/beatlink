<script lang="ts" setup>
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

        <form class="space-y-6" @submit.prevent="submit">
            <div>
                <Input
                    v-model="form.email"
                    :error-message="form.errors.email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    autocomplete="email"
                    autofocus
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
                    autocomplete="current-password"
                    label="Password"
                    required
                    type="password"
                />
            </div>

            <div>
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
                    class="underline text-sm text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-primary-800"
                >
                    Forgot your password?
                </Link>

                <Button :disabled="form.processing" :loading="form.processing" class="ms-3" variant="primary">
                    Log in
                </Button>
            </div>
        </form>
    </GuestLayout>
</template>
