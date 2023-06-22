import { createRouter, createWebHistory } from "vue-router";

//views
import Overview from "../view/groceries/Overview.vue";
import Edit from "../view/groceries/Edit.vue";
import Create from "../view/groceries/Create.vue";

//URLS
// TODO: geef routes een naam en geruik deze voor navigatie zodat code leesbaarder en onderhoudbaarder wordt:
// bij updaten URL hoeft dan maar op 1 plek (hier) de url bijgewerkt te worden en niet in elke pagina waar een
// router-link gebruikt wordt
const routes = [
  { path: "/", component: Overview },
  //   TODO: ongebruikte routes verwijderen
  { path: "/edit", component: Edit },
  { path: "/create", component: Create },
];

//router creation
const router = createRouter({
  history: createWebHistory(),
  routes: routes,
});

export default router;
