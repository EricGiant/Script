import { createRouter, createWebHistory } from 'vue-router'

//view import
import Overview from "../views/inventory/Overview.vue";
import Create from "../views/inventory/Create.vue";
import Order from "../views/inventory/Order.vue";
import Edit from "../views/inventory/Edit.vue";

//URLS
const routes = [
    {path: "/", component: Overview, name: "home"},
    {path: "/create", component: Create, name: "create"},
    {path: "/order", component: Order, name: "order"},
    {path: "/edit/:productId", component: Edit, name: "edit"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});