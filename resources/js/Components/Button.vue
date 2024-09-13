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

const loading = ref(false);

watch(() => props.loading, (value) => {
    if (value) {
        loading.value = true;
        setTimeout(() => {
            if (!props.loading) {
                loading.value = false;
            }
        }, 1000)
    }
})
</script>
<template>
    <button class="btn"
            :class="{
          ...props.className,
          [`btn-${props.variant}`]: props.variant,
          [`btn-outline`]: props.outline,
          [`btn-${props.size}`]: props.size,
        }"
    >
        <Loading :active="loading" variant="dots"></Loading>
        <slot></slot>
    </button>
</template>
