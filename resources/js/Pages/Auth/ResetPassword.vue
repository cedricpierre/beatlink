<script lang="ts" setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";

const props = defineProps({
    email: String,
    token: String,
});

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
                <Input
                    v-model="form.email"
                    :error-message="form.errors.email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    autocomplete="email"
                    autofocus
                    required
                    type="email"
                />
            </div>

            <div class="mt-4">
                <Input
                    v-model="form.password"
                    :error-message="form.errors.password"
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    required
                    type="password"
                />
            </div>

            <div class="mt-4">
                <Input
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    :error-message="form.errors.password_confirmation"
                    :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                    required
                    type="password"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button :disabled="form.processing" :loading="form.processing" class="ms-3">
                    Reset Password
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
