import { createRouter, createWebHistory } from 'vue-router'

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Home',
      component: () => import('../views/Home/HomePage.vue')
    },
    {
      path: '/news',
      name: 'News',
      component: () => import('../views/News/News.vue')
    },
    {
      path: '/news/:title(.*)',
      name: 'NewsSubPage',
      component: () => import('../views/News/NewsSubPage/NewsSubPage.vue')
    },
    /*
     * add your route here
     * copy the example above
     * just modify it based on the components and routes that you're working on
     */
    {
      path: '/tourism',
      name: 'Tourism',
      component: () => import('../views/Tourism/TourismPage.vue')
    },
    {
      path: '/festivals',
      name: 'Festivals',
      component: () => import('../views/Tourism/Festivals.vue')
    },
    {
      path: '/tourist-attractions',
      name: 'TouristAttractions',
      component: () => import('../views/Tourism/TouristAttractions.vue')
    },
    // Services starts
    {
      path: '/services',
      name: 'Services',
      component: () => import('../views/Services/LandingPage/Services.vue')
    },
    {
      path: '/services/:title(.*)',
      name: 'ServicesSubContent',
      component: () => import('../views/Services/ServicesSubContent.vue')
    },
    // Services end

    //business page starts
    {
      path: '/business',
      name: 'Business',
      component: () => import('../views/Business/LandingPage/Business.vue')
    },
    {
      path: '/business-establishment',
      name: 'BusinessEstablishment',
      component: () => import('../views/Business/BusinessEstablsihment/BusinessEstablishment.vue')
    },
    {
      path: '/apartments',
      name: 'Aparment',
      component: () => import('../views/Business/Apartment/ApartmentPage.vue')
    },
    {
      path: '/business-permit-and-licensing-office',
      name: 'Business Permit and Licensing Office',
      component: () => import('../views/Business/BPLO/Bplo.vue')
    },
    {
      path: '/apply-your-business',
      name: 'form',
      component: () => import('../views/Business/LandingPage/FormBusiness.vue')
    },
    //business page end

    //about page
    {
      path: '/about/contacts',
      name: 'Contacts',
      component: () => import('../views/About/Contacts/Contacts.vue')
    },
    {
      path: '/about/mission-and-vision',
      name: 'MissionAndVision',
      component: () => import('../../src/views/About/MissionAndVision/MissionAndVision.vue')
    },
    {
      path: '/about/history',
      name: 'History',
      component: () => import('../../src/views/About/History/History.vue')
    },
    {
      path: '/about/FAQ',
      name: 'FAQs',
      component: () => import('../../src/views/About/Faqs/Faqs.vue')
    },
    // aabout page end
    {
      path: '/job-op',
      name: 'Job Opportunities',
      component: () => import('../views/JobOp/JobOp.vue')
    },
    {
      path: '/programs-events',
      name: 'Programs and Events',
      component: () => import('../views/ProgEvents/ProgEvents.vue')
    },
    {
      path: '/programs-events/:title(.*)',
      name: 'ProgramsEventsSubpage',
      component: () => import('../views/ProgEvents/ProgEventsSubPage.vue')
    },
    {
      path: '/emergency-hotlines',
      name: 'HotlinesPage',
      component: () => import('../views/Government/Hotlines/HotlinesPage.vue')
    },
    {
      path: '/current-officials',
      name: 'CurrentOfficials',
      component: () => import('../views/Government/CurrentOfficials/CurrentOfficials.vue')
    },
    {
      path: '/former-officials',
      name: 'FormerOfficials',
      component: () => import('../views/Government/FormerOfficials/FormerOfficials.vue')
    },
    {
      path: '//official-seal',
      name: 'OfficialSeal',
      component: () => import('../views/Government/OfficialSeal/OfficialSeal.vue')
    },
    {
      path: '/demographic-profile',
      name: 'demographicProfile',
      component: () => import('../views/Government/DemographicProfile/DemographicProfile.vue')
    },
    {
      path: '/tourist-attractions/:title(.*)',
      name: 'TouristAttractionsSubPage',
      component: () => import('../views/Tourism/TourismSubpage/TourismSubpage.vue')
    },
    {
      path: '/festivals/:title(.*)',
      name: 'FestivalsSubPage',
      component: () => import('../views/Tourism/TourismSubpage/TourismSubpage.vue')
    }
  ]
})
