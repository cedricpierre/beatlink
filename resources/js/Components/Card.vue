<template>
    <div class="w-full my-4 p-4 bg-white dark:bg-purple-800 dark:bg-opacity-10 shadow-md overflow-hidden sm:rounded-lg">
        <div class="" v-if="$slots.header">
            <slot name="header"></slot>
        </div>
        <slot></slot>
        <div class="" v-if="$slots.footer">

        </div>
    </div>
</template>
