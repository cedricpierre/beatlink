<script lang="ts" setup>
import {IPaginated} from "@/Interfaces/Paginated";
import {router} from "@inertiajs/vue3";
import {PropType} from "vue";

const props = defineProps({
    paginated: Object as PropType<IPaginated<Object>>,
})

const onPageChange = (event: number) => {
    router.get(window.location.pathname + '?page=' + event)
}
</script>
<template>
    <div v-if="props.paginated" class="join flex justify-center items-center my-6">
        <Button
            :disabled="!props.paginated.prev_page_url"
            class="join-item"
            @click="onPageChange(1)"
        >
            Previous
        </Button>
        <Button
            v-for="i in Math.ceil(props.paginated.total / props.paginated.per_page)"
            :class="[props.paginated?.current_page !== i ? 'btn-secondary' : 'btn-primary']"
            class="join-item"
            @click="onPageChange(i)"
        >
            {{ i }}
        </Button>
        <Button
            :disabled="!props.paginated.next_page_url"
            class="join-item"
            @click="onPageChange(props.paginated.last_page)"
        >
            Next
        </Button>
    </div>
</template>
