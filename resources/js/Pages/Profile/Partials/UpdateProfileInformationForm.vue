<script lang="ts" setup>
import {Link, useForm, usePage} from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Input from "@/Components/Input.vue";

const props = defineProps<{
    mustVerifyEmail?: Boolean;
    status?: String;
}>();

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
});
</script>

<template>
    <Card>
        <template #header>
            Profile Information
        </template>

        <form class="space-y-6" @submit.prevent="form.put(route('profile.update'))">

            <Input
                v-model="form.name"
                :error-message="form.errors.name"
                :validation-status="form.errors.name ? 'error' : 'success'"
                autocomplete="name"
                autofocus
                label="Name"
                required
                type="text"
            />

            <Input
                v-model="form.email"
                :error-message="form.errors.email"
                :validation-status="form.errors.email ? 'error' : 'success'"
                autocomplete="username"
                label="E-mail"
                required
                type="email"
            />

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-blue-800 dark:text-blue-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        as="button"
                        class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-blue-800"
                        method="post"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <Button variant="primary" :disabled="form.processing" :loading="form.processing">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
