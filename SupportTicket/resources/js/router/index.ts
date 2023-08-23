import { createRouter, createWebHistory } from 'vue-router'

//view import
import LoginView from "../login/views/view.vue";
import TicketOverview from "../ticket/views/Overview.vue";

//URLS
const routes = [
    {path: "/login", component: LoginView, name: "login"},
    {path: "/ticketOverview", component: TicketOverview, name: "ticketOverview"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});