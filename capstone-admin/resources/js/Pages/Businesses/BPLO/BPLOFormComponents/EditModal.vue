<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-30">
        <form @submit.prevent="onSubmit"
            class="backdrop-blur-xl bg-white/70 sm:w-[800px] p-5 rounded-lg flex flex-col border overflow-y-auto scrollbar gap-3"
            enctype="multipart/form-data">
            <!-- close modal btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <label class="flex flex-col">
                <span class="font-[600] text-xs">Title:</span>
                <input type="text" v-model="formData.title" class="bg-slate-100" />
            </label>
            <label class="flex flex-col">
                <span class="font-[600] text-xs">Description:</span>
                <textarea v-model="formData.description"
                    class="max-h-[100px] h-[100px] resize-none bg-slate-100 scrollbar"></textarea>
            </label>
            <label class="flex flex-col">
                <span class="font-[600] text-xs">Reuqirements:</span>
                <textarea v-model="formData.requirements"
                    class="max-h-[150px] h-[150px] resize-none bg-slate-100 scrollbar"></textarea>
            </label>

            <button :disabled="isSubmitting" type="submit" :class="{
                'cursor-not-allowed': isSubmitting,
            }" class="px-4 bg-blue-600 ml-3 text-white rounded-md font-bold flex items-center self-end">
                <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                <span v-if="!isSubmitting">save</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Loading from '../../../../Components/Loading.vue';

const isSubmitting = ref(false)
const formData = useForm({
    title: data.title,
    description: data.description,
    requirements: data.requirements,
})

function onSubmit() {
    isSubmitting.value = true;
    handleUpdatePermit(formData, tableId).then(() => {
        isSubmitting.value = false;
    })
}

const { data, handleUpdatePermit, tableId } = defineProps({
    data: Object,
    tableId: Number,
    closeModal: Function,
    handleUpdatePermit: Function
})
</script>