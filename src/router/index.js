import { createRouter, createWebHistory } from "vue-router";

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "Home",
      component: () => import("../views/Home/HomePage.vue")
    },
    {
      path: "/news",
      name: "News",
      component: () => import("../views/News/News.vue")
    },
    {
      path: "/news/:title(.*)",
      name: "NewsSubPage",
      component: () => import("../views/News/NewsSubPage/NewsSubPage.vue")
    },
    /*
    * add your route here
    * copy the example above
    * just modify it based on the components and routes that you're working on
    */ 
    {
      path: "/tourism",
      name: "Tourism",
      component: () => import("../views/Tourism/TourismPage.vue")
    },
    {
      path: "/festivals",
      name: "Festivals",
      component: () => import("../views/Tourism/Festivals.vue")
    },
    {
      path: "/tourist-attractions",
      name: "TouristAttractions",
      component: () => import("../views/Tourism/TouristAttractions.vue")
    },
     // Services starts
    {
      path: "/services",
      name: "Services",
      component: () => import("../views/Services/Landing page/Services.vue")
    },
    {
      path: "/scholarship-program",
      name: "Scholarship Program",
      component: () => import("../views/Services/Office of the Mayor/Scholarship Program/ScholarshipProgram.vue")
    },
    {
      path: "/civil-wedding-program",
      name: "Civil Wedding Program",
      component: () => import("../views/Services/Office of the Mayor/Civil wedding Program/Civil.vue")
    },
    {
      path: "/mayors-clearance",
      name: "Mayors Clearance",
      component: () => import("../views/Services/Office of the Mayor/Mayors Clearance/MayorClearance.vue")
    },
    {
      path: "/government-id",
      name: "Government ID",
      component: () => import("../views/Services/MSWD Department/GovernmentId.vue")
    },
    {
      path: "/replacement-of-senior-citizen",
      name: "Replacement of Senior Citizen",
      component: () => import("../views/Services/MSWD Department/Replacement.vue")
    },
    {
      path: "/technical-assistance-for-farmer",
      name: "Technical Assistance for Farmer",
      component: () => import("../views/Services/Agriculture Department/TechnicalAssistance.vue")
    },
    {
      path: "/treatment-and-vaccination-of-animals",
      name: "Treatment and Vaccination of Animals",
      component: () => import("../views/Services/Agriculture Department/Treatment.vue")
    },
    {
      path: "/technical-assistance-for-farmer",
      name: "Technical Assistance for Farmer",
      component: () => import("../views/Services/Agriculture Department/TechnicalAssistance.vue")
    },
    {
      path: "/distributions-of-assorted-seeds-seedling",
      name: "Distributions of Assorted Seeds or Seedling",
      component: () => import("../views/Services/Agriculture Department/Distribution.vue")
    },
    {
      path: "/delivery-of-farm-fishery-inputs",
      name: "Delivery of Farm & Fishery Inputs",
      component: () => import("../views/Services/Agriculture Department/DeliveryOfFarm.vue")
    },
    {
      path: "/issuance-of-moa-certification",
      name: "Issuance of MOA Certification",
      component: () => import("../views/Services/Agriculture Department/IssuanceOfMoa.vue")
    },
    {
      path: "/capacity-building-enhancement-training",
      name: "Capacity Building Enhancement Training",
      component: () => import("../views/Services/Agriculture Department/CapacityOfBuilding.vue")
    },
    {
      path: "/special-program-employment-for-students",
      name: "Special Program Employment for Students",
      component: () => import("../views/Services/Public Employment Service Office/EmploymentForStudents.vue")
    },
    {
      path: "/job-fair",
      name: "Job Fair",
      component: () => import("../views/Services/Public Employment Service Office/JobFair.vue")
    },
    // Services end

    //business page starts
    {
      path: "/business",
      name: "Business",
      component: () => import("../views/Business/Landing page/Business.vue")
    },
    {
      path: "/business-establishment",
      name: "Business Establishment",
      component: () => import("../views/Business/Business Esablsihment/BusinessEstablishment.vue")
    },
    {
      path: "/apartments",
      name: "Aparment",
      component: () => import("../views/Business/Apartment/ApartmentPage.vue")
    },

    //business page end
    {
      path: "/job-op",
      name: "Job Opportunities",
      component: () => import("../views/JobOp/JobOp.vue")
    },
    {
      path: "/programs-events",
      name: "Programs and Events",
      component: () => import("../views/ProgEvents/ProgEvents.vue")
    },
    {
      path: "/programs-events/:title(.*)",
      name: "ProgramsEventsSubpage",
      component: () => import("../views/ProgEvents/ProgEventsSubPage.vue")
    },
    {
      path: "/emergency-hotlines",
      name: "HotlinesPage",
      component: () => import("../views/Government/Hotlines/HotlinesPage.vue")
    },
    {
      path: "/current-officials",
      name: "CurrentOfficials",
      component: () => import("../views/Government/CurrentOfficials/CurrentOfficials.vue")
    },
    {
      path: "/former-officials",
      name: "FormerOfficials",
      component: () => import("../views/Government/FormerOfficials/FormerOfficials.vue")
    },
    {
      path: "/demographic-profile",
      name: "demographicProfile",
      component: () => import("../views/Government/DemographicProfile/DemographicProfile.vue")
    },
  ]
})