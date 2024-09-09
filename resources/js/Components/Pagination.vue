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
    <div class="py-6 flex justify-center items-center">

        <fwb-pagination v-model="$props.paginated.current_page" :per-page="$props.paginated.per_page"
                        :total-items="$props.paginated.total" :show-labels="false" @page-changed="onPageChange">

            <template #prev-icon>
                Previous
            </template>
            <template #next-icon>
                Next
            </template>
            <template v-slot:page-button="{ page, setPage }">
                <button
                    @click="setPage(page)"
                    class="flex items-center justify-center first:rounded-l-lg last:rounded-r-lg px-3 h-8 ml-0 leading-tight bg-white text-gray-500 border border-r-0 first:border-r-0 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                >
                    {{ page }}
                </button>
            </template>
        </fwb-pagination>
    </div>
</template>
