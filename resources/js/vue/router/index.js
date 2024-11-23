import { createWebHistory, createRouter } from 'vue-router';

const index = () => import('../components/index.vue');
const projectForm = () => import('../components/projectForm.vue');
const taskForm = () => import('../components/taskForm.vue');


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
    {
        name: "projectEdit",
        path: "/project/:id",
        component: projectForm,
    },
    {
        name: "taskForm",
        path: "/task",
        component: taskForm,
    },
    {
        name: "taskEdit",
        path: "/task/:id",
        component: taskForm,
    },
];
const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
});
export default router;
