<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel<string | null>()

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
        <div v-if="props.label" class="text-neutral-500 text-sm mb-2">{{ props.label }}</div>
        <select
            v-model="model"
            :autocomplete="props.autocomplete"
            :autofocus="props.autofocus"
            :class="{
                  ...props.className,
                  [`select-${props.variant}`]: props.variant,
                  [`select-${props.size}`]: props.size,
                }"
            :name="props.name"
            :required="props.required"
            :type="props.type"
            class="select select-bordered w-full"
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
