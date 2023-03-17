<template>
    <thead>
        <tr class="text-xs md:text-sm lg:text-md">
            <th class="bg-gray-50">{{header?.clientHead}}</th>
            <th class="bg-gray-50">{{header?.agencyHead}}</th>
            <th class="bg-gray-50">{{header?.feesHead}}</th>
            <th class="bg-gray-50">{{header?.processHead}}</th>
        </tr>
    </thead>
</template>

<script setup>
defineProps({header:Object})
</script>

<style scoped>
th, td{
    border: 1px solid rgb(170, 166, 166);
    padding: 1em;
}

th {
    color: #434343;
}
</style>