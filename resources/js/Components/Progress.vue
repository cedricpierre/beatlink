<script setup lang="ts">
import {useStyleProps} from "@/Compasable/variant.js";


const props = defineProps({
    ...useStyleProps(),
    label: String,
    progress: Number,
    max: {
        type: Number,
        default: 100,
    },
})

</script>
<template>
    <progress
        :max="props.max" :value="props.progress" class="progress w-full"
        :class="{
                  ...props.className,
                  [`progress-${props.variant}`]: props.variant,
                  [`progress-${props.size}`]: props.size,
                }"
    >
        <slot></slot>
    </progress>
</template>
