<script setup lang="ts">

import {useStyleProps} from "@/Compasable/Variant.vue";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div tabindex="0" class="collapse" :class="[`bg-${props.variant}`]">
        <div class="collapse-title text-xl font-medium">
            <slot name="title"></slot>
        </div>
        <div class="collapse-content">
            <slot></slot>
        </div>
    </div>
</template>
