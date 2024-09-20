<script lang="ts" setup>
import {useStyleProps} from '@/Compasable/variant.js';

const model = defineModel()

const props = defineProps({
    ...useStyleProps(),
    loading: Boolean,
    placeholder: String,
    label: String,
    name: String,
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    type: String,
    min: Number,
    max: Number,
    maxLength: Number,
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
        <Label v-if="props.label">{{ props.label }}</Label>
        <div class="relative">
            <input
                v-model="model"
                :autocomplete="props.autocomplete"
                :autofocus="props.autofocus"
                :class="{
                  ...props.className,
                  [`focus:border-${props.variant}-400`]: props.variant,
                  [`focus:ring-${props.variant}-200`]: props.variant,
                  [`text-${props.size}`]: props.size,
                  'border-red-300': props.validationStatus === 'error',
                }"
                class="block w-full rounded-md border border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
                :disabled="props.disabled"
                :max="props.max"
                :maxlength="props.maxLength"
                :min="props.min"
                :name="props.name"
                :placeholder="props.placeholder"
                :required="props.required"
                :type="props.type"
            />
            <div v-if="props.loading" class="absolute h-full right-2 bottom-3 flex items-end">
                <Loading :active="props.loading" :class="[props.type === 'search' ? 'mr-8' : '']" variant="ring"></Loading>
            </div>
        </div>

        <div v-if="props.errorMessage" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }" class="text-xs my-2">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
