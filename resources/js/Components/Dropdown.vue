<script lang="ts" setup>
import {ref} from "vue";

const props = defineProps({
    align: {
        type: String,
        default: null,
    }
})

const open = ref(false)
</script>
<template>
    <details class="dropdown" :class="{
        [`dropdown-${align}`] : props.align,
    }">
        <summary v-if="$slots.trigger" tabindex="0" role="button">
            <slot name="trigger"></slot>
        </summary>
        <ul tabindex="0"
            class="dropdown-content bg-white dark:bg-primary-800 text-primary-600 dark:text-white menu menu-vertical rounded-box z-[1] w-52 p-2 shadow-xl min-w-60">
            <slot></slot>
        </ul>
    </details>
</template>

<style scoped>
details > summary {
    list-style: none;
}
</style>
