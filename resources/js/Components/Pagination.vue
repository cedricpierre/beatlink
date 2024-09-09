<script setup lang="ts">
import {FwbPagination} from "flowbite-vue";
import {IPaginate} from "@/Interfaces/Paginate";
import {router} from "@inertiajs/vue3";

const props = defineProps<{
    paginated: IPaginate<Object>;
}>()

const onPageChange = (event: number) => {
    router.get(route(route().current(), {page: event}))
}
</script>
<template>
    <div class="join flex justify-center items-center my-4">
        <button
            v-if="$props.paginated.current_page > 1"
            @click="onPageChange(1)"
            class="join-item btn"
            :class="{'btn-active': $props.paginated.current_page === 1}"
        >
            Previous
        </button>
        <button
            v-for="i in $props.paginated.total"
            @click="onPageChange(i)"
            class="join-item btn"
            :class="{'btn-active': $props.paginated.current_page === i}"
        >
            {{ i }}
        </button>
        <button
            v-if="$props.paginated.current_page < $props.paginated.total - 1"
            @click="onPageChange($props.paginated.total)"
            class="join-item btn"
            :class="{'btn-active': $props.paginated.current_page === $props.paginated.total}"
        >
            Previous
        </button>
    </div>
</template>
