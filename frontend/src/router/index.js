import { createRouter, createWebHistory } from "vue-router";
import PetsView from "../views/PetsView.vue";

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: "/",
      name: "pets",
      component: PetsView,
    },
  ],
});

export default router;
