<script lang="ts" setup>
import {useForm} from "@inertiajs/vue3";
import {ref, watch} from "vue";
import Input from "@/Components/Input.vue";
import {useDebounce} from "@/Compasable/debounce.js";

const emits = defineEmits(['change', 'select']);

const debounce = useDebounce()

const props = defineProps({
    loading: Boolean,
    label: {
        type: String,
        default: 'Search',
    },
    disabled: {
        type: Boolean,
        default: false,
    },
    items: {
        type: Array<any>,
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

const lookup = defineModel()

const isDropdownOpen = ref(false)

const form = useForm({
    search: ''
})

const select = (data: any) => {
    emits('select', data);
    lookup.value = data[props.textKey]
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
        <Label v-if="props.label">{{ props.label }}</Label>
        <Input
            v-model="lookup"
            :disabled="props.disabled"
            :error-message="form.errors.search"
            :label="props.label"
            :loading="props.loading"
            :validation-status="form.errors.search ? 'error' : 'success'"
            type="search"
            @keyup.prevent.stop="debounce(onChange,500)"
        />
        <div v-if="isDropdownOpen" class="relative">
            <ul class="dropdown-content rounded-box z-[1] mt-2 w-full max-h-60 shadow-lg flex-col overflow-auto">
                <template v-for="item in props.items">
                    <li>
                        <h4
                            class="text-gray-600 py-2 font-bold px-4 bg-gray-100 dark:bg-gray-950 dark:text-white first-letter:uppercase">
                            {{ item.name }}
                        </h4>
                        <template v-if="item.children && item.children.length">
                            <ul>
                                <li v-for="child in item.children">
                                    <a class="block px-4 py-2 hover:bg-primary-100 hover:text-primary-600 dark:hover:bg-primary-600 dark:hover:text-white"
                                       href="#"
                                       @click.prevent="select({type: item.name, ...child})">
                                        <div class="flex">
                                            <div v-if="child.picture" class="flex-shrink mr-2">
                                                <img :src="child.picture.url" alt="" class="h-10 w-10 rounded">
                                            </div>
                                            <div class="flex-grow-1 flex justify-center items-start flex-col flex-1">
                                                <div>{{ child[textKey] }}</div>
                                                <div v-if="child.author" class="text-gray-400 text-xs">{{ child.author.name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </template>
                        <div v-else class="text-primary-300 py-2 px-4 text-sm">
                            No items to display
                        </div>
                    </li>
                </template>
            </ul>

        </div>
    </div>
</template>
