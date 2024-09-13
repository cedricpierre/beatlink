<script lang="ts" setup>
import {useStyleProps} from "@/Compasable/variant.js";

interface Column {
    name: string;
    key: string;
    size: number;
    className: string;
    align: 'left' | 'right' | 'center';
}

interface Item {
    item: Object,
    index: number;
}

const props = defineProps({
    ...useStyleProps(),
    columns: {
        type: Array<Column>,
        default: () => [],
        required: true,
    },
    items: {
        type: Array<any>,
        default: () => [],
        required: true,
    },
})

</script>
<template>
    <table :class="{
              ...props.className,
              [`table-${props.variant}`]: props.variant,
              [`table-${props.size}`]: props.size,
            }"
           class="table"
    >
        <thead>
        <tr>
            <th v-for="(column,h) in props.columns"
                :key="h"
                :class="[`text-${column.align ?? 'left'}`]"
            >
                {{ column.name ?? column.key }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item,i) in items" :key="i">
            <td v-for="(column,c) in props.columns"
                :key="c"
                :class="[column.className, `text-${column.align ?? 'left'}`]"
            >
                <slot v-if="$slots['item.'+column.key]" :name="`item.${column.key}`" v-bind="{index: i, item: item} as Item"></slot>
                <template v-else>{{ item[column.key] }}</template>
            </td>
        </tr>
        </tbody>
        <template v-if="$slots.footer">
            <tfoot>
            <slot name="footer"></slot>
            </tfoot>
        </template>
    </table>
    <template v-if="$slots.empty && !props.items.length">
        <div class="flex items-center justify-center py-4 text-gray-500 font-bold text-sm">
            <slot name="empty"></slot>
        </div>
    </template>
    <div v-if="$slots.pagination">
        <slot name="pagination"></slot>
    </div>
</template>
