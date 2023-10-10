import { createRouter, createWebHistory } from 'vue-router'

//middlewear
const adminCheck = async () => {
    let user = getUser().value;
    if(user == undefined)
    {
        await getLoggedInUser();
        user = getUser().value;
    }
    
    if(user?.is_admin)
    {
        return true;
    }
    else
    {
        return router.push({name: "ticketOverview"});
    }
}

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
import { getLoggedInUser, getUser } from '../user/store/user';

//URLS
const routes = [
    {path: "/login", component: LoginView, name: "login"},
    {path: "/ticket/overview", component: TicketOverview, name: "ticketOverview"},
    {path: "/ticket/create", component: TicketCreate, name: "ticketCreate"},
    {path: "/ticket/edit/:ticketID", component: TicketEdit, name: "ticketEdit"},
    {path: "/ticket/:ticketID", component: TicketView, name: "ticketView"},
    {path: "/category/overview", component: CategoryOverview, beforeEnter: adminCheck, name: "categoryOverview"},
    {path: "/category/create", component: CategoryCreate, beforeEnter: adminCheck, name: "categoryCreate"},
    {path: "/category/edit/:categoryID", component: CategoryEdit, beforeEnter: adminCheck, name: "categoryEdit"},
    {path: "/login/forgotPassword", component: ForgotPassword, name: "forgotPassword"},
    {path: "/login/editPassword/:token", component: LoginEdit, name: "loginEdit"},
    {path: "/response/edit/:responseID", component: ResponseEdit, beforeEnter: adminCheck, name: "responseEdit"},
    {path: "/user/overview", component: UserOverview, beforeEnter: adminCheck, name: "userOverview"},
    {path: "/user/edit/:userID", component: UserEdit, beforeEnter: adminCheck, name: "userEdit"},
    {path: "/user/create", component: UserCreate, name: "userCreate"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});