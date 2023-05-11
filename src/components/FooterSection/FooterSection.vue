<script setup>
import { onMounted, ref, watch } from 'vue'

const logoByTheme = ref('/images/better-pililla-white.png')
// Watch localStorage for changes
watch(
  () => localStorage.getItem('theme'),
  (newTheme) => {
    if (newTheme === 'white') {
      // Update logo image source based on localStorage value
      logoByTheme.value = '/images/better-pililla-black.png'
    } else {
      logoByTheme.value = '/images/better-pililla-white.png'
    }
  }
)

// set the appropriate logo
onMounted(() => {
  // Update logo image source based on localStorage value
  if (localStorage.getItem('theme') === 'white') {
    logoByTheme.value = '/images/better-pililla-black.png'
  } else {
    logoByTheme.value = '/images/better-pililla-white.png'
  }
})
</script>
<template>
  <div class="bg-bggray dark:bg-darkgray">
    <WrapperContainer>
      <div class="p-5 grid grid-cols-1 sm:grid-cols-4 mt-10 relative gap-5 dark:text-bggray">
        <!-- logo -->
        <div>
          <img
            src="/images/pililla-logo.png"
            alt="this is the government logo of pililla rizal"
            class="w-32"
          />
          <img :src="logoByTheme" alt="this is the logo of better pilila rizal" class="w-32 mt-5" />
        </div>
        <!-- website navs -->
        <div class="flex flex-col items-start">
          <h6 class="font-bold">Municipality of Pililla</h6>
          <RouterLink to="/about/mission-and-vision">Mission an Vision</RouterLink>
          <RouterLink to="/about/history">History</RouterLink>
          <RouterLink to="/tourism">Tourism</RouterLink>
          <RouterLink to="/job-op">Job Opportunities</RouterLink>
          <div class="flex items-center gap-3">
            <a
              href="https://web.facebook.com/profile.php?id=100064848094892"
              target="_blank"
              class="hover:text-primarylight"
              ><i class="uil uil-facebook text-lg"></i
            ></a>
            <a
              href="https://web.facebook.com/profile.php?id=100064848094892"
              target="_blank"
              class="hover:text-primarylight"
              ><i class="uil uil-instagram text-lg"></i
            ></a>
            <a
              href="https://web.facebook.com/profile.php?id=100064848094892"
              target="_blank"
              class="hover:text-primarylight"
              ><i class="uil uil-twitter text-lg"></i
            ></a>
            <a
              href="https://web.facebook.com/profile.php?id=100064848094892"
              target="_blank"
              class="hover:text-primarylight"
              ><i class="uil uil-youtube text-lg"></i
            ></a>
          </div>
        </div>
        <!-- government links -->
        <div class="flex flex-col items-start">
          <h6 class="font-bold">Government Links</h6>
          <a target="_blank" href="https://op-proper.gov.ph/">Office of the President</a>
          <a href="http://ovp.gov.ph/">Office of the Vice President</a>
          <a href="http://legacy.senate.gov.ph/">Senate of the Philippines</a>
          <a href="http://www.congress.gov.ph/">House of the Representative</a>
          <a href="https://sc.judiciary.gov.ph/">Supreme Court</a>
          <a href="https://ca2.judiciary.gov.ph/caws-war/">Court of the Appeals</a>
          <a href="https://sb.judiciary.gov.ph/">Sandiganbayan</a>
          <a href="https://www.ombudsman.gov.ph/">Office of the Ombudsman</a>
          <a href="http://www.csc.gov.ph/">Civil Services Commission</a>
          <a href="https://www.dilg.gov.ph/">DILG</a>
          <a href="https://www.dbm.gov.ph/">DBM</a>
          <a href="https://blgf.gov.ph/region-4a/">BLGF Region IV-A</a>
          <a href="http://www.rizalprovince.ph/">Provincial Government of Rizal</a>
          <a href="https://asean.org/">ASEAN</a>
          <a href="https://www.un.org/en/">United Nations</a>
        </div>
        <!-- about GOVPH -->
        <div class="flex flex-col items-start">
          <h6 class="font-bold">About GOVPH</h6>
          <p class="mb-5">Learn more about Philippine Government</p>

          <a href="https://www.gov.ph/">GOVPH</a>
          <a href="https://www.officialgazette.gov.ph/">Official Gazete</a>
          <a href="https://data.gov.ph/">Open Data Portal</a>
          <a href="https://www.foi.gov.ph/">Freedom of Information</a>

          <!-- philippine government logos -->
          <img
            src="/images/pilipinas-logo.png"
            alt="this is the logo of the philippines"
            class="w-14 mt-5"
          />
          <img
            src="/images/transparency-logo.png"
            alt="this is the logo of the transparency in the philippines"
            class="w-14 mt-5"
          />
        </div>
      </div>
    </WrapperContainer>
  </div>
</template>
<style scoped>
a {
  font-size: 14px;
}
</style>