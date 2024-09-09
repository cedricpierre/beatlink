<script setup lang="ts">
import {useForm} from '@inertiajs/vue3';
import {ref} from 'vue';
import {FwbButton, FwbInput} from "flowbite-vue";
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";

const passwordInput = ref<HTMLInputElement | null>(null);
const currentPasswordInput = ref<HTMLInputElement | null>(null);

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
            <fwb-input
                label="Current password"
                ref="currentPasswordInput"
                v-model="form.current_password"
                type="password"
                autocomplete="current-password"
                :validation-status="form.errors.current_password ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{form.errors.current_password}}
                </template>
            </fwb-input>

            <fwb-input
                label="New Password"
                ref="passwordInput"
                v-model="form.password"
                type="password"
                :validation-status="form.errors.password ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{form.errors.password}}
                </template>
            </fwb-input>

            <fwb-input
                label="Confirm Password"
                v-model="form.password_confirmation"
                type="password"
                :validation-status="form.errors.password_confirmation ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{form.errors.password_confirmation}}
                </template>
            </fwb-input>

            <div class="flex items-center gap-4">
                <button class="btn btn-primary" :loading="form.processing" :disabled="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
