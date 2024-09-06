<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import Card from "@/Components/Card.vue";
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Profile</h2>
        </template>

        <div class="py-12 container mx-auto w-1/2">
            <Card>
                <UpdateProfileInformationForm />
            </Card>
            <Card>
                <UpdatePasswordForm />
            </Card>

            <Card>
                <DeleteUserForm />
            </Card>
        </div>
    </AuthenticatedLayout>
</template>
