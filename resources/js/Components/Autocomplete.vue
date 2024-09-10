<script setup lang="ts">
import {useForm} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import Input from "@/Components/Input.vue";
import {useDebounce} from "@/Compasable/debounce.js";
const emits = defineEmits(['change', 'select']);

const debounce = useDebounce()

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

const select = (data: any) => {
    emits('select', data);
    lookup.value = ''
    isDropdownOpen.value = false
}

const onWindowClick = () => {
    isDropdownOpen.value = false
}

const onChange = () => {
    emits('change', lookup.value)
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
            @keyup.prevent.stop="debounce(onChange,500)"
            :validation-status="form.errors.search ? 'error' : 'success'"
            :error-message="form.errors.search"
        />
        <div class="relative" v-if="isDropdownOpen">
            <ul class="dropdown-content bg-base-100 rounded-box z-[1] mt-2 w-full max-h-60 shadow-lg flex-col overflow-auto">
                <template v-for="item in props.items">
                    <li>
                        <h4
                            class="text-gray-600 py-2 font-bold px-4 bg-gray-100 dark:bg-gray-950 dark:text-white first-letter:uppercase">
                            {{ item.name }}
                        </h4>
                        <template v-if="item.children && item.children.length">
                            <ul>
                                <li v-for="child in item.children">
                                <span @click="select(child)"
                                      class="block px-4 py-2 hover:bg-blue-100 hover:text-blue-600 dark:hover:bg-blue-600 dark:hover:text-white">{{
                                        child[textKey]
                                    }}</span>
                                </li>
                            </ul>
                        </template>
                        <div v-else class="text-blue-300 py-2 px-4 text-sm">
                            No items to display
                        </div>
                    </li>
                </template>
            </ul>

        </div>
    </div>
</template>
