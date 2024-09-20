<script setup lang="ts">
import {useStyleProps} from "@/Compasable/variant";
import Dropdown from "@/Components/Dropdown.vue";

const props = defineProps({
    ...useStyleProps(),
    sticky: Boolean,
    shadow: Boolean,
    position: String,
})
</script>
<template>
    <nav class="flex z-50 justify-center items-center px-6 py-4 space-x-2" :class="{
        ...props.className,
        [`bg-${props.variant}`]: props.variant,
        [`${props.position}-0`]: props.sticky && props.position,
        'sticky': props.sticky,
        'shadow-2xl': props.shadow,
    }">

        <div class="flex flex-shrink" v-if="$slots.responsive">
            <Dropdown class="mr-2">
                <template #trigger>
                    <Button variant="light" class="lg:hidden">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16"/>
                        </svg>
                    </Button>
                </template>
                <slot name="responsive"></slot>
            </Dropdown>

            <slot name="left"></slot>
        </div>
		<div class="lg:flex hidden">
            <ul class="flex text-sm font-medium space-x-2">
                <slot name="center"></slot>
            </ul>
        </div>
		<div class="flex justify-end flex-grow">
            <ul class="flex text-sm font-medium space-x-2">
                <slot name="right"></slot>
            </ul>
        </div>
    </nav>

</template>
