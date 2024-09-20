<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div :class="{
       ...props.className,
      [`text-${props.variant}-600`]: props.variant,
      [`text-${props.size}`]: props.size,
    }" class="mb-1 block text-sm font-medium text-gray-700">
        <slot></slot>
    </div>
</template>
