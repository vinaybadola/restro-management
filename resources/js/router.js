import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./Components/Restaurant.vue"),
    }, 
    {
        path: "/categories", 
        component: () => import("./Components/Categories.vue"),
    },
    // add a fallback route of 404
    {
        path: "/:catchAll(.*)",
        component: () => import("./Components/NotFound.vue"),
    }

];

export default createRouter({
    history: createWebHistory(),
    routes,
});