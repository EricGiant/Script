import {createWebHistory, createRouter} from 'vue-router';

// view imports
import HomeOverview from '../home/pages/Overview.vue';
import IngredientCreate from '../ingredient/pages/Create.vue';
import StockListCreate from '../ingredient_user/pages/Create.vue';
import StockListOverview from '../ingredient_user/pages/Overview.vue';
import LoginEdit from '../login/pages/EditPassword.vue';
import LoginForgot from '../login/pages/ForgotPassword.vue';
import LoginView from '../login/pages/View.vue';
import RecipeCreate from '../recipe/pages/Create.vue';
import RecipeOverview from '../recipe/pages/Overview.vue';
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
    {path: '/recipe/overview', component: RecipeOverview, name: 'recipeOverview'},
    {path: '/login', component: LoginView, name: 'loginView'},
    {path: '/login/forgot', component: LoginForgot, name: 'loginForgot'},
    {path: '/login/editPassword/:token', component: LoginEdit, name: 'loginEdit'},
    {path: '/ingredient_user/overview', component: StockListOverview, name: 'ingredient_userOverview'},
    {
        path: '/ingredient_user/create',
        component: StockListCreate,
        name: 'ingredient_userCreate',
    },
    {path: '/user/create', component: UserCreate, name: 'userCreate'},
];

// router creation
export const router = createRouter({
    history: createWebHistory(),
    routes,
});
