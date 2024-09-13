<script setup lang="ts">

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
    active: Boolean,
})

</script>
<template>
    <div v-if="active" class="loading"
         :class="{
          ...props.className,
          [`loading-${props.variant}`]: props.variant,
          [`loading-${props.size}`]: props.size,
        }"
    >
        <slot></slot>
    </div>
</template>
