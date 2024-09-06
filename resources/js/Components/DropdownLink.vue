<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    href: string;
}>();
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-purple-700 dark:text-purple-300 hover:bg-purple-100 dark:hover:bg-purple-800 focus:outline-none focus:bg-purple-100 dark:focus:bg-purple-800 transition duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>
