<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel<string | null>()

const props = defineProps({
    ...useStyleProps(),
    label: String,
    name: String,
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    type: String,
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
        <textarea
            v-model="model"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
            :class="{
                  ...props.className,
                  [`textarea-${props.variant}`]: props.variant,
                  [`textarea-${props.size}`]: props.size,
                }"
            :name="props.name"
            :required="props.required"
            :type="props.type"
            class="textarea textarea-bordered w-full"
        >
        </textarea>
        <div v-if="props.errorMessage" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }" class="text-xs my-2">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
