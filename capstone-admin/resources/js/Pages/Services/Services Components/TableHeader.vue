<template>
    <thead>
        <tr class="text-xs md:text-sm lg:text-md">
            <th>{{header?.clientHead}}</th>
            <th>{{header?.agencyHead}}</th>
            <th>{{header?.feesHead}}</th>
            <th>{{header?.processHead}}</th>
        </tr>
    </thead>
</template>

<script setup>
defineProps({header:Object})
</script>

<style scoped>
th,
td {
    border: 1px solid gray;
    padding: 1em;
}

th {
    color: #434343;
}
</style>