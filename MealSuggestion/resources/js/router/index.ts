import { createWebHistory } from 'vue-router'

//view imports
import { createRouter } from "vue-router";
import HomeOverview from "../home/views/Overview.vue";

//URLS
const routes = [
    {path: "/home", component: HomeOverview, name: "homeOverview"}
];

//router creation
export const router = createRouter({history: createWebHistory(), routes: routes});