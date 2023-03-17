<template>
   <WrapperContent>
    <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requiremnts</h3>
        <WrapperReq>
            <div>
                <ListReq title="Passport" />
                <ListReq title="Voter's ID" />
                <ListReq title="TIN ID" />
                <ListReq title="Philhealth ID" />
                <ListReq title="SSS ID" />
                <ListReq title="UMID ID" />
                <ListReq title="Driver's License" />
                <ListReq title="Other Government ID" />
            </div>
            <div>
                <ListReq title="PRC ID" />
                <ListReq title="GSIS E-card" />
                <ListReq title="OFW ID" />
                <ListReq title="OWWA ID" />
                <ListReq title="Seamans Book" />
                <ListReq title="Postal ID" />
            </div>
        </WrapperReq>
        <h3 class="font-bold text-xl mt-3 mb-3 text-gray-800">What's the process?</h3>
            <Table>
                <TableHeader v-for="(header, index) in thead" :header="header" />
                <Rows v-for="(data, index) in table" :class="{ 'bg-gray-200': index % 2 }" :data="data"
                    class="hover:bg-gray-300" />
            </Table>
      
    </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../../Components/WrapperContent.vue';
import WrapperReq from '../../Services Components/WrapperReq.vue';
import ListReq from '../../Services Components/ListReq.vue';
import TableHeader from '../../Services Components/TableHeader.vue';
import Table from '../../Services Components/Table.vue';
import Rows from '../../Services Components/Rows.vue';

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

<style lang="scss" scoped>

</style>