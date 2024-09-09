<script setup lang="ts">

import {useStyleProps} from "@/Compasable/Variant.vue";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <button class="btn" :class="[...props.className, `btn-${props.variant}`, `btn-${props.size}`]">
        <slot></slot>
    </button>
</template>
