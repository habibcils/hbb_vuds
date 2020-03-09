<template>
    <table class="table is-bordered data-table">
        <thead>
            <tr>
                <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                    :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                    :style="'width:'+column.width+';'+'cursor:pointer;'">
                    {{column.label}}
                    <i :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'fa-sort-up' : 'fa-sort-down') : 'fa-sort'" class="sort-icon fa fa-sort" style="opacity:1;position:relative;float:right"></i>                    
                </th>
            </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>
    export default {
        props: ['columns', 'sortKey', 'sortOrders']
    }
</script>