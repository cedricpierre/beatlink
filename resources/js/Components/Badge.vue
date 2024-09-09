<script setup lang="ts">

import {useVariant} from "@/Compasable/Variant.vue";

const variant = useVariant()

console.log(variant)
</script>
<template>
    <div class="badge" :class="`badge-${variant}`">neutral</div>
</template>
