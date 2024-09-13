<script setup lang="ts">
import {useForm} from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Input from "@/Components/Input.vue";

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
            }
            if (form.errors.current_password) {
                form.reset('current_password');
            }
        },
    });
};
</script>

<template>
    <Card>
        <template #header>
            Update Password
        </template>

        <template #subtitle>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <Input
                label="Current password"
                v-model="form.current_password"
                type="password"
                autocomplete="current-password"
                :validation-status="form.errors.current_password ? 'error' : 'success'"
                :error-message="form.errors.current_password"
            />

            <Input
                label="New Password"
                v-model="form.password"
                type="password"
                :validation-status="form.errors.password ? 'error' : 'success'"
                :error-message="form.errors.password"
            />

            <Input
                label="Confirm Password"
                v-model="form.password_confirmation"
                type="password"
                :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                :error-message="form.errors.password_confirmation"
            />

            <div class="flex items-center gap-4">
                <Button variant="primary" :loading="form.processing" :disabled="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
