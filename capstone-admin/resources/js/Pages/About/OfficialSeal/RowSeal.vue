<template>
    <!-- table 1 -->
    <tbody>
        <tr class="text-xs md:text-sm lg:text-md">
            <td class="text-center"><textarea
                        class="w-full h-[200px] max-h-[195px] focus:outline-blue-500 py-1 px-4 overflow-scroll no-scrollbar bg-white">{{ seal?.color }}
                    </textarea>
            </td>
            <td class="text-center"><textarea
                        class="w-full h-[200px] max-h-[195px] focus:outline-blue-500 py-3 px-4 overflow-scroll no-scrollbar bg-white">{{ seal?.description }}</textarea>
            </td>
        </tr>
    </tbody>
</template>

<script setup>
defineProps({seal: Object,})
</script>

<style scoped>
th,
td {
    border: 1px solid rgb(170, 166, 166);
   
}

td {
    padding: 1em;
}
th{
    padding: 0.2em;
}
</style>