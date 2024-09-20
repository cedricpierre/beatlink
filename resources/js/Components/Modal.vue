<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel<boolean>();

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div v-if="model" class="fixed inset-0 z-10 bg-secondary-700/50" @click="model = false"></div>
    <div v-if="model" :class="[...props.className]" class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-0">
        <div class="mx-auto overflow-hidden rounded-lg bg-white shadow-xl sm:w-full sm:max-w-xl">
            <div class="relative p-6">
                <button type="button" @click="model = false"
                        class="absolute top-4 right-4 rounded-lg p-1 text-center font-medium text-secondary-500 transition-all hover:bg-secondary-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-6 w-6">
                        <path
                            d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z"></path>
                    </svg>
                </button>


                <div v-if="$slots.header" class="text-lg font-medium text-secondary-900">
                    <slot name="header"></slot>
                </div>
                <div v-if="$slots.body" class="mt-2 text-sm text-secondary-500">
                    <slot name="body"></slot>
                </div>
            </div>
            <div v-if="$slots.footer" class="flex justify-end gap-3 bg-secondary-50 px-6 py-3">
                <slot name="footer"></slot>
            </div>
        </div>
    </div>
</template>
