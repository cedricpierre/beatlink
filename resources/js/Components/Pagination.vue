<script setup lang="ts">
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
	<div class="join flex justify-center items-center my-6">
		<button
				:disabled="!$props.paginated.prev_page_url"
				@click="onPageChange(1)"
				class="join-item btn btn-secondary"
		>
			Previous
		</button>
		<button
				v-for="i in Math.ceil($props.paginated.total / $props.paginated.per_page)"
				@click="onPageChange(i)"
				class="join-item btn"
				:class="$props.paginated.current_page !== i ? 'btn-secondary' : 'btn-primary'"
		>
			{{ i }}
		</button>
		<button
				:disabled="!$props.paginated.next_page_url"
				@click="onPageChange($props.paginated.last_page)"
				class="join-item btn btn-secondary"
		>
			Next
		</button>
	</div>
</template>
