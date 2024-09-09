<script setup lang="ts">
const model = defineModel()

const props = defineProps({
    label: String,
    name: String,
    options: Array,
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    type: String,
    textKey: {
        type: String,
        default: 'text',
    },
    valueKey: {
        type: String,
        default: 'value',
    },
    className: [Object, String],
    validationStatus: {
        type: String,
        validator(value: unknown): boolean {
            return ['error', 'success'].includes(value as string);
        }
    },
    errorMessage: String
})

</script>
<template>
    <div class="form-control">
        <div v-if="props.label" class="text-neutral-500 text-sm mb-2">{{ props.label }}</div>
        <select
            class="select select-bordered w-full"
            v-model="model"
            :name="props.name"
            :type="props.type"
            :class="props.className"
            :required="props.required"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
        >
            <option v-for="(option,i) in props.options" :key="i" :value="option[props.valueKey]">{{ option[props.textKey] }}</option>
        </select>
        <div v-if="props.errorMessage" class="text-xs my-2" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
