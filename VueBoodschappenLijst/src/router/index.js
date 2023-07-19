import { createRouter, createWebHistory } from "vue-router";

//views
import Overview from "../view/groceries/Overview.vue";
import Edit from "../view/groceries/Edit.vue";
import Create from "../view/groceries/Create.vue";

//URLS
const routes = [
    {path: "/", component: Overview, name: 'home'},
    {path: "/edit/:productId", component: Edit, name: "edit"},
    {path: "/create", component: Create, name: "create"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});