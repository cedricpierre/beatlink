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
          [`alert-${props.variant}`]: props.variant,
          [`alert-outline`]: props.outline,
          [`alert-${props.size}`]: props.size,
        }"
         class="alert shadow flex"
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
