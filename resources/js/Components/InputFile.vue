<script lang="ts" setup>
import {useStyleProps} from '@/Compasable/variant.js';
import Input from "@/Components/Input.vue";

const props = defineProps({
    ...useStyleProps(),
    label: String,
    name: String,
    multiple: {
        type: Boolean,
        default: false,
    },
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    disabled: {
        type: Boolean,
        default: false,
    },
    validationStatus: {
        type: String,
        validator(value: unknown): boolean {
            return ['error', 'success'].includes(value as string);
        }
    },
    errorMessage: String
})

const onFile = (event: InputEvent | any) => {
    emits('update:modelValue', props.multiple ? event.target?.files : event.target?.files[0])
}

const emits = defineEmits(['update:modelValue'])
</script>
<template>
    <div class="form-control">
        <Label v-if="props.label">{{ props.label }}</Label>
        <input
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
            :class="{
                  ...props.className,
                  [`file:bg-${props.variant}-500`]: props.variant,
                  [`hover:file:bg-${props.variant}-700`]: props.variant,
                  [`focus:border-${props.variant}-400`]: props.variant,
                  [`focus:ring-${props.variant}-200`]: props.variant,
                  [`text-${props.size}`]: props.size,
                  'border-red-300': props.validationStatus === 'error',
                }"
            class="block w-full text-sm file:mr-4 file:rounded-md file:border-0 file:py-2.5 file:px-4 file:text-sm file:font-semibold file:text-white focus:outline-none disabled:pointer-events-none disabled:opacity-60"
            :disabled="props.disabled"
            :multiple="props.multiple"
            :name="props.name"
            :required="props.required"
            placeholder="Click to select a file"
            type="file"
            @change="onFile"
        />
        <div v-if="props.errorMessage" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }" class="text-xs my-2">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
