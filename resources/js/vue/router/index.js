import { createWebHistory, createRouter } from 'vue-router';

const index = () => import('../components/index.vue');


const routes = [
    {
        name: "index",
        path: "/",
        component: index,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
});
export default router;
