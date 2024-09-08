<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import {FwbButton, FwbInput} from "flowbite-vue";

const props = defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password"/>

        <div class="mb-4 text-sm text-blue-600 dark:text-blue-400">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset
            link that will allow you to choose a new one.
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <fwb-input
                    type="email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    :validation-status="form.errors.email ? 'error' : 'success'"
                >
                    <template #validationMessage>
                        {{ form.errors.email }}
                    </template>
                </fwb-input>
            </div>

            <div class="flex items-center justify-end mt-4">
                <fwb-button :loading="form.processing" :disabled="form.processing">
                    Email Password Reset Link
                </fwb-button>
            </div>
        </form>
    </GuestLayout>
</template>
