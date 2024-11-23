import { createWebHistory, createRouter } from 'vue-router';

const index = () => import('../components/index.vue');
const projectForm = () => import('../components/projectForm.vue');


const routes = [
    {
        name: "index",
        path: "/",
        component: index,
    },
    {
        name: "projectForm",
        path: "/project",
        component: projectForm,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
});
export default router;
