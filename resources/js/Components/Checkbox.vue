<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel<boolean | string | null>()

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
        <label class="label cursor-pointer justify-start">
            <input
                v-model="model"
                :autofocus="props.autofocus"
                :class="{
                  ...props.className,
                  [`checkbox-${props.variant}`]: props.variant,
                  [`checkbox-${props.size}`]: props.size,
                }"
                :disabled="props.disabled"
                :name="props.name"
                :required="props.required"
                class="checkbox "
                type="checkbox"
                @input="emits('update:modelValue', modelValue)"
            />
            <div v-if="props.label" class="text-neutral-500 text-sm ml-2 justify-items-start">{{ props.label }}</div>
        </label>
        <div v-if="props.errorMessage" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }" class="text-xs my-2">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
