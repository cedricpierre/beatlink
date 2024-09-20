<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel()

const props = defineProps({
    ...useStyleProps(),
    modelValue: Boolean,
    label: String,
    name: String,
    required: Boolean,
    autofocus: Boolean,
    type: String,
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

const emits = defineEmits(['update:modelValue'])

</script>
<template>
    <div class="form-control">
        <label class="flex items-center space-x-2">
            <input
                v-model="model"
                :autofocus="props.autofocus"
                :class="{
                  ...props.className,
                  [`text-${props.variant}-600`]: props.variant,
                  [`focus:border-${props.variant}-300`]: props.variant,
                  [`focus:ring-${props.variant}-200`]: props.variant,
                  'border-red-300': props.validationStatus === 'error',
                }"
                class="h-4 w-4 rounded-full border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 focus:ring-offset-0 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                :disabled="props.disabled"
                :name="props.name"
                :required="props.required"
                type="radio"
                @input="emits('update:modelValue', modelValue)"
            />
            <Label v-if="props.label">{{ props.label }}</Label>
        </label>
        <div v-if="props.errorMessage" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }" class="text-xs my-2">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
