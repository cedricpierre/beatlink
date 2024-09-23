<script lang="ts" setup>
import {Head} from '@inertiajs/vue3';
import GuestLayout from "@/Layouts/GuestLayout.vue";

const props = defineProps({
    message: String,
})
</script>

<template>
    <Head title="Error"/>
    <GuestLayout>

        <div class="container mx-auto lg:max-w-screen-lg">
            <div class="text-lg py-8 text-center">Awww snap ! An error occured...</div>
            <code>{{ message }}</code>
        </div>
    </GuestLayout>
</template>
