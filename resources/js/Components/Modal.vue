<script setup lang="ts">
import {watch} from "vue";

const model = defineModel<Boolean>()

const props = defineProps({
    className: [Object, String],
})

</script>
<template>
    <dialog class="modal" :class="props.className" :open="model" @close="model = false">
        <div class="modal-box bg-white">
            <div v-if="$slots.header" class="border-b border-b-1 text-gray-400 mb-6 font-bold text-lg dark:text-white">
                <slot name="header"></slot>
            </div>
            <div v-if="$slots.body">
                <slot name="body"></slot>
            </div>
            <div class="modal-action" v-if="$slots.footer">
                <slot name="footer"></slot>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-blue-800 bg-opacity-40">
            <button>close</button>
        </form>
    </dialog>
</template>
