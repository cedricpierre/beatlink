<script lang="ts" setup>
import {Link, useForm} from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
import Saved from "@/Components/Saved.vue";
import Input from "@/Components/Input.vue";

const props = defineProps({
    user: Object,
    must_verify_email: Boolean,
    status: String,
});

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
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

            <div v-if="props.must_verify_email && props.user?.email_verified_at === null">
                <p class="text-sm mt-2 text-primary-800 dark:text-primary-200">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        class="underline text-sm text-primary-600 dark:text-primary-400 hover:text-primary-900 dark:hover:text-primary-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-primary-800"
                        method="post"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="props.status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <Button :disabled="form.processing" :loading="form.processing" variant="primary">Save</button>

                <Saved :form="form"/>
            </div>
        </form>
    </Card>
</template>
