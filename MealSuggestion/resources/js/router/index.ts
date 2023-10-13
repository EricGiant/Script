import { createWebHistory } from "vue-router";

//view imports
import { createRouter } from "vue-router";
import HomeOverview from "../home/views/Overview.vue";
import IngredientCreate from "../ingredient/views/Create.vue";

//URLS
const routes = [
    { path: "/home", component: HomeOverview, name: "homeOverview" },
    {
        path: "/ingredient/create",
        component: IngredientCreate,
        name: "ingredientCreate",
    },
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
