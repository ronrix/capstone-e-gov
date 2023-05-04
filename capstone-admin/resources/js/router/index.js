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
    },
    {
      path: "/government/ordinances",
      name: "Ordinances",
      component: () => import("../Pages/Government/Ordinances/Ordinances.vue"),
    },
    {
      path: "/government/programs-and-events",
      name: "ProgramsEvents",
      component: () => import("../Pages/Government/ProgramsEvents/ProgramsEvents.vue")
    },
    {
      path: "/government/executives/current-officials",
      name: "CurrentOfficials",
      component: () => import("../Pages/Government/Executives/CurrentOfficials/CurrentOfficials.vue")
    },
    {
      path: "/government/executives/former-officials",
      name: "FormerOfficials",
      component: () => import("../Pages/Government/Executives/FormerOfficials/FormerOfficials.vue")
    },
    {
      path: "/government/executives/barangay-officials",
      name: "BarangayOfficials",
      component: () => import("../Pages/Government/Executives/BarangayOfficials/BarangayOfficials.vue")
    },
    {
      path: "/government/executives/department-heads",
      name: "DepartmentHeads",
      component: () => import("../Pages/Government/Executives/DepartmentHeads/DepartmentHeads.vue")
    },
    {
      path: "/government/hotlines",
      name: "Hotlines",
      component: () => import("../Pages/Government/Hotlines/Hotlines.vue")
    },
    {
      path: "/government/full-disclosure-reports",
      name: "FullDisclosureReports",
      component: () => import("../Pages/Government/FullDisclosure/FullDisclosure.vue")
    },
    {
      path: "/government/demographic-profile",
      name: "DemographicProfile",
      component: () => import("../Pages/Government/DemographicProfile/DemographicProfile.vue")
    },
    // tourism
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
    // businesses
    {
      path: "/businesses/business-establishments",
      name: "Business Estabishsments",
      component: () => import("../Pages/Businesses/Business Establishments/BusinessEstablishments.vue")
    },
    {
      path: "/businesses/apartments",
      name: "Apartments",
      component: () => import("../Pages/Businesses/Apartments/Apartments.vue")
    },
    {
      path: "/businesses/BPLO",
      name: "BPLO",
      component: () => import("../Pages/Businesses/BPLO/BPLO.vue")
    },
    // about
    {
      path: "/government/official-seal",
      name: "OfficialSeal",
      component: () => import("../Pages/Government/OfficialSeal/OfficialSeal.vue")
    },
    {
      path: "/about/contacts",
      name: "Contacts",
      component: () => import("../Pages/About/Contacts/Contacts.vue")
    },
    
    //services
    {
      path: '/services/:servicePath(.*)', // use a named parameter with a custom regex
      name: 'Service',
      component: () => import("../Pages/Services/Services.vue"),
      props: true
    },
  ]
});