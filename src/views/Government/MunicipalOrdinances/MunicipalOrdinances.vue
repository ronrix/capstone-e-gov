<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import PDFViewer from 'pdf-viewer-vue'
</script>
<template>
  <HeaderSection />
  <WrapperContainer>
    <div class="flex items-center">
      <h1 class="text-2xl md:text-3xl py-10 font-bold dark:text-bggray">Municipal Ordinances</h1>
      <div class="flex-1 border-t-2 border-black dark:border-bggray"></div>
    </div>
    <div class="flex flex-col sm:flex-row gap-5">
      <PDFViewer class="!h-[800px]" source="/sample.pdf" @download="handleDownload" />
      <div class="flex flex-col w-full sm:w-[200px]">
        <h2
          class="text-xl md:text-2xl font-bold border-b-2 border-black dark:border-bggray pb-2 dark:text-bggray"
        >
          Odinances
        </h2>

        <div class="py-3 border-b-[1px] border-dark dark:border-bggray">
          <h3 class="text-base md:text-lg font-semibold mb-2 dark:text-bggray">
            Ordinance of Tourism
          </h3>
          <RouterLink
            class="line-clamp-2 text-xs sm:text-sm dark:text-bggray hover:text-primary dark:hover:text-primary"
            to="/municipal-ordinances/ordinance"
            >M.O. 600 – AN ORDINANCE CREATING A TRUST FUND FOR ALL PHILHEALTH PAYMENTS FOR TSEKAP
            (PCB), TB-DOTS, MCP AND NCP TO GOVERNMENT-OWNED HEALTH CARE PROVIDERS AND REFLECTING
            THAT THE CONCERNED HEALTH CARE PROVIDERS SHALL MANAGE THE TRUST FUND IN ACCORDANCE WITH
            THE GUIDELINES SET BY THE PHILIPPINE HEALTH INSURANCE CORPORATION.</RouterLink
          >
        </div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style>
</style>