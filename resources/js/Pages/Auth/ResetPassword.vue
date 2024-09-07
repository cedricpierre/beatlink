<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {FwbButton, FwbInput} from "flowbite-vue";

const props = defineProps<{
    email: string;
    token: string;
}>();

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Reset Password"/>

        <form @submit.prevent="submit">
            <div>
                <fwb-input
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
            </div>

            <div class="mt-4">
                <fwb-input
                    type="password"
                    v-model="form.password"
                    required
                />
            </div>

            <div class="mt-4">
                <fwb-input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <fwb-button :loading="form.processing" :disabled="form.processing">
                    Reset Password
                </fwb-button>
            </div>
        </form>
    </GuestLayout>
</template>
