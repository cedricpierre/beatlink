<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
    active: Boolean,
})

</script>
<template>
    <div v-if="active" :class="{
          ...props.className,
          [`loading-${props.variant}`]: props.variant,
          [`loading-${props.size}`]: props.size,
        }"
         class="loading"
    >
        <slot></slot>
    </div>
</template>
