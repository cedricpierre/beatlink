<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div :class="{
       ...props.className,
      [`badge-${props.variant}`]: props.variant,
      [`badge-outline`]: props.outline,
      [`badge-${props.size}`]: props.size,
    }" class="badge">
        <slot></slot>
    </div>
</template>
