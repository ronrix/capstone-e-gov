<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-30">
        <form @submit.prevent="onSubmit"
            class="backdrop-blur-xl bg-white/70 h-full sm:h-auto sm:w-[500px] p-5 rounded-lg flex flex-col border overflow-y-auto scrollbar"
            enctype="multipart/form-data">
            <!-- close modal btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

            <h3 class="font-bold text-2xl">Edit FAQ</h3>
            <label class="flex flex-col">
                <span class="text-sm text-gray-600">Question:</span>
                <textarea class="resize-none h-[50px] max-h-[50px]" v-model="formData.question"></textarea>
            </label>
            <label class="flex flex-col">
                <span class="text-sm text-gray-600">Answer:</span>
                <textarea class="resize-none h-[120px] max-h-[120px]" v-model="formData.answer"></textarea>
            </label>

            <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
                class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center text-xs sm:text-sm self-end">
                <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                <span v-if="!isSubmitting">save</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from "vue"
import Loading from "../../../Components/Loading.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const formData = useForm({
    question: faq.question,
    answer: faq.answer,
});
const isSubmitting = ref(false);

function onSubmit() {
    isSubmitting.value = true;
    handleUpdateFAQ(formData, faq.id).then(() => {
        isSubmitting.value = false;
    })
}

const { faq, handleUpdateFAQ } = defineProps({
    closeModal: Function,
    faq: Object,
    handleUpdateFAQ: Function,
})
</script>
