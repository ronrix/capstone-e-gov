<template>
    <WrapperContent>
        <div class="bg-white rounded-lg p-4">
            <h1 class="font-bold text-xl mb-2">Checklist of Requirements</h1>
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div>
                    <ListReq title="Proof of Enrollment" />
                    <ListReq title="Copy of Grades of Last Semester" />
                    <ListReq title="Photocopy of School ID" />
                    <ListReq title="Barangay Clearance/ Indigency" />
                </div>
                <div>
                    <ListReq title="Letter of Request" />
                    <ListReq title="Accomplished Application Form" />
                    <ListReq title="1pc 2 x 2 Photo" />
                </div>
                <div class="place-self-end col-span-full">
                    <button
                        class=" w-[90px] bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs mr-2 mb-2 mt-2 uppercase">Add
                        new </button>
                </div>

            </div>
        </div>

        <div class="bg-white rounded-lg mt-5 p-4">
            <!-- table -->
            <table class="table-auto w-full mt-5 text-left ">
                <thead>
                    <tr class="text-xs md:text-sm lg:text-md">
                        <th>Client Steps</th>
                        <th>Agency Action</th>
                        <th>Fees to Paid</th>
                        <th>Processing Time</th>
                    </tr>
                </thead>
                <tbody>
                    <Rows v-for="(data, index) in table" :class="{ 'bg-gray-200': index % 2 }" :data="data"
                        class="hover:bg-gray-300" />
                </tbody>
            </table>
        </div>


    </WrapperContent>
</template>

<script setup>
import ListReq from './ListReq.vue';
import Rows from './Rows.vue'
const table = [
    {
        client: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled",
        agency: "Officeof the Mayor",
        fees: "",
        time: "1 min"
    },
    {
        client: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled",
        agency: "Officeof the Mayor",
        fees: "",
        time: "1 min"
    }
]
</script>


<style scoped>
th,
td {
    border: 1px solid gray;
    padding: 1em;
}

th {
    color: #434343;
}
</style>
