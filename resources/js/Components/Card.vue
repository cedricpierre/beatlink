<template>
    <div class="dark:bg-blue-950 dark:bg-opacity-30 bg-white shadow rounded-2xl py-6 px-4 overflow-auto mx-2 sm:w-full">

        <h2 v-if="$slots.header" class="text-lg font-medium text-blue-900 dark:text-blue-100">
            <slot name="header"></slot>
        </h2>
        <div v-if="$slots.subtitle" class="mt-1 text-sm text-blue-600 dark:text-blue-400">
            <slot name="subtitle"></slot>
        </div>
        <div class="my-4">
            <slot></slot>
        </div>
    </div>
</template>
