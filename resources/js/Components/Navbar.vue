<script setup lang="ts">
import {useStyleProps} from "@/Compasable/variant";
import Dropdown from "@/Components/Dropdown.vue";

const props = defineProps({
    ...useStyleProps(),
})
</script>
<template>
    <div class="navbar" :class="{
        ...props.className,
        [`btn-${props.variant}`]: props.variant
    }">

        <div class="navbar-start">
            <Dropdown align="start" class="mr-2">
                <template #trigger>
                    <div class="btn btn-ghost btn-sm btn-square lg:hidden">
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
                    </div>
                </template>
                <ul class="menu menu-vertical space-y-2">
                    <slot name="responsive"></slot>
                </ul>
            </Dropdown>

            <slot name="left"></slot>
        </div>
        <div class="navbar-center lg:flex hidden">
            <ul class="menu menu-horizontal space-x-2">
                <slot name="center"></slot>
            </ul>
        </div>
        <div class="navbar-end">
            <ul class="menu menu-horizontal space-x-2">
                <slot name="right"></slot>
            </ul>
        </div>
    </div>

</template>
