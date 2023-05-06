
<template>
    <!-- edit FAQ -->
    <EditFAQModal v-if="isShowEditModal" :close-modal="showEditModal" :faq="data" :handle-update-f-a-q="handleUpdateFAQ" />

    <!-- delete -->
    <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
        :handle-delete="handleDelete" :id="data.id" />

    <div class="flex flex-col mt-5 cursor-pointer border border-x-0 border-t-0 border-b-gray-500 pb-5 relative"
        @click="showAnswer">
        <div class="flex items-center justify-between pointer-events-none">
            <h2 class="text-normal text-dark font-medium text-dark">
                {{ data?.question }}
            </h2>
            <i ref="icon" class="uil text-2xl uil-angle-down"></i>
        </div>
        <div class=" absolute top-2 right-10 flex items-center">
            <button type="button"
                class="px-2 text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white text-xs rounded-md"
                @click.stop="showEditModal">edit</button>
            <button type="button"
                class="px-2 text-red-600 border border-red-600 hover:bg-red-600 hover:text-white text-xs rounded-md"
                @click.stop="showDeleteVerificationModal">delete</button>
        </div>
        <div class="answer h-0 overflow-hidden duration-500 pointer-events-none">
            <div class="w-[85%] text-secondary font-normal text-sm mt-2 text-dark marked-desc"
                :innerHTML="DOMpurify.sanitize(marked.parse(data?.answer))">
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import EditFAQModal from './EditFAQModal.vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';

import { marked } from "marked";
import DOMpurify from "dompurify";

const isVerificationModal = ref(false);
const isShowEditModal = ref(false);
function showEditModal() {
    isShowEditModal.value = !isShowEditModal.value;
}

function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

function handleDelete() {
    handleDeleteFAQ(data.id).then(() => {
        isVerificationModal.value = false;
    })
}

function showAnswer(e) {
    const lastElement = e.target.lastElementChild
    document.querySelectorAll('.answer').forEach((el) => {
        if (lastElement === el) {
            return
        }
        el.classList.remove('h-auto')
        el.previousElementSibling.previousElementSibling.lastElementChild.classList.remove('uil-angle-up')
        el.previousElementSibling.previousElementSibling.lastElementChild.classList.add('uil-angle-down')
    })
    lastElement.classList.toggle('h-auto')

    // change icon
    e.target.firstElementChild.lastElementChild.classList.toggle("uil-angle-up");
}

const { handleDeleteFAQ, data } = defineProps({
    data: Object,
    showAnswer: Function,
    handleDeleteFAQ: Function,
    handleUpdateFAQ: Function,
});
</script>

<style>
.marked-desc h4 {
    font-size: 1em;
    font-weight: bold;
}

.marked-desc ol {
    list-style-type: decimal;
    margin-left: 1em;
}

.marked-desc ul {
    list-style-type: disc;
    margin-left: 1em;
}

.marked-desc p {
    margin: 0.5em 0;
}
</style>