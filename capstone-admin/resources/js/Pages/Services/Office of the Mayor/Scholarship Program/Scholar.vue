<template>
    <WrapperContent>

        <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requiremnts</h3>
        <WrapperReq>
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
        </WrapperReq>

        <h3 class="font-bold text-xl mt-3 mb-3 text-gray-800">What's the process?</h3>
        <Table>
            <TableHeader v-for="(header, index) in thead" :header="header" />
            
            <Rows v-for="(data, index) in table" :data="data" />
        </Table>
        <div class="flex flex-col">
                <button @click="showHotlineModal" class="border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end mt-5 flex items-center justify-center rounded-lg px-5 uppercase text-md font-bold">
            new
            <i class="uil uil-plus-circle m-0 ml-2"></i>
                </button>
        </div>
        
    </WrapperContent>
</template>

<script setup>
import ListReq from '../../Services Components/ListReq.vue';
import Rows from '../../Services Components/Rows.vue';
import WrapperReq from '../../Services Components/WrapperReq.vue';
import TableHeader from '../../Services Components/TableHeader.vue';
import Table from '../../Services Components/Table.vue';

const table = [
    {
        client: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled",
        agency: "Officeof the Mayor",
        fees: "",
        time: "1 min"
    },
    {
        client: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the i when an unknown printer took a galley of type and scrambled",
        agency: "Officeof the Mayor",
        fees: "",
        time: "1 min"
    },
    {
        client: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's",
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
const thead = [
    {
        clientHead: "Client Steps",
        agencyHead: "Agency Steps",
        feesHead: "Fees to Paid",
        processHead: "Processing Time"

    }
]
</script>


<style scoped></style>
