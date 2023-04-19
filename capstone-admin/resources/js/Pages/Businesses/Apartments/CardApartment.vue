<template>
    <div class="flex">

        <!-- restore button -->
        <div class="relative">
            <div v-if="data.deleted_at" @click="showRestoreModal"
                class="bg-blue-300 text-blue-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-blue-400 hover:text-blue-200 cursor-pointer z-10">
                restore</div>

            <!-- delete button -->
            <div v-else @click="showDeleteVerificationModal"
                class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer z-10">
                delete</div>

            <!-- restore -->
            <RestoreVerificationModal v-if="isRestoreModal" :close-modal="showRestoreModal" :handle-restore="handleRestore"
                :id="data.id" />

            <!-- delete -->
            <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
                :handle-delete="handleDelete" :id="data.id" />

            <button @click="showPreviewModal(data)">

                <div class="card1 flex flex-col w-full md:w-auto">
                    <!---Image-->
                    <div :style="{ backgroundImage: `url(${imgSrc})` }"
                        class="rounded-md bg-no-repeat bg-cover bg-center h-[150px] max-h-[150px] object-cover relative">
                    </div>
                    <!--content-->
                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <h3 class="apartment-name font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
                        <h5 class="text-xs text-gray-500 tracking-wide text-center">{{ data.category }}</h5>
                        <h5 class="text-xs text-gray-500 tracking-wide text-center">{{ data.location }}</h5>
                    </div>
                </div>
            </button>
        </div>
    </div>
</template>

<script setup>
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import RestoreVerificationModal from '../../../Components/RestoreVerificationModal.vue';
import { formatImgs } from '../../../utils/formatImgs';
import { ref } from 'vue';

const isVerificationModal = ref(false);
const isRestoreModal = ref(false);

// function to handle the delete 
function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

// function to handle the delete 
function showRestoreModal() {
    isRestoreModal.value = !isRestoreModal.value;
}

// the first value of the img_links is a img link but it has a '"' on the first character 
// that's why i use replace method. 
// the first index of "img_link" will be the default thumbnail of the news data
const imgSrc = formatImgs(data.img_link.split(","))[0];

const { data } = defineProps({
    showPreviewModal: Function,
    handleDelete: Function,
    handleRestore: Function,
    data: Object
});
</script>

<style scoped>
.APcontent {
    margin-bottom: 5px;
    width: 260px
}

.apartment-name {
    margin-top: 0.5em;
    font-weight: bold;
    margin-left: 5px;
    margin-bottom: 5px;
    width: 250px
}

.card1 {
    /* padding: 0.5em; */
    background-color: rgb(255, 255, 255);
    border-radius: 5px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    transition: .5s;
}

.card1:hover {
    transform: scale(1.025);

}
</style>