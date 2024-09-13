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
        <div v-if="props.label" class="text-neutral-500 text-sm mb-2">{{ props.label }}</div>
        <div class="relative">
            <input
                v-model="model"
                :autocomplete="props.autocomplete"
                :autofocus="props.autofocus"
                :class="{
                  ...props.className,
                  [`input-${props.variant}`]: props.variant,
                  [`input-outline`]: props.outline,
                  [`input-${props.size}`]: props.size,
                }"
                :disabled="props.disabled"
                :max="props.max"
                :maxlength="props.maxLength"
                :min="props.min"
                :name="props.name"
                :placeholder="props.placeholder"
                :required="props.required"
                :type="props.type"
                class="input input-bordered w-full"
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
