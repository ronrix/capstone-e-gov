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
          <a href="">Mission an Vision</a>
          <a href="">History</a>
          <a href="">Departments</a>
          <a href="">Tourism</a>
          <a href="">Job Opportunities</a>
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
          <a href="">Office of the President</a>
          <a href="">Office of the Vice President</a>
          <a href="">Senate of the Philippines</a>
          <a href="">House of the Representative</a>
          <a href="">Supreme Court</a>
          <a href="">Court of the Appeals</a>
          <a href="">Sandiganbayan</a>
          <a href="">Office of the Ombudsman</a>
          <a href="">Civil Services Commission</a>
          <a href="">DILG</a>
          <a href="">DBM</a>
          <a href="">BLGF Region IV-A</a>
          <a href="">Provincial Government of Rizal</a>
          <a href="">ASEAN</a>
          <a href="">United Nations</a>
        </div>
        <!-- about GOVPH -->
        <div class="flex flex-col items-start">
          <h6 class="font-bold">About GOVPH</h6>
          <p class="mb-5">Learn more about Philippine Government</p>

          <a href="">GOVPH</a>
          <a href="">Official Gazete</a>
          <a href="">Open Data Portal</a>
          <a href="">Portal of Information</a>

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