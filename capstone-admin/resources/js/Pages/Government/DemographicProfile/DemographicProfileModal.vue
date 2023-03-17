<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative">
      <!-- close modal btn -->
      <i @click="showModal"
        class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <h4 class="capitalize font-bold text-gray-800 text-xl">Add new census</h4>
      <p class="text-gray-500 text-sm mb-3">add the current census gathered for each barangays</p>
      <form @submit.prevent="" class="flex flex-col gap-5">
        <label class="w-full flex flex-col text-gray-800">
          <span class="font-bold text-sm uppercase">
            cencus year
            <i class="uil uil-angle-down"></i>
          </span>
          <input type="text" class="border p-3 focus:outline-blue-600" placeholder="set year">
        </label>
        <table class="text-left w-full">
          <thead>
            <tr class="bg-neutral-200 text-xs md:text-sm">
              <th class="px-2 text-center"><i class="uil uil-list-ui-alt"></i></th>
              <th class="pl-2 py-2 text-neutral-600">
                Barangay
                <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
              <th class="pl-2 py-2 text-neutral-600">
                Total Population
                <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
              <th class="pl-2 py-2 text-neutral-600">
                Number of Household
                <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(barangay, id) in barangays" class="text-xs md:text-sm font-medium border">
              <td class="bg-white text-center">{{ id + 1 }}</td>
              <td class="bg-white border pl-2 border-l-0">{{ barangay }}</td>
              <td class="bg-white border pl-2 border-l-0">
                <textarea
                  class="focus:outline-blue-500 py-3 w-full overflow-scroll no-scrollbar m-0 text-sm h-[40px] max-h-[40ppx]"></textarea>
              </td>
              <td class="bg-white border pl-2 border-l-0">
                <textarea
                  class="focus:outline-blue-500 py-3 w-full overflow-scroll no-scrollbar m-0 text-sm h-[40px] max-h-[40ppx]"></textarea>
              </td>
            </tr>
          </tbody>
        </table>

        <input type="submit" value="create" class="p-3 bg-blue-600 text-white font-bold cursor-pointer">
      </form>
    </div>
  </div>
</template>

<script setup>

const barangays = [
  "Bagumbayan",
  "Halayhayin",
  "Hulo",
  "Imatong",
  "Malaya",
  "Niogan",
  "Quisao",
  "Takungan",
  "Wawa"
]

defineProps({
  showModal: Function,
});
</script>