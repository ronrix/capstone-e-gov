<script setup>
import HeaderSection from "../../../components/Header/HeaderSection.vue";
import FooterSection from "../../../components/FooterSection/FooterSection.vue";
import HeroBusinessVue from "../Landing page/HeroBusiness.vue";
import FirstSectionBusiness from "../Landing page/FirstSectionBusiness.vue";
import SecondSectionBusiness from "../Landing page/SecondSectionBusiness.vue";
import ThirdSectionBusiness from "./ThirdSectionBusiness.vue";

</script>

<template>
    <HeaderSection />
    <WrapperContainer>
        <!-- hero section -->
        <HeroBusinessVue />
        <!-- first section -->
        <FirstSectionBusiness />
         <!-- second section -->
         <SecondSectionBusiness />
         <!-- third section -->
         <ThirdSectionBusiness />
    </WrapperContainer>
    
    <FooterSection />
</template>


<style lang="scss" scoped>

</style>