<script lang="ts" setup>

import {useStyleProps} from "@/Compasable/variant.js";

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <div :class="[`bg-${props.variant}`]" class="collapse" tabindex="0">
        <div class="collapse-title text-xl font-medium">
            <slot name="title"></slot>
        </div>
        <div class="collapse-content">
            <slot></slot>
        </div>
    </div>
</template>
