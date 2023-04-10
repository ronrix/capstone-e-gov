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
      path: "/about/official-seal",
      name: "OfficialSeal",
      component: () => import("../Pages/About/OfficialSeal/OfficialSeal.vue")
    },
    {
      path: "/about/contacts",
      name: "Contacts",
      component: () => import("../Pages/About/Contacts/Contacts.vue")
    },
    
    //services

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
    
    // Agriculture
    {
      path: "/services/agriculture-department/technical-assistance-for-farmer",
      name: "Technical Assistance for Farmer",
      component: () => import("../Pages/Services/Agriculture Department/Technical Assistance for Farmer/TechnicalAssistanceForFarmer.vue")
    },
    {
      path: "/services/agriculture-department/treatment-and-vaccination-of-animals",
      name: "Treatment and Vaccination of Animals",
      component: () => import("../Pages/Services/Agriculture Department/Treatment and Vaccination of Animals/TreatmentAndVaccinationOfAnimals.vue")
    },
    {
      path: "/services/agriculture-department/distributions-of-assorted-seeds-seedling",
      name: "Distributions of Assorted Seeds or Seedling",
      component: () => import("../Pages/Services/Agriculture Department/Distributions of Assorted Seeds or Seedling/DistributionsOfAssortedSeedsSeedling.vue")
    },
    {
      path: "/services/agriculture-department/delivery-of-farm-fishery-inputs",
      name: "Delivery of Farm & Fishery Inputs",
      component: () => import("../Pages/Services/Agriculture Department/Delivery of Farm & Fishery Inputs/DeliveryOfFarmFisheryInputs.vue")
    },
    {
      path: "/services/agriculture-department/issuance-of-moa-certification",
      name: "Issuance of MOA Certification",
      component: () => import("../Pages/Services/Agriculture Department/Issuance of MOA Certification/IssuanceOfMoaCertification.vue")
    },
    {
      path: "/services/agriculture-department/capacity-building-enhancement-training",
      name: "Capacity Building Enhancement Training",
      component: () => import("../Pages/Services/Agriculture Department/Capacity Building Enhancement Training/CapacityBuildingEnhancementTraining.vue")
    },
    //peso
    {
      path: "/services/public-employment-service-office/special-program-employment-for-students",
      name: "Special Program Employment for Students",
      component: () => import("../Pages/Services/Public Employment Sevice Office/Special Program Employment for Students/SpecialProgramEmploymentForStudents.vue")
    },
    {
      path: "/services/public-employment-service-department/job-fair",
      name: "Job Fair",
      component: () => import("../Pages/Services/Public Employment Sevice Office/Job Fair/JobFair.vue")
    }
  ]
});