<script lang="ts" setup>
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

        <form class="mt-6 space-y-6" @submit.prevent="updatePassword">
            <Input
                v-model="form.current_password"
                :error-message="form.errors.current_password"
                :validation-status="form.errors.current_password ? 'error' : 'success'"
                autocomplete="current-password"
                label="Current password"
                type="password"
            />

            <Input
                v-model="form.password"
                :error-message="form.errors.password"
                :validation-status="form.errors.password ? 'error' : 'success'"
                label="New Password"
                type="password"
            />

            <Input
                v-model="form.password_confirmation"
                :error-message="form.errors.password_confirmation"
                :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
                label="Confirm Password"
                type="password"
            />

            <div class="flex items-center gap-4">
                <Button :disabled="form.processing" :loading="form.processing" variant="primary">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
