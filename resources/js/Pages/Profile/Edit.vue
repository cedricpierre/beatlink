<script lang="ts" setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import {Head, usePage} from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const props = defineProps({
    must_verify_email: Boolean,
    status: String,
})
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

        <div class="lg:max-w-screen-sm mx-auto space-y-6">
            <UpdateProfileInformationForm :must_verify_email="props.must_verify_email" :status="props.status" :user="user"/>
            <UpdatePasswordForm/>
            <DeleteUserForm/>
        </div>
    </AuthenticatedLayout>
</template>
