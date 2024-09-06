<script setup lang="ts">
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    href: string;
    active?: boolean;
}>();

const classes = computed(() =>
    props.active
        ?
        'block w-full ps-3 pe-4 py-2 border-l-4 border-purple-400 dark:border-purple-600 text-start text-base font-medium text-purple-700 dark:text-purple-300 bg-purple-50 dark:bg-purple-900/50 focus:outline-none focus:text-purple-800 dark:focus:text-purple-200 focus:bg-purple-100 dark:focus:bg-purple-900 focus:border-purple-700 dark:focus:border-purple-300 transition duration-150 ease-in-out'
        : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-purple-600 dark:text-purple-400 hover:text-purple-800 dark:hover:text-purple-200 hover:bg-purple-50 dark:hover:bg-purple-700 hover:border-purple-300 dark:hover:border-purple-600 focus:outline-none focus:text-purple-800 dark:focus:text-purple-200 focus:bg-purple-50 dark:focus:bg-purple-700 focus:border-purple-300 dark:focus:border-purple-600 transition duration-150 ease-in-out'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
