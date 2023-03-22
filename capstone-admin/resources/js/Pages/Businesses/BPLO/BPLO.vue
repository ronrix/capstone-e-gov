<template>
  <HeadTitle title="BPLO"></HeadTitle>
  <div>
   <WrapperContent>
    <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requirements</h3>
        <PwrapperReq>
            <div class="flex-wrap">
                <PListReq title="1. Application Form (3 copies)" />
                <PListReq title="1.1 Location Sketch" />
                <PListReq title="1.2 2x2 formal picture of logo of business" />
                <PListReq title="1.3 3R size picture of front and exterior of the establishment" />
                <PListReq title="2. Barangay Clearance" />
                <PListReq title="3. SEC Certificate (Article and Bi-laws) or CDA registration" />
                <PListReq title="4. Lesson permit and copy of Lease agreement/Lease of Contact or Affidavit of concent from the Lessor if leasing" />
                <PListReq title="5. Insurance Policy or Official receipt of Comprehensive General Liability (CGL)" />
                <PListReq title="6. Zoning Clearance & Location Clearance" />
                <PListReq title="7. Fire Safety Inspection Certificate" />
                <PListReq title="9. Latest RPT Payment Receipt" />
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