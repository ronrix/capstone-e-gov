<template>
    <tbody class="text-left">
        <tr class="text-xs md:text-sm lg:text-md">
            <td>{{data?.client}}</td>
            <td>{{data?.agency}}</td>
            <td>{{data?.fees}}</td>
            <td>{{data?.time}}</td>
        </tr>
    </tbody>
       
</template>

<script setup>
defineProps({data:Object})
</script>

<style scoped>
th, td{
    border: 1px solid gray;
    padding: 1em;
}

</style>