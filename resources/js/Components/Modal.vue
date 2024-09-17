<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

const model = defineModel<boolean>()

const props = defineProps({
    ...useStyleProps(),
})

</script>
<template>
    <dialog :class="[...props.className]" :open="model" class="modal" @close="model = false">
        <div class="modal-box bg-white">
            <div v-if="$slots.header" class="border-b border-b-1 text-gray-400 mb-6 font-bold text-lg dark:text-white">
                <slot name="header"></slot>
            </div>
            <div v-if="$slots.body">
                <slot name="body"></slot>
            </div>
            <div v-if="$slots.footer" class="modal-action">
                <slot name="footer"></slot>
            </div>
        </div>
        <form class="modal-backdrop bg-primary-800 bg-opacity-40" method="dialog">
            <Button>close</Button>
        </form>
    </dialog>
</template>
