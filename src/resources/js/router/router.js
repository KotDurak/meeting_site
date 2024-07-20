import {createRouter, createWebHistory} from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("../Pages/HomeRoute.vue")
    },
    {
        path: "/user/profile",
        component: () => import('../Pages/Users/ProfileCard.vue')
    },
    {
        path: "/profile/:id",
        component: () => import("../Pages/Users/UserCard.vue")
    },
    {
        path: '/register',
        component: () => import("../Pages/RegisterPage.vue"),
    },
    {
        path: '/register/confirm',
        component: () => import("../Pages/RegisterConfirm.vue"),
    },
    {
        path: '/login',
        component: () => import('../Pages/LoginPage.vue'),
    },
    {
        path: "/:pathMatch(.*)*",
        component: () => import("../Pages/NotFound.vue")
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
