<script setup lang="ts">
const props = defineProps({
    align: {
        type: String,
        validator(value, props) {
            return ['start', 'end'].includes(value)
        }
    }
})
</script>
<template>
    <div class="dropdown " :class="`dropdown-${align}`">
        <slot name="trigger"></slot>
        <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
            <slot></slot>
        </ul>
    </div>
</template>
