<script setup>
import { RouterLink } from 'vue-router'
import AssistanceModal from './AssistanceModal.vue'
import { ref } from 'vue'

const isBenefitModal = ref(false)
function showBenefit() {
  isBenefitModal.value = !isBenefitModal.value
}
</script>

<template>
  <div class="flex items-center justify-center flex-col gap-2 relative">
    <RouterLink
      to="/government/news"
      class="flex items-center px-3 rounded-full bg-primary py-1 text-white font-bold text-xs"
    >
      <span class="px-2 bg-white rounded-full text-darkgray mr-3">news</span>
      check this out
      <i class="uil uil-arrow-right arrow-animate" />
    </RouterLink>

    <h3
      class="text-center font-['display'] text-3xl md:text-5xl sm:w-1/2 text-darkgray mt-5 dark:text-bggray font-bold"
    >
      Apply for Assistance/Services
    </h3>
    <p class="text-center text-sm dark:text-bggray">
      <!-- We help connect families to benefits and services that faster health, safety, resilience, and
      opportunity and help them to meet a wide variety of needs. You just have to apply and fill up
      the forms that we provide in here and send all the requirements to us. -->
      Tayo po ay nagbibigay tulong sa pagkokonekta ng mga pamilya sa mga benepisyo at serbisyo na
      nagpapabilis sa kalusugan, kaligtasan, kakayahan, at oportunidad na tumutulong na matugunan
      ang iba't ibang pangangailangan natin. Kailangan lamang po natin na mag-apply at punan ang mga
      form na ibinibigay namin at ipadala ang lahat ng kinakailangang dokumento sa amin.
    </p>

    <!-- buttons -->
    <div class="flex items-center gap-5 mt-5">
      <button
        class="text-sm sm:text-base px-3 py-2 bg-primary font-bold hover:bg-primarylight text-white rounded-md shadow-lg shadow-primarylight/50"
        @click="showBenefit"
      >
        Show services
      </button>
    </div>
  </div>
  <AssistanceModal v-if="isBenefitModal" :show-benefit="showBenefit" />
</template>
<style scoped>
i.arrow-animate {
  animation: arrow-move-infinite infinite 1.5s ease-in-out;
}

@keyframes arrow-move-infinite {
  0% {
    transform: translateX(0);
  }
  50% {
    transform: translateX(0.5em);
  }
  100% {
    transform: translateX(0);
  }
}
</style>