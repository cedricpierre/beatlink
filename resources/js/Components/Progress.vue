<script setup lang="ts">
import {useStyleProps} from "@/Compasable/Variant.vue";


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
	<progress :class="[...props.className, `progress-${props.variant}`]" :max="props.max" :value="props.progress" class="progress w-full">
        <slot></slot>
    </progress>
</template>
