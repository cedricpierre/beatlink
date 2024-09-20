<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";
import {ref} from "vue";

const props = defineProps({
    ...useStyleProps(),
    closable: {
        type: Boolean,
        default: false,
    }
})

const closed = ref(false);

</script>
<template>
    <div v-if="!closed" :class="{
          ...props.className,
          [`bg-${props.variant}-50`]: props.variant,
          [`text-${props.variant}-500`]: props.variant,
          [`text-${props.size}`]: props.size,
          [`rounded-${props.rounded}`]: props.rounded,
        }"
         class="p-4"
         role="alert">
        <div class="w-full items-center justify-start flex">
            <div class="flex-grow">
                <slot></slot>
            </div>

            <div class="flex-shrink space-x-2">
                <slot name="action"></slot>
                <Button v-if="closable" :variant="props.variant" class="btn-sm" @click.prevent="closed = true">Close</Button>
            </div>
        </div>
    </div>
</template>
