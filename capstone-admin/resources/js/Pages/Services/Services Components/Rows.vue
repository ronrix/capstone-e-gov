<template>
    <tbody class="text-left">
        <tr class="text-xs md:text-sm lg:text-md">
            <td class="text-center"><textarea class="w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.client}}</textarea></td>
            <td class="text-center"><textarea class="w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.agency}}</textarea></td>
            <td class="text-center"><textarea class="w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.fees}}</textarea></td>
            <td class="text-center"><textarea class= "w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.time}}</textarea></td>                               
        </tr>
    </tbody>
       
</template>

<script setup>
defineProps({data:Object})
</script>

<style scoped>
th, td{
    border: 1px solid rgb(170, 166, 166);
    padding: 1em;
}

</style>