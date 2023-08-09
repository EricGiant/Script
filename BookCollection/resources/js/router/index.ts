import { createRouter, createWebHistory } from 'vue-router'

//view import
import BookOverview from "../views/book/Overview.vue";
import BookView from "../views/book/View.vue";
import BookCreate from "../views/book/Create.vue";
import BookEdit from "../views/book/Edit.vue";


//URLS
const routes = [
    {path: "/", component: BookOverview, name: "home"},
    {path: "/book/:bookID", component: BookView, name: "bookView"},
    {path: "/book/create", component: BookCreate, name: "bookCreate"},
    {path: "/book/edit/:bookID", component: BookEdit, name: "bookEdit"},
    {path: "/review/create", component: null, name: "reviewCreate"},
    {path: "/review/edit/:reviewID", component: null, name: "reviewEdit"},
    {path: "/author", component: null, name: "authorView"},
    {path: "/author/create", component: null, name: "authorCreate"},
    {path: "/author/edit/:authorID", component: null, name: "authorEdit"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});