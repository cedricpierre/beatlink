<script setup lang="ts">
import {types} from "sass-embedded";
import Number = types.Number;
import {useStyleProps} from "@/Compasable/Variant.vue";

const model = defineModel()

const props = defineProps({
	...useStyleProps(),
    label: String,
    progress: Number,
    max: {
        type: Number,
        default: 100,
    },
})

const emits = defineEmits(['update:modelValue'])
</script>
<template>
	<progress :class="[...props.className, `progress-${props.variant}`]" :max="props.max" :value="props.progress" class="progress w-full">
        <slot></slot>
    </progress>
</template>
