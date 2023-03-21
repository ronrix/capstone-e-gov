<template>
  <HeadTitle title="Business Permit"></HeadTitle>
  <div>
   <WrapperContent>
    <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requirements</h3>
        <PwrapperReq>
            <div>
                <PListReq title="Passport" />
                <PListReq title="Voter's ID" />
                <PListReq title="TIN ID" />
                <PListReq title="Philhealth ID" />
                <PListReq title="SSS ID" />
                <PListReq title="UMID ID" />
                <PListReq title="Driver's License" />
                <PListReq title="Other Government ID" />
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
import PwrapperReq from 



</script>

<style lang="scss" scoped>

</style>