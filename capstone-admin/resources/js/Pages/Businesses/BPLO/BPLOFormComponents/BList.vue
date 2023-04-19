<template>
    <div class="flex justify-between items-center mb-1 mt-2 gap-2 duration-75">
        <input type="text" @change.capture="(e) => handleUpdatePermit(e, tableId, perId, reqId, true)" :value="list"
            class="text-sm sm:text-base font-normal flex-1 outline-blue-600 capitalize bg-transparent px-2 py-1 rounded-md">
        <button @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave"
            @click="showDeleteVerificiationModal('one', permitKey, reqId)"
            class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md rotate-180">
            <i class="uil uil-cancel pointer-events-none"></i>
        </button>
    </div>
</template>

<script setup>

// add hover background
function handleMouseEnter(e) {
    e.target.parentElement.classList.add("bg-red-500");
    e.target.parentElement.classList.add("text-white");
}
function handleMouseLeave(e) {
    e.target.parentElement.classList.remove("text-white");
    e.target.parentElement.classList.remove("bg-red-500");
}

// destructuring prop variables
// so we can use the props inside the script tag
// if did not do { id } or destructuring, we can only use this prop inside <template> tag
const { tableId, perId, reqId } = defineProps({
    list: String,
    tableId: Number,
    perId: Number,
    permitKey: String,
    reqId: Number,
    handleUpdatePermit: Function,
    showDeleteVerificiationModal: Function
});
</script>