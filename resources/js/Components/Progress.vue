<script lang="ts" setup>
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
        :class="{
                  ...props.className,
                  [`progress-${props.variant}`]: props.variant,
                  [`progress-${props.size}`]: props.size,
                }" :max="props.max" :value="props.progress"
        class="progress w-full"
    >
        <slot></slot>
    </progress>
</template>
