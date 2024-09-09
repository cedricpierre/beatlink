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

const onWindowClick = () => {
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
        <div class="relative" v-if="isDropdownOpen">
            <ul class="dropdown-content bg-base-100 rounded-box z-[1] mt-2 w-full max-h-60 shadow-lg flex-col overflow-auto">
                <template v-for="item in props.items">
                    <li>
                        <h4
                            class="text-gray-600 py-2 border-b-2 border-b-gray-200 font-bold px-4 bg-gray-50 dark:bg-gray-950 dark:text-white first-letter:uppercase">
                            {{ item.name }}
                        </h4>
                        <template v-if="item.children">
                            <ul>
                                <li v-for="child in item.children">
                                <span @click="select(child)"
                                      class="block px-4 py-2 hover:bg-blue-100 hover:text-blue-600 dark:hover:bg-blue-600 dark:hover:text-white">{{
                                        child[textKey]
                                    }}</span>
                                </li>
                            </ul>
                        </template>
                    </li>
                </template>
            </ul>

        </div>
    </div>
</template>
