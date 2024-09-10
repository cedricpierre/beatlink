<script setup lang="ts">

import {useStyleProps} from "@/Compasable/Variant.vue";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div role="alert" class="alert my-4" :class="[`alert-${props.variant}`]">
        <span>
            <slot></slot>
        </span>
    </div>
</template>
