import { createRouter, createWebHistory } from "vue-router";

export default createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "Home",
      component: () => import("../views/Home/HomePage.vue")
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
  ]
})