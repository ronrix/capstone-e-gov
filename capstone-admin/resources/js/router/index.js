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
      component: () => import("../Pages/Government/JobPostings/JobPostings.vue"),
      redirect: "/government/job-postings/active",
      children: [
        {
          path: "/government/job-postings/active",
          component: () => import("../Pages/Government/JobPostings/Active.vue")
        },
        {
          path: "/government/job-postings/inactive",
          component: () => import("../Pages/Government/JobPostings/Inactive.vue")
        },
      ]
    },
    {
      path: "/government/programs-and-events",
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
      path: "/tourism/tourism",
      name: "Tourism",
      component: () => import("../Pages/Tourism/Tourism.vue")
    },
    {
      path: "/tourism/tourist-spots",
      name: "TouristSpots",
      component: () => import("../Pages/Tourism/TouristSpot.vue")
    },
    {
      path: "/tourism/festivals",
      name: "Festivals",
      component: () => import("../Pages/Tourism/Festival.vue")
    },
    {
      path: "/tourism/guidelines",
      name: "Guidelines",
      component: () => import("../Pages/Tourism/Guidelines.vue")
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
      path: "/about/history",
      name: "History",
      component: () => import("../Pages/About/History/History.vue")
    },
    {
      path: "/about/official-seal",
      name: "OfficialSeal",
      component: () => import("../Pages/About/OfficialSeal/OfficialSeal.vue")
    },
    {
      path: "/about/contacts",
      name: "Contacts",
      component: () => import("../Pages/About/Contacts/Contacts.vue")
    },
    {
      path: "/services/office-of-the-mayor/scholarship-program", 
      name: "CardServices",
      component: () => import("../Pages/Services/Office of the Mayor/Scholarship Program/CardServices.vue")
    },
    {
      path: "/services/office-of-the-mayor/civil-wedding-schedule", 
      name: "Civil",
      component: () => import("../Pages/Services/Office of the Mayor/Civil Wedding Schedule/Civil.vue")
    },
    {
      path: "/services/office-of-the-mayor/mayors-clearance", 
      name: "Mayor",
      component: () => import("../Pages/Services/Office of the Mayor/Mayor's Clearance/Mayor.vue")
    },
  ]
});