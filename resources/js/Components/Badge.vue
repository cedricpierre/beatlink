<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div :class="{
       ...props.className,
      [`bg-${props.variant}-50`]: props.variant,
      [`text-${props.variant}-600`]: props.variant,
      [`text-${props.size}`]: props.size,
    }" class="inline rounded-full px-2 py-1 font-semibold">
        <slot></slot>
    </div>
</template>
