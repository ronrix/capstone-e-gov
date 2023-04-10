<template>
    <tbody class="text-left">
        <tr class="text-xs md:text-sm lg:text-md text-gray-700">
            <td class="">
                <textarea class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{ data?.client_steps }}</textarea>
            </td>
            <td class="text-center">
                <textarea class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{ data?.agency_steps }}</textarea>
            </td>
            <td class="text-center">
                <textarea class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{ data?.fees }}</textarea>
            </td>
            <td class="text-center">
                <textarea class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar">{{ data?.process_time }}</textarea>
            </td>
            <td>
                <button class="mx-auto bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">delete</button>
            </td>
        </tr>
    </tbody>
</template>

<script setup>
defineProps({ data: Array });
</script>

<style scoped>
th, td {
    border: 1px solid rgb(170, 166, 166);
}
</style>