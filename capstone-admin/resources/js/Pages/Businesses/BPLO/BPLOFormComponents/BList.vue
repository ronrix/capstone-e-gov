<template>
    <div class="flex justify-between items-center mb-1 mt-2 gap-2">
        <input type="text" v-model="title" class="text-base font-normal flex-1 outline-blue-600 capitalize">
        <button @click="handleDeleteRequirement" class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">delete</button>
    </div>
</template>

<script setup>

function handleDeleteRequirement() {
    // TODO: delete request permit requirement
    // delete by ID
    console.log(id)
}

// destructuring prop variables
// so we can use the props inside the script tag
// if did not do { id } or destructuring, we can only use this prop inside <template> tag
const { id } = defineProps({ title: String, id: Number })
</script>

<style lang="scss" scoped></style>
