<template>
    <nav class="flex items-center justify-between gap-3 border border-t-0 border-x-0 relative">
        <RouterLink to="/" class="uppercase font-['display'] font-[700] hover:text-primary py-5">home</RouterLink>
        <div class="group py-5">
            <NavLink to="/goverment" title="government" />
            <SubNavs :subLinks="government" class="group-hover:scale-100" />
        </div>
        <div class="group py-5">
            <NavLink to="/tourism" title="tourism" />
            <SubNavs :subLinks="tourism" class="group-hover:scale-100" />
        </div>

        <!-- logo -->
        <img src="/images/BetterPilillaLogo-black.png" alt="this is a logo" class="w-32">

        <div class="group py-5">
            <NavLink to="/business" title="business" />
            <SubNavs :subLinks="business" class="group-hover:scale-100" />
        </div>

        <div class="group py-5">
            <NavLink to="/services" title="services" />
            <SubNavs :subLinks="services" class="group-hover:scale-100" />
        </div>

        <RouterLink to="/about" class="capitalize hover:text-primary">about</RouterLink>
        <i class="uil uil-search text-lg hover:text-primary cursor-pointer"></i>
    </nav>
</template>

<script setup>
import { RouterLink } from 'vue-router';
import NavLink from './NavLink.vue';
import SubNavs from './SubNavs.vue';

const government = [
    { link: "/news", title: "news", desc: "Current news happening around pililla" },
    { link: "/programs-events", title: "programs and events", desc: "Updated programs and events in pililla" },
    { link: "/job-listings", title: "job opportunities", desc: "Looking for opportunities" },
    { link: "/demographic-profile", title: "demographic profile", desc: "You can see the population growth in pillla" },
    { link: "/hotlines", title: "emergency hotlines", desc: "Call for help/inquiries" },
    { link: "/full-disclosure-report", title: "full disclosure reports", desc: "Transparency for disclosing of the budget of pililla" },
];

const tourism = [
    { link: "/tourist-attractions", title: "tourist attractions", desc: "You can here all the tourists spots in pilila" },
    { link: "/festivals", title: "festivals", desc: "Highlights of the festivals in pililla and its history" },
];

const services = [
    { link: "/scholarship", title: "scholarship", desc: "get to know the process and requirements for getting a scholarship" },
];

const business = [
    { link: "/establishments", title: "business establishments", desc: "Acknowledge the busines establishments in pillla" },
    { link: "/apartments", title: "apartments", desc: "Looking for nice apartment?" },
    { link: "/bplo", title: "BPLO", desc: "Get business permit and licensing office requirements" },
];

</script>
