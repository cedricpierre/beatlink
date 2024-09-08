<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import {FwbButton, FwbInput} from "flowbite-vue";

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
                <fwb-input
                    v-model="form.name"
                    autocomplete="name"
                    autofocus
                    label="name"
                    required
                />
            </div>

            <div class="mt-4">
                <fwb-input
                    v-model="form.email"
                    label="Email"
                    required
                    type="email"
                />
            </div>

            <div class="mt-4">
                <fwb-input
                    v-model="form.password"
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    label="Password"
                    required
                    type="password"
                >
                    <template #validationMessage>
                        {{ form.errors.password }}
                    </template>
                </fwb-input>
            </div>

            <div class="mt-4">
                <fwb-input
                    label="Confirm Password"
                    v-model="form.password_confirmation"
                    :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                    required
                    type="password"
                >
                    <template #validationMessage>
                        {{ form.errors.password_confirmation }}
                    </template>
                </fwb-input>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-blue-800"
                >
                    Already registered?
                </Link>

                <fwb-button :disabled="form.processing" :loading="form.processing" class="ms-4">
                    Register
                </fwb-button>
            </div>
        </form>
    </GuestLayout>
</template>
