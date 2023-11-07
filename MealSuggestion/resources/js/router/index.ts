import { createWebHistory } from "vue-router";

//view imports
import { createRouter } from "vue-router";
import HomeOverview from "../home/pages/Overview.vue";
import IngredientCreate from "../ingredient/pages/Create.vue";
import RecipeCreate from "../recipe/pages/Create.vue";
import StockListCreate from "../ingredient_user/pages/Create.vue";

//URLS
const routes = [
    { path: "/home", component: HomeOverview, name: "homeOverview" },
    {
        path: "/ingredient/create",
        component: IngredientCreate,
        name: "ingredientCreate",
    },
    { path: "/recipe/create", component: RecipeCreate, name: "recipeCreate" },
    {
        path: "/ingredient_user/create",
        component: StockListCreate,
        name: "ingredient_userCreate",
    },
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});
