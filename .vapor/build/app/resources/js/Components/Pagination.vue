<script setup lang="ts">
import {IPaginated} from "@/Interfaces/Paginated";
import {router} from "@inertiajs/vue3";
import {PropType} from "vue";

const props = defineProps({
    paginated: Object as PropType<IPaginated<Object>>,
})

const onPageChange = (event: number) => {
    router.get(route(route().current() as string, {page: event}))
}
</script>
<template>
    <div class="join flex justify-center items-center my-6" v-if="props.paginated">
        <Button
            :disabled="!props.paginated.prev_page_url"
            @click="onPageChange(1)"
            class="join-item"
        >
            Previous
        </Button>
        <Button
            v-for="i in Math.ceil(props.paginated.total / props.paginated.per_page)"
            @click="onPageChange(i)"
            class="join-item"
            :class="[props.paginated?.current_page !== i ? 'btn-secondary' : 'btn-primary']"
        >
            {{ i }}
        </Button>
        <Button
            :disabled="!props.paginated.next_page_url"
            @click="onPageChange(props.paginated.last_page)"
            class="join-item"
        >
            Next
        </Button>
    </div>
</template>
