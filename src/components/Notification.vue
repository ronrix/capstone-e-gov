<script setup>
defineProps({
  notification: { type: Object, required: true }
})
</script>
<template>
  <div
    class="px-3 py-2 rounded-sm text-white w-full mb-3 flex flex-col"
    :class="{
      'bg-green-500': notification.status == 200,
      'bg-red-500': notification.status != 200
    }"
  >
    <span class="font-[600] text-xs uppercase">notification</span>
    {{ notification.msg }}
  </div>
</template>