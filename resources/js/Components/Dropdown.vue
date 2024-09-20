<script lang="ts" setup>
import {onMounted, ref, watch} from "vue";

const props = defineProps({
    align: {
        type: String,
        default: 'left',
        validator(value: string): boolean {
            return ['left', 'right'].includes(value)
        }
    }
})

const open = ref(false)

watch(() => open.value, (value) => {
    if (value) {
        window.addEventListener('click', () => {
            open.value = false
        }, {once: true})
    }
})

</script>
<template>
    <div class="relative inline-block">
        <a href="#" @click.prevent.stop="open = !open" v-if="$slots.trigger">
            <slot name="trigger"></slot>
        </a>
        <div
            v-if="open"
            class="absolute transition z-10 mt-2 w-48 rounded-lg border border-gray-100 bg-white text-left text-sm shadow-lg"
            :class="{
                [`${align}-0`] : props.align,
            }"
        >
            <ul class="p-1">
                <slot></slot>
            </ul>
        </div>
    </div>
</template>

<style scoped>
details > summary {
    list-style: none;
}
</style>
