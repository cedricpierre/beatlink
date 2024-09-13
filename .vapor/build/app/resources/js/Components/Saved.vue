<script setup lang="ts">
defineProps({
    form: {
        type: Object,
        required: true,
    }
})
</script>
<template>
    <Transition
        enter-active-class="transition ease-in-out"
        enter-from-class="opacity-0"
        leave-active-class="transition ease-in-out"
        leave-to-class="opacity-0"
    >
        <p v-if="form.recentlySuccessful" class="text-sm text-green-600 dark:text-green-400">Saved.</p>
    </Transition>
</template>
