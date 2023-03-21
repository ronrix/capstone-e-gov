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
      path: "/businesses/BPLO",
      name: "BPLO",
      component: () => import("../Pages/Businesses/BPLO.vue")
    },
    {
      path: "/businesses/ease-of-doing-business",
      name: "EaseOfDoingBusiness",
      component: () => import("../Pages/Businesses/EaseOfDoingBusiness/EaseOfDoingBusiness.vue")
    },
    // about
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
      name: "Scholar",
      component: () => import("../Pages/Services/Office of the Mayor/Scholarship Program/Scholar.vue")
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
    {
      path: "/services/mswd-department/government-id", 
      name: "GovernmentID",
      component: () => import("../Pages/Services/MSWD Department/Government ID/GovernmentId.vue")
    },
    {
      path: "/services/mswd-department/replacement-of-senior-citizen", 
      name: "Replacement of Senior Citizen",
      component: () => import("../Pages/Services/MSWD Department/Replacement Of Senior Citizen/ReplacementOfSeniorCitizen.vue")
    },
    {
      path: "/services/agriculture-department/example",
      name: "Agriculture",
      component: () => import("../Pages/Services/Agriculture Department/Agriculture.vue")
    },
    {
      path: "/services/hr-department/example", 
      name: "Hr",
      component: () => import("../Pages/Services/HR Department/Hr.vue")
    },
  ]
});