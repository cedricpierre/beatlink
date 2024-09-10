<script setup lang="ts">

import {useStyleProps} from "@/Compasable/variant.js";
import {ref, watch} from "vue";

const props = defineProps({
    ...useStyleProps(),
    loading: {
        type: Boolean,
        default: false,
    },
})

const isLoading = ref(false);

watch(() => props.loading, (value) => {
    if (value) {
        isLoading.value = true;
        setTimeout(() => {
            if (!props.loading) {
                isLoading.value = false;
            }
        }, 1000)
    }
})
</script>
<template>
    <button class="btn" :class="[...props.className, `btn-${props.variant}`, `btn-${props.size}`]">
        <span v-if="loading" class="loading loading-spinner" :class="[`loading-${props.size}`]"></span>
        <slot></slot>
    </button>
</template>
