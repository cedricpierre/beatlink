<script setup lang="ts">
import {useVariant} from '@/Compasable/Variant.vue';

const variant = useVariant()

const props = defineProps({
    label: String,
    name: String,
    multiple: {
        type: Boolean,
        default: false,
    },
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    className: {
        type: String,
        default: null,
        required: false,
    },
    validationStatus: {
        type: String,
        validator(value: unknown): boolean {
            return ['error', 'success'].includes(value as string);
        }
    },
    errorMessage: String
})

const onFile = (event) => {
    emits('update:modelValue', props.multiple ? event.target.files : event.target.files[0])
}

const emits = defineEmits(['update:modelValue'])
</script>
<template>
    <div class="form-control">
        <div v-if="props.label" class="text-neutral-500 text-sm mb-2">{{ props.label }}</div>
        <input
            class="file-input input-bordered w-full"
            :name="props.name"
            :multiple="multiple"
            type="file"
            :class="`${props.className} input-${variant}`"
            :required="props.required"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
            placeholder="Click to select a file"
            @change="onFile"
        />
        <div v-if="props.errorMessage" class="text-xs my-2" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
