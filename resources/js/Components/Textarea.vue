<script setup lang="ts">
const model = defineModel()

const props = defineProps({
    label: String,
    name: String,
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    type: String,
    className: [Object, String],
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
            v-model="model"
            :name="props.name"
            :type="props.type"
            :class="props.className"
            :required="props.required"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
        />
        <div v-if="props.errorMessage" class="text-xs my-2" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
