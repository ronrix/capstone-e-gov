<template>
    <WrapperContent>
         <WrapperReq>
             <div>
                 <ListReq title="Senior Citizen Fill-Up Form" />
                 <ListReq title="Barangay Certificate" />
                 <ListReq title="Copy of Birth Certificate" />
                 <ListReq title="Any Government Issued ID" />
             </div>
         </WrapperReq>
 
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