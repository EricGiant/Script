import { createRouter, createWebHistory } from 'vue-router'

//view import
import BookOverview from "../views/book/Overview.vue";
import BookView from "../views/book/View.vue";
import BookCreate from "../views/book/Create.vue";
import BookEdit from "../views/book/Edit.vue";
import ReviewEdit from "../views/review/Edit.vue";
import AuthorOverview from "../views/author/Overview.vue";
import AuthorEdit from "../views/author/Edit.vue";


//URLS
const routes = [
    {path: "/", component: BookOverview, name: "home"},
    {path: "/book/:bookID", component: BookView, name: "bookView"},
    {path: "/book/create", component: BookCreate, name: "bookCreate"},
    {path: "/book/edit/:bookID", component: BookEdit, name: "bookEdit"},
    {path: "/review/edit/:reviewID", component: ReviewEdit, name: "reviewEdit"},
    {path: "/author", component: AuthorOverview, name: "authorOverview"},
    {path: "/author/edit/:authorID", component: AuthorEdit, name: "authorEdit"}
];

//router creation
export const router = createRouter({
    history: createWebHistory(),
    routes: routes
});