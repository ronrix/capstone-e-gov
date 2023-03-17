<template>
     <!-- table 2 -->
    <tbody>
        <tr class="text-xs md:text-sm lg:text-md">
            <td class="text-center"><textarea
                    class="w-full h-[90px] max-h-[90px] focus:outline-blue-500 py-1 px-4 overflow-scroll no-scrollbar bg-white">{{ seal1?.symbol }}</textarea>
            </td>
            <td class="text-center"><textarea
                    class="w-full h-[90px] max-h-[90px] focus:outline-blue-500 py-1 px-4 overflow-scroll no-scrollbar bg-white">{{ seal1?.description1 }}</textarea>
            </td>
        </tr>
    </tbody>
</template>

<script setup>
defineProps({seal1: Object,})
</script>

<style scoped>
table,
th,
td {
  border: 1px solid gray;
}

table {
  background-color: white;
}

td {
  padding: 0.7em;
}
th{
    padding: 0.2em;
}
</style>