import { createRouter, createWebHistory } from "vue-router";

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/dashboard",
      name: "Dashboard",
      component: () => import("../Pages/Dashboard/Dashboard.vue")
    },
    // government
    {
      path: "/government/news",
      name: "News",
      component: () => import("../Pages/Government/News/News.vue")
    },
    {
      path: "/government/job-postings",
      name: "JobPostings",
      component: () => import("../Pages/Government/JobPostings/JobPostings.vue")
    },
    {
      path: "/government/programs-&-events",
      name: "ProgramsEvents",
      component: () => import("../Pages/Government/ProgramsEvents/ProgramsEvents.vue")
    },
    {
      path: "/government/hotlines",
      name: "Hotlines",
      component: () => import("../Pages/Government/Hotlines/Hotlines.vue")
    },
    // tourism
    {
      path: "/toursim/tourism",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    {
      path: "/toursim/tourist-spots",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    {
      path: "/toursim/festivals",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    {
      path: "/toursim/guidelines",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    // businesses
    {
      path: "/businesses/apartments",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    {
      path: "/businesses/permit-form",
      name: "PermitForm",
      component: () => import("../Pages/Businesses/PermitForm/PermitForm.vue")
    },
    {
      path: "/businesses/ease-of-doing-business",
      name: "EaseOfDoingBusiness",
      component: () => import("../Pages/Businesses/EaseOfDoingBusiness/EaseOfDoingBusiness.vue")
    },
    // about
    {
      path: "/about/mission-and-vision",
      name: "MissionVision",
      component: () => import("../Pages/About/MissionVision/MissionVision.vue")
    },
    {
      path: "/businesses/history",
      name: "History",
      component: () => import("../Pages/About/History/History.vue")
    },
    {
      path: "/businesses/official-seal",
      name: "OfficialSeal",
      component: () => import("../Pages/About/OfficialSeal/OfficialSeal.vue")
    },
    {
      path: "/businesses/contacts",
      name: "Contacts",
      component: () => import("../Pages/About/Contacts/Contacts.vue")
    },
  ]
});