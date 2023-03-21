<template>
    <tbody class="text-left">
        <tr class="text-xs md:text-sm lg:text-md text-gray-700">
            <td class="text-center"><textarea class="w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.client}}</textarea></td>
            <td class="text-center"><textarea class="w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.agency}}</textarea></td>
            <td class="text-center"><textarea class="w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.fees}}</textarea></td>
            <td class="text-center"><textarea class= "w-full h-[300px] max-h-[300px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{data?.time}}</textarea></td>
            <td class="bg-white border pl-2"><button class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">delete</button></td>                               
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