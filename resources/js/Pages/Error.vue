<script lang="ts" setup>
import {Head, Link} from '@inertiajs/vue3';
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
</script>

<template>
	<Head title="Error"/>
	<GuestLayout>

		<div class="container mx-auto lg:max-w-screen-lg">
			<div class="text-lg py-8 text-center">Awww snap ! An error occured...</div>
        </div>
	</GuestLayout>
</template>
