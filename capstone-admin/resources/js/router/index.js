import { createRouter, createWebHistory } from "vue-router";

export const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/dashboard",
      name: "Dashboard",
      component: () => import("../Pages/Dashboard/Dashboard.vue")
    },
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
    {
      path: "/businesses/apartments",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    {
      path: "/businesses/apartments",
      name: "PermitForm",
      component: () => import("../Pages/Businesses/PermitForm/PermitForm.vue")
    },
    {
      path: "/businesses/apartments",
      name: "Apartments",
      component: () => import("../Pages/Businesses/EaseOfDoingBusiness/EaseOfDoingBusiness.vue")
    },
  ]
});