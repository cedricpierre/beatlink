<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import Input from "@/Components/Input.vue";

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
                <Input
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="email"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                    :error-message="form.errors.email"
                />
            </div>

            <div class="mt-4">
                <Input
                    type="password"
                    v-model="form.password"
                    required
                    :validation-status="form.errors.password ? 'error' : 'success'"
                    :error-message="form.errors.password"
                />
            </div>

            <div class="mt-4">
                <Input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                    :error-message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
	            <Button variant="primary" class="ms-3" :loading="form.processing" :disabled="form.processing">
                    Reset Password
                </button>
            </div>
        </form>
    </GuestLayout>
</template>
