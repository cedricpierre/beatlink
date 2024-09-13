<script setup lang="ts">
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel()

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
            class="textarea textarea-bordered w-full"
            :name="props.name"
            :type="props.type"
            :class="{
                  ...props.className,
                  [`textarea-${props.variant}`]: props.variant,
                  [`textarea-${props.size}`]: props.size,
                }"
            :required="props.required"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
        >
            {{model}}
        </textarea>
        <div v-if="props.errorMessage" class="text-xs my-2" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
