<script setup lang="ts">
const props = defineProps({
    align: {
        type: String,
        default: 'left',
        validator(value: string) {
            return ['left', 'right'].includes(value)
        }
    }
})
</script>
<template>
    <details class="dropdown ">
        <summary class="text-primary-600">
            <slot name="trigger"></slot>
        </summary>
        <ul tabindex="0" :class="[`${align}-0`]" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow min-w-60">
            <slot></slot>
        </ul>
    </details>
</template>
