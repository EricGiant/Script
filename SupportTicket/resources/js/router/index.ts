import { createRouter, createWebHistory } from 'vue-router'

//view import
import LoginView from "../login/views/View.vue";
import TicketOverview from "../ticket/views/Overview.vue";
import TicketCreate from "../ticket/views/Create.vue";
import TicketEdit from "../ticket/views/Edit.vue";
import TicketView from "../ticket/views/View.vue";
import CategoryOverview from "../category/views/Overview.vue";
import CategoryCreate from "../category/views/Create.vue";
import CategoryEdit from "../category/views/Edit.vue";
import ForgotPassword from "../login/views/ForgetPassword.vue";
import LoginEdit from "../login/views/ResetPassword.vue";
import ResponseEdit from "../responses/views/Edit.vue";
import UserOverview from "../user/view/Overview.vue";
import UserEdit from "../user/view/Edit.vue";
import UserCreate from "../user/view/Create.vue";

//URLS
const routes = [
    {path: "/login", component: LoginView, name: "login"},
    {path: "/ticket/overview", component: TicketOverview, name: "ticketOverview"},
    {path: "/ticket/create", component: TicketCreate, name: "ticketCreate"},
    {path: "/ticket/edit/:ticketID", component: TicketEdit, name: "ticketEdit"},
    {path: "/ticket/:ticketID", component: TicketView, name: "ticketView"},
    {path: "/category/overview", component: CategoryOverview, name: "categoryOverview"},
    {path: "/category/create", component: CategoryCreate, name: "categoryCreate"},
    {path: "/category/edit/:categoryID", component: CategoryEdit, name: "categoryEdit"},
    {path: "/login/forgotPassword", component: ForgotPassword, name: "forgotPassword"},
    {path: "/login/editPassword/:token", component: LoginEdit, name: "loginEdit"},
    {path: "/response/edit/:responseID", component: ResponseEdit, name: "responseEdit"},
    {path: "/user/overview", component: UserOverview, name: "userOverview"},
    {path: "/user/edit/:userID", component: UserEdit, name: "userEdit"},
    {path: "/user/create", component: UserCreate, name: "userCreate"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});