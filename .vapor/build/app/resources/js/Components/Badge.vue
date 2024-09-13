<script setup lang="ts">

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div class="badge" :class="{
       ...props.className,
      [`badge-${props.variant}`]: props.variant,
      [`badge-outline`]: props.outline,
      [`badge-${props.size}`]: props.size,
    }">
        <slot></slot>
    </div>
</template>
