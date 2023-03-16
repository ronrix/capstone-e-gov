<template>
  <WrapperContent>
    <h3 class="font-bold text-xl mb-3">Municipal Hotlines</h3>
    <!-- hotlines table -->
    <div class="w-full overflow-x-auto">
      <table class="text-left border-separate w-full">
        <thead>
          <tr class="bg-gray-200 text-xs md:text-sm">
            <th>Departments</th>
            <th>Numbers</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="a in hotlines" class="text-xs md:text-sm font-medium">
            <td class="bg-white">
              <p @click="startEditing" class="m-0 p-0">
                {{ a.department }}
                <i class="uil uil-pen text-sm ml-3"></i>
              </p>
              <textarea @blur="stopEditing" v-model="a.department" class="hidden w-full overflow-scroll no-scrollbar m-0 text-sm font-bold h-[20px] max-h-[20ppx]">{{ a.department }}</textarea>
            </td>
            <td class="bg-white">
              <p @click="startEditing" class="m-0 p-0">
                {{ a.number }}
                <i class="uil uil-pen text-sm ml-3"></i>
              </p>
              <textarea @blur="stopEditing" v-model="a.number" class="hidden w-auto overflow-scroll no-scrollbar m-0 text-sm font-bold h-[20px] max-h-[20ppx]">{{ a.number }}</textarea>
            </td>
            <td class="bg-white text-center"><button class="bg-red-600 text-white px-3 text-sm font-bold rounded-md">delete</button></td>
          </tr>
        </tbody>
      </table>
    </div>

  </WrapperContent>
</template>

<script setup>
import { startEditing, stopEditing } from '../../../utils/editFn';

const hotlines = [
  {
    department: "Bureau of Fire Protection",
    number: "091283109",
  },
  {
    department: "Department of Health",
    number: "09981298",
  },
  {
    department: "Department oF Agriculture",
    number: "09292992",
  },
  {
    department: "Department of Sky",
    number: "091290848",
  },
]

</script>

<style scoped>
td, th {
  padding: 1em;
  margin: 0.5em;
}

</style>