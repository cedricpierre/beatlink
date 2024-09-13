<script setup lang="ts">
import {useStyleProps} from "@/Compasable/variant.js";
import {watch} from "vue";

const model = defineModel<Boolean | any>()

const props = defineProps({
	...useStyleProps(),
})

</script>
<template>
	<dialog class="modal" :class="[...props.className]" :open="model" @close="model = false">
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
        <form method="dialog" class="modal-backdrop bg-primary-800 bg-opacity-40">
	        <Button>close</Button>
        </form>
    </dialog>
</template>
