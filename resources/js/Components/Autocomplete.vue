<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import Input from "@/Components/Input.vue";

const emits = defineEmits(['change', 'select']);

const props = defineProps({
    label: {
        type: String,
        default: 'Search',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    items: {
        type: Array,
        required: true,
    },
    textKey: {
        type: String,
        default: 'name',
    },
    idKey: {
        type: String,
        default: 'id',
    },
})

const lookup = ref('')

const isDropdownOpen = ref(false)

const form = useForm({
    search: ''
})

const dropdown = ref(null);

const select = (data: any) => {
    emits('select', data);
    lookup.value = ''
    isDropdownOpen.value = false
}

const onWindowClick = (event: Event) => {
    isDropdownOpen.value = false
}

watch(isDropdownOpen, (value) => {

    if (value) {
        window.addEventListener('click', onWindowClick)
    } else {
        window.removeEventListener('click', onWindowClick)
    }
})

watch(() => props.items, (values) => {
    isDropdownOpen.value = !!values.length
})
</script>

<template>
    <div class="form-control">
        <Input
            v-model="lookup"
            :disabled="props.disabled"
            :label="props.label"
            @keyup.prevent.stop="emits('change', lookup)"
            :validation-status="form.errors.search ? 'error' : 'success'"
            :error-message="form.errors.search"
        />
        <div class="relative w-full" ref="dropdown">
            <div id="dropdown" v-if="isDropdownOpen"
                 class="absolute w-full z-10 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                <ul class="max-h-60 overflow-x-hidden overflow-y-scroll py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <template v-for="item in props.items">
                        <h4
                            class="text-gray-600 py-2 border-b-2 border-b-gray-200 font-bold px-4 bg-gray-50 dark:bg-gray-950 dark:text-white first-letter:uppercase">
                            {{ item.name }}</h4>
                        <template v-if="item.children">
                            <li v-for="child in item.children">
                                <span @click="select(child)"
                                      class="block px-4 py-2 hover:bg-blue-100 hover:text-blue-600 dark:hover:bg-blue-600 dark:hover:text-white">{{
                                        child[textKey]
                                    }}</span>
                            </li>
                        </template>
                    </template>
                </ul>
            </div>
        </div>
    </div>
</template>
