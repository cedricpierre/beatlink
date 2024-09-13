<template>
    <div class="dark:bg-primary-950 dark:bg-opacity-30 bg-white shadow rounded-2xl py-6 px-4 overflow-auto sm:w-full">

        <h2 v-if="$slots.header" class="text-xl font-medium text-primary-900 dark:text-primary-100 py-2">
            <slot name="header"></slot>
        </h2>

        <div v-if="$slots.subtitle" class="py-2 text-sm text-gray-600 dark:text-gray-400">
            <slot name="subtitle"></slot>
        </div>

        <div class="space-y-6">
            <slot></slot>
        </div>
        <div v-if="$slots.actions" class="mt-4 pt-4 border-t-2 border-t-gray-200 dark:border-t-gray-900 flex justify-end items-center">
            <slot name="actions"></slot>
        </div>
    </div>
</template>
<script lang="ts" setup>
</script>
