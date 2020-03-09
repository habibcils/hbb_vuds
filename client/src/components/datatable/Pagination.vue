<style>
.pagination {
    justify-content: flex-end !important;
}
.pagination .page-stats {
        align-items: center;
        margin-right: 5px;
}
.pagination i{
    color: #3273dc !important;
}
</style>

<template>
    <nav class="pagination" v-if="!client">
        <span class="page-stats">Displaying {{pagination.from}} - {{pagination.to}} of {{pagination.total}} records</span>
        <a v-if="pagination.prevPageUrl" class="button is-small pagination-previous" @click="$emit('prev');">
            Prev
        </a>
        <a class="button is-small pagination-previous" v-else :disabled="true">
           Prev
        </a>

        <a v-if="pagination.nextPageUrl" class="button is-small pagination-next" @click="$emit('next');">
            Next
        </a>
        <a class="button is-small pagination-next" v-else :disabled="true">
            Next
        </a>
    </nav>

    <nav v-ripple  class="pagination" v-else>
        <span class="page-stats">
            {{pagination.from}} - {{pagination.to}} of {{filtered.length}}
            <span v-if="filtered.length < pagination.total">(filtered from {{pagination.total}} total entries)</span>
        </span>
        <a v-ripple  v-if="pagination.prevPage" class="button is-small pagination-previous page-item" @click="$emit('prev');">
            Prev
        </a>
        <a v-ripple  class="button is-small pagination-previous page-item " v-else :disabled="true">
           Prev
        </a>

        <a v-ripple  v-if="pagination.nextPage" class="button is-small pagination-next page-item " @click="$emit('next');">
            Next
        </a>
        <a v-ripple  class="button is-small pagination-next" v-else :disabled="true">
            Next
        </a>
    </nav>
</template>

<script>
    export default {
        props: ['pagination', 'client', 'filtered']
    }
</script>

<style scoped>
.pagination a{
    background-color: #d4cdcd;
    padding: 3px 8px;
    margin: 0 5px;
    cursor:pointer;
}
.pagination span{
    padding: 3px 8px;
    margin: 0 5px;
}
</style>