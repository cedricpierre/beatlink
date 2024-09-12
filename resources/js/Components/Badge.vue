<script setup lang="ts">

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div class="badge" :class="[`badge-${props.variant}`, `badge-${props.size}`, props.outline ? 'badge-outline' : '']">
        <slot></slot>
    </div>
</template>
