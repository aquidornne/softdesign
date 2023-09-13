import Home from "@/pages/Home.vue";

import Page404 from "@/pages/404.vue";

const routes = [
  { path: "/", name: "home", component: Home },
  { path: "*", component: Page404 }
];

export default routes;
