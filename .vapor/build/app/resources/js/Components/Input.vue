<script setup lang="ts">
import {useStyleProps} from '@/Compasable/variant.js';
import Button from "@/Components/Button.vue";

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
                class="input input-bordered w-full"
                v-model="model"
                :min="props.min"
                :max="props.max"
                :maxlength="props.maxLength"
                :disabled="props.disabled"
                :placeholder="props.placeholder"
                :name="props.name"
                :type="props.type"
                :class="{
                  ...props.className,
                  [`input-${props.variant}`]: props.variant,
                  [`input-outline`]: props.outline,
                  [`input-${props.size}`]: props.size,
                }"
                :required="props.required"
                :autocomplete="props.autocomplete"
                :autofocus="props.autofocus"
            />
            <div v-if="props.loading" class="absolute h-full right-2 bottom-3 flex items-end">
                <Loading :active="props.loading" variant="ring" :class="[props.type === 'search' ? 'mr-8' : '']"></Loading>
            </div>
        </div>

        <div v-if="props.errorMessage" class="text-xs my-2" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
