import {createWebHistory, createRouter} from 'vue-router';

// view imports
import HomeOverview from '../home/pages/Overview.vue';
import IngredientCreate from '../ingredient/pages/Create.vue';
import StockListCreate from '../ingredient_user/pages/Create.vue';
import StockListOverview from '../ingredient_user/pages/Overview.vue';
import LoginView from '../login/pages/View.vue';
import RecipeCreate from '../recipe/pages/Create.vue';
import UserCreate from '../user/pages/Create.vue';

// URLS
const routes = [
    {path: '/home', component: HomeOverview, name: 'homeOverview'},
    {
        path: '/ingredient/create',
        component: IngredientCreate,
        name: 'ingredientCreate',
    },
    {path: '/recipe/create', component: RecipeCreate, name: 'recipeCreate'},
    {path: '/login', component: LoginView, name: 'loginView'},
    {path: '/user/create', component: UserCreate, name: 'userCreate'},
    {path: '/ingredient_user/overview', component: StockListOverview, name: 'ingredient_userOverview'},
    {
        path: '/ingredient_user/create',
        component: StockListCreate,
        name: 'ingredient_userCreate',
    },
];

// router creation
export const router = createRouter({
    history: createWebHistory(),
    routes,
});
