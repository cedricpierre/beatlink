<script setup lang="ts">
import {useStyleProps} from "@/Compasable/Variant.vue";

const model = defineModel()

const props = defineProps({
    ...useStyleProps(),
    modelValue: Boolean,
    label: String,
    name: String,
    required: Boolean,
    autofocus: Boolean,
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
        <label class="label cursor-pointer justify-start">
            <input
                v-model="model"
                class="radio"
                :name="props.name"
                @input="emits('update:modelValue', modelValue)"
                type="radio"
                :class="[...props.className, `checkbox-${props.variant}`]"
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
