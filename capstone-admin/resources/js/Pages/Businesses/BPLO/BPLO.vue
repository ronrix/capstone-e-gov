<template>
  <HeadTitle title="BPLO"></HeadTitle>
  <div>
   <WrapperContent>
    <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requirements</h3>
        <PwrapperReq>
            <div>
                <PListReq title="1. Application Form (3 copies)" />
                <PListReq title="1.1 Location Sketch" />
                <PListReq title="1.2 2x2 formal picture of logo of business" />
                <PListReq title="1.3 3R size picture of front and exterior of the establishment" />
                <PListReq title="2. Barangay Clearance" />
                <PListReq title="SEC Certificate (Article and Bi-laws) or CDA registration" />
                <PListReq title="Lesson permit and copy of Lease agreement/Lease of Contact or Affidavit of concent" />
                <PListReq title="Insurance Policy or Official receipt of Comprehensive General Liability (CGL)" />
                <PListReq title="Insurance Policy or Official receipt of Comprehensive General Liability (CGL)" />
                <PListReq title="Insurance Policy or Official receipt of Comprehensive General Liability (CGL)" />
            </div>
            <div>
                <PListReq title="PRC ID" />
                <PListReq title="GSIS E-card" />
                <PListReq title="OFW ID" />
                <PListReq title="OWWA ID" />
                <PListReq title="Seamans Book" />
                <PListReq title="Postal ID" />
            </div>
         </PwrapperReq>
        </WrapperContent>
  </div>
</template>

<script setup>
import PListReq from './PermitFormComponents/PListReq.vue';
import WrapperContent from '../../../Components/WrapperContent.vue';
import PwrapperReq from "./PermitFormComponents/PwrapperReq.vue"


</script>

<style lang="scss" scoped>

</style>