<script setup>
defineProps({
  selectedJob: { type: Object, required: true },
  isShowJobModal: { type: Boolean, required: true },
  closeJobModal: { type: Function, required: true }
})
</script>
<template>
  <div
    class="fixed bg-white/50 dark:bg-dark/50 bottom-0 left-0 w-full right-0 h-[70%] border rounded-tl-2xl rounded-tr-2xl duration-100 backdrop-blur-lg z-10"
    :class="{ 'translate-y-0': isShowJobModal, 'translate-y-full': !isShowJobModal }"
  >
    <!-- close btn -->
    <div
      class="border w-14 h-14 items-center justify-center absolute -top-8 left-1/2 -translate-x-1/2 bg-white dark:bg-dark text-dark dark:text-bggray rounded-full cursor-pointer"
      :class="{ hidden: !isShowJobModal, flex: isShowJobModal }"
      @click="closeJobModal"
    >
      <i class="uil uil-times pointer-events-none"></i>
    </div>

    <!-- content -->
    <h1 class="text-3xl font-bold text-center mt-10 text-dark dark:text-bggray">coming soon</h1>
  </div>
</template>