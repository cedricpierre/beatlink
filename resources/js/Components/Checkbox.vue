<script setup lang="ts">
import {useVariant} from "@/Compasable/Variant.vue";

const model = defineModel()
const variant = useVariant()

const props = defineProps({
    modelValue: Boolean,
    label: String,
    name: String,
    required: Boolean,
    autofocus: Boolean,
    type: String,
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

const emits = defineEmits(['update:modelValue'])

</script>
<template>
    <div class="form-control">
        <label class="label cursor-pointer justify-start">
            <input
                v-model="model"
                class="checkbox "
                :name="props.name"
                @input="emits('update:modelValue', modelValue)"
                type="checkbox"
                :class="`${props.className} checkbox-${variant}`"
                :required="props.required"
                :autofocus="props.autofocus"
            />
            <div v-if="props.label" class="text-neutral-500 text-sm ml-2 justify-items-start">{{ props.label }}</div>
        </label>
        <div v-if="props.errorMessage" class="text-xs my-2" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
