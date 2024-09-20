<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";
import {ref, watch} from "vue";

const props = defineProps({
    ...useStyleProps(),
    variant: {
        type: String,
        required: false,
        default: 'primary'
    },
    size: {
        type: String,
        default: 'md',
    },
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
    <button
        :class="{
          ...props.className,
          ['!text-blue-950']: props.variant === 'light',
          [`bg-${props.variant}-500`]: props.variant,
          [`border-${props.variant}-500`]: props.variant,
          [`hover:bg-${props.variant}-700`]: props.variant,
          [`hover:border-${props.variant}-700`]: props.variant,
          [`focus:ring-${props.variant}-200`]: props.variant,
          [`disabled:border-${props.variant}-300`]: props.variant,
          [`disabled:bg-${props.variant}-300`]: props.variant,
          [`rounded-${props.rounded}`]: props.rounded,
          [`text-${props.size}`]: props.size,
        }"
        class="text-white border px-4 py-2 text-center font-medium shadow-sm transition-all focus:ring focus:ring-primary-200 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
    >
        <Loading :active="loading" variant="dots"></Loading>
        <slot></slot>
    </button>
</template>
