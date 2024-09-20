<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";
import Input from "@/Components/Input.vue";

const model = defineModel()

const props = defineProps({
    ...useStyleProps(),
    label: String,
    name: String,
    options: {
        type: Array<any>
    },
    required: Boolean,
    autofocus: Boolean,
    autocomplete: String,
    type: String,
    nullable: {
        type: Boolean,
        default: true,
    },
    textKey: {
        type: String,
        default: 'text',
    },
    valueKey: {
        type: String,
        default: 'value',
    },
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
        <Label v-if="props.label">{{ props.label }}</Label>
        <select
            v-model="model"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
            :class="{
                  ...props.className,
                  [`focus:border-${props.variant}-400`]: props.variant,
                  [`focus:ring-${props.variant}-200`]: props.variant,
                  [`text-${props.size}`]: props.size,
                  'border-red-300': props.validationStatus === 'error',
                }"
            class="block w-full rounded-md border border-gray-300 shadow-sm focus:ring focus:ring-opacity-50 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500"
            :name="props.name"
            :required="props.required"
            :type="props.type"
        >
            <option v-if="props.nullable" :value="null">None</option>
            <option v-for="(option,i) in props.options" :key="i" :value="option[props.valueKey]">{{ option[props.textKey] }}</option>
        </select>
        <div v-if="props.errorMessage" :class="{
            'text-red-600': props.validationStatus === 'error',
            'text-green-600': props.validationStatus === 'success',
        }" class="text-xs my-2">
            {{ props.errorMessage }}
        </div>
    </div>
</template>
