<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import TableRow from './TableRow.vue'

const row = [
  {
    year: '1571',
    desc: 'The first Spanish priests arrived at Pilang Morong on a mission to spread Christianity.'
  },
  {
    year: '1582​',
    desc: 'Fr. Juan de Placencia and Fr. Diego de Oropesa established a “visita” barrio at Pilang Morong. The place was divided by the Spaniards into 5 “rancherias.”'
  },
  {
    year: '1583​',
    desc: 'Pilang Morong became an independent municipality and the newly-formed town was named “Pililla” to indicate a smaller or younger version of Pila.'
  },
  {
    year: '1599​',
    desc: 'The Supreme Government granted Pililla the authority to construct a church.'
  },
  {
    year: '1600 – 1668',
    desc: 'The present church was built and the edifice stands up to this day.'
  },
  {
    year: '1676 -1825',
    desc: 'As an autonomous town, Pililla encompassed several barrios including Tanay and Jalajala. Tanay became an independent town in 1606 and Jalajala was separated and made an independent town in 1786, only to be reincorporated as a barrio of Pililla in 1816. Nine years later, Jalajala was again separated from Pililla to become an independent municipality.'
  },
  {
    year: 'December, 1837',
    desc: 'An election of local officials was held in Pililla participated in by residents of Morong, Pililla,Tanay, Baras, Jalajala, and a new town which was either the barrio of Quisao or Niogan.'
  },
  {
    year: '1853',
    desc: 'Pililla was incorporated to the newly created Distrito de los Montes de San Mateo and named, two years later, as Distrito Politico-Militar de Morong.'
  },
  {
    year: 'March,1861',
    desc: 'The remote Cabeza de Barangay of San Diego petitioned the government that it be made into a self-governing barrio of Pililla. A year later, the government approved the request after San Diego fulfilled the pre-condition to construct the necessary public buildings.'
  },
  {
    year: '1896',
    desc: 'The Katipuneros of Pililla and San Diego established their military camp at Rambo or Pabalang na Gubat.'
  },
  {
    year: 'August, 1898',
    desc: 'Pililla was incorporated in the revolutionary government of Gen. Emilio Aguinaldo.'
  },
  {
    year: 'January, 1899',
    desc: 'A fierce battle between the American forces and the Filipino defenders left Pililla partially ravaged by fire. Local troops retreated to the mountain of Tanay.'
  },
  {
    year: 'June, 1901',
    desc: 'Pililla and San Diego were integrated into the newly created province of Rizal. Two years later, the Philippine Commission consolidated the towns of Pililla, San Diego and Jalajala, with the seat of government in Pililla.'
  },
  {
    year: '1900 -1901',
    desc: 'Regino Quitiong, the alcalde, was the first capitan under the American regime.'
  },
  {
    year: 'September,1907',
    desc: 'Jalajala became an independent municipality while Quisao remained a barrio of Pililla up to the present.'
  },
  {
    year: '1929',
    desc: 'Majority of Jalajala’s tenant population transferred their homes to a new community called Longos in Pililla to avoid agrarian conflict with the plantation owner of Jalajala.'
  },
  {
    year: 'September, 1929',
    desc: 'Don Ananias Vicencio, a philanthropist, donated a tract of land spanning 15 hectares to be distributed and assigned free of charge to residents of Longos.'
  },
  {
    year: 'December, 1942',
    desc: '“Tulisanes” attacked and pillaged the town of Quisao.'
  },
  {
    year: 'March, 1945',
    desc: 'he US Army re-established the municipal government of Pililla. Lucio Aquino, an active guerilla leader, was designated mayor.'
  },
  {
    year: 'June 2016',
    desc: 'In the last political exercise, Hon. Dan Valencia Masinsin has been entrusted by the people of Pililla to lead the town for the next three years.'
  }
]
</script>

<template>
  <head>
    <title>History | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <WrapperContainer>
    <div class="mt-10 flex flex-col">
      <h1
        class="self-start md:self-center text-primary dark:text-primarylight ml-5 md:ml-0 text-2xl md:text-4xl font-bold mb-6"
      >
        A Glimpse of the Past
      </h1>
      <div class="mx-5 lg:mx-20">
        <h2 class="text-gray-800 dark:text-gray-300 font-bold text-lg md:text-2xl">
          The Birth of Pililla
        </h2>
        <!-- <div class="bg-gray-200 flex-1 h-0.5 mt-3"></div> -->
        <p
          class="text-sm md:text-base font-normal text-gray-600 dark:text-white text-justify mt-3 mb-20 border border-gray-200 rounded-lg p-5"
        >
          Pilang Munti, Pililla's pre-Hispanic name, was ruled by a leader named Salyan Maginto. His
          territory encompassed the present-day jurisdiction of the municipalities of Baras, Tanay,
          Pililla and Jalajala. It was named “munti” in contrast to the much larger nearby town of
          Pila in the province of Laguna.
          <br /><br />
          Pililla is an old community, having been founded as an Independent Municipality in 1583.
          Cavada, a Spanish historian, revealed that in the year 1571, the Spanish forces conquered
          the towns along Laguna de Bay which they called “Rinconada de Moron” and Pilang Munti was
          among those which surrendered to the superior force of the Spaniards.
          <br /><br />
          Presently, the town is considered as a first class municipality, one of the 14 political
          subdivisions of the Province of Rizal. It is the easternmost portion of the province
          together with the Municipality of Jalajala.
        </p>
        <div>
          <h2 class="text-gray-800 dark:text-gray-300 font-bold text-lg md:text-2xl mb-3">
            Significant Milestone
          </h2>
          <!-- table -->
          <table class="w-full table-auto">
            <thead class="text-center text-white text-sm md:text-lg">
              <tr>
                <th>Year</th>
                <th>Significance Event</th>
              </tr>
            </thead>
            <tbody class="text-dark text-sm md:text-base md:font-normal">
              <TableRow v-for="(data, idx) in row" :key="idx" :data="data" :idx="idx" />
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style scoped>
th {
  padding: 0.5em 0em;
  background-color: #b92b27;
}
</style>