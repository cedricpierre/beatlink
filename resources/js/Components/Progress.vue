<script setup lang="ts">
import {types} from "sass-embedded";
import Number = types.Number;

const model = defineModel()

const props = defineProps({
    label: String,
    progress: Number,
    max: {
        type: Number,
        default: 100,
    },
    className: {
        type: String,
        default: null,
        required: false,
    },
})

const emits = defineEmits(['update:modelValue'])
</script>
<template>
    <progress :class="props.className" :max="props.max" :value="props.progress" class="progress w-full">
        <slot></slot>
    </progress>
</template>
