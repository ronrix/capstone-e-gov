<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import { ref, onMounted } from 'vue'
import { fetchData } from '../../../utils/axios-instance'

const contacts = ref()
const socMed = ref()
const axiosCall = () => {
  fetchData('/contacts')
    .then((data) => {
      contacts.value = data.contacts[0]
      socMed.value = data.contacts[1]
    })
    .catch((err) => {
      console.log(err)
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosCall()
})
</script>

<template>
  <head>
    <title>Contacts | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <WrapperContainer>
    <div class="w-full flex flex-col mt-10 mb-20">
      <h1
        class="self-center text-4xl md:text-5xl text-gray-700 dark:text-gray-100 font-bold mb-1 capitalize"
      >
        Contact us!
      </h1>
      <p class="self-center text-lg text-secondary dark:text-gray-400 mb-3 text-center">
        Let us help to assist you wiht your concerns.
      </p>

      <div class="flex flex-col justify-between mt-5 px-10 gap-5 items-center">
        <!-- contacts -->
        <div class="flex flex-col items-center">
          <h2
            class="text-lg md:text-xl font-bold text-dark dark:text-bggray capitalize flex items-center"
          >
            <i class="uil uil-phone text-2xl text-gray-800 dark:text-white"></i>
            Contact numbers
          </h2>
          <div v-if="contacts">
            <div v-for="contact in JSON.parse(contacts.contact_details)" :key="contact.id">
              <p
                v-for="(c, id) in contact"
                :key="id"
                class="text-dark dark:text-bggray text-center"
              >
                {{ c }}
              </p>
            </div>
          </div>
        </div>

        <!-- social media -->
        <div class="flex flex-col items-center">
          <h2 class="text-lg md:text-xl font-bold text-dark dark:text-white capitalize">
            Social Media
          </h2>
          <div v-if="socMed" class="flex flex-col items-center gap-2 mb-3">
            <div v-for="(media, key) in JSON.parse(socMed.contact_details)" :key="media.id">
              <a
                v-for="(link, id) in media"
                :key="id"
                :href="link"
                target="_blank"
                class="hover:text-secondary text-dark dark:text-bggray text-center"
                :class="{ 'pointer-events-none': key === 'gmail' }"
              >
                <i
                  class="uil uil-facebook-f text-xl text-blue-500"
                  :class="{
                    'uil-facebook-f': key === 'facebook',
                    'uil-twitter': key === 'twitter',
                    'uil-envelope': key === 'gmail'
                  }"
                ></i>
                {{ link }}</a
              >
            </div>
          </div>
        </div>
        <!-- business hours -->
        <div class="flex flex-col mb-2 items-center">
          <h2 class="text-lg md:text-xl font-bold text-dark dark:text-bggray capitalize">
            Service hours
          </h2>
          <p class="text-dark dark:text-bggray text-center">Monday - Friday</p>
          <p class="text-dark dark:text-bggray">8 am to 5 pm</p>
        </div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>