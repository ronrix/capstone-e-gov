<script setup>
import moment from 'moment'

defineProps({
  event: { type: Object, required: true }
})
</script>
<template>
  <RouterLink
    :to="'/programs-events/' + event.title.replace(/\s+/g, '-').replace(/\n/g, ' ').toLowerCase()"
    class="flex border rounded-lg hover:shadow-md cursor-pointer"
  >
    <div
      class="flex flex-col items-center justify-center border border-l-0 border-y-0 py-3 px-5 bg-slate-100"
    >
      <span class="text-2xl font-bold">{{ new Date(event.created_at).getDate() }}</span>
      <span class="text-lg"
        >{{ moment(event.created_at).month(new Date(event.created_at).getMonth()).format('MMM') }}
      </span>
    </div>
    <div class="p-3">
      <h3 class="font-bold text-lg md:text-xl lg:text-2xl">{{ event.title }}</h3>
      <p class="text-xs md:text-sm">
        Hosted by <span class="text-primarylight">{{ event.author }}</span>
      </p>
      <div class="flex items-center text-xs md:text-sm mt-3">
        <i class="uil uil-location-point text-primarylight"></i>
        <span class="capitalize">{{ event.location }}</span>
      </div>
    </div>
  </RouterLink>
</template>