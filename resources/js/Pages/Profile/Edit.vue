<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head} from '@inertiajs/vue3';
</script>

<template>
    <Head title="Profile"/>

    <AuthenticatedLayout>
        <template #header>
            <h2>Profile</h2>
        </template>
        <template #subtitle>
            <p>Edit your profile informations</p>
        </template>

        <div class="container mx-auto lg:max-w-screen-sm">
            <UpdateProfileInformationForm class="mb-4"/>
            <UpdatePasswordForm class="mb-4"/>
            <DeleteUserForm class="mb-4"/>
        </div>
    </AuthenticatedLayout>
</template>
