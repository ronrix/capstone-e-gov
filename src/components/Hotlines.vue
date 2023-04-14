<script setup>
const hotlines = [
  {
    id: 1,
    dep: 'Beureau of Fire Protection',
    nums: [
      { name: 'smart', num: '098091283209' },
      { name: 'globe', num: '098091283209' },
      { name: 'landline', num: '0980912' }
    ]
  },
  {
    id: 1,
    dep: 'Police departmment',
    nums: [
      { name: 'smart', num: '098091283209' },
      { name: 'globe', num: '098091283209' },
      { name: 'landline', num: '0980912' }
    ]
  },
  {
    id: 1,
    dep: 'Ambulance number',
    nums: [
      { name: 'smart', num: '098091283209' },
      { name: 'globe', num: '098091283209' },
      { name: 'landline', num: '0980912' }
    ]
  }
]
</script>

<template>
  <div>
    <div class="bg-dark dark:bg-secondary p-5 gap-3">
      <WrapperContainer>
        <h5 class="font-bold flex items-center text-2xl uppercase gap-2">
          <i
            class="uil uil-outgoing-call w-10 h-10 bg-dark dark:bg-bggray rounded-full flex items-center justify-center text-bggray dark:text-dark"
          ></i>
          <span class="text-bggray">pililla emergency hotlines</span>
        </h5>
      </WrapperContainer>
    </div>
    <WrapperContainer class="grid grid-cols-2 items-center w-full">
      <div v-for="n in hotlines" :key="n.id" class="p-3">
        <h6 class="sm:text-base flex-1 font-bold text-dark dark:text-bggray !text-3xl">
          {{ n.dep }}
        </h6>
        <div class="flex-1">
          <p
            v-for="(num, id) in n.nums"
            :key="id"
            class="text-sm sm:text-base rounded-lg text-dark dark:text-bggray"
          >
            0909112908312 ({{ num.name }})
          </p>
        </div>
      </div>
    </WrapperContainer>
  </div>
</template>
