import { createRouter, createWebHistory } from "vue-router";

//views
import Overview from "../view/groceries/Overview.vue";
import Edit from "../view/groceries/Edit.vue";
import Create from "../view/groceries/Create.vue";

//URLS
const routes = [
    {path: "/", component: Overview},
    {path: "/edit", component: Edit},
    {path: "/create", component: Create}
];

//router creation
const router = createRouter({
    history: createWebHistory(),
    routes: routes
});

export default router;