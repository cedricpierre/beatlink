<script setup lang="ts">
import {Link, useForm, usePage} from '@inertiajs/vue3';
import {FwbButton, FwbInput} from "flowbite-vue";
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";

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

	    <form @submit.prevent="form.put(route('profile.update'))" class="space-y-6">

            <fwb-input
                label="name"
                type="text"
                v-model="form.name"
                required
                autofocus
                autocomplete="name"
                :validation-status="form.errors.name ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{form.errors.name}}
                </template>
            </fwb-input>
            <fwb-input
                label="email"
                type="email"
                v-model="form.email"
                required
                autocomplete="username"
                :validation-status="form.errors.email ? 'error' : 'success'"
            >
                <template #validationMessage>
                    {{form.errors.email}}
                </template>
            </fwb-input>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-blue-800 dark:text-blue-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-blue-800"
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
	            <button class="btn btn-primary" :loading="form.processing" :disabled="form.processing">Save</button>

	            <Saved :form="form"/>
            </div>
        </form>
	</Card>
</template>
