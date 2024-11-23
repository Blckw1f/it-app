<template>
    <div class="projects__list table  my-3">

        <div class="customers__titlebar dflex justify-content-between align-items-center">
            <div class="customers__titlebar--item">
                <h1 class="my-1">Projects</h1>
            </div>
            <div class="customers__titlebar--item">
                <router-link to="/project" class="btn btn-secondary my-1">Add Project</router-link>
            </div>
        </div>

        <div class="table--heading mt-2 projects__list__heading" style="padding-top: 20px;background:#FFF">
            <p class="table--heading--col2">
                Projects
            </p>
            <p class="table--heading--col3">
                Tasks
            </p>

            <p class="table--heading--col5">Actions</p>
        </div>

        <div class="table--items projects__list__item" v-for="project in projects" :key="project.id" >
            <a href="#" class="table--items--col2">
                {{ project.name }}
            </a>
            <p class="table--items--col2">
                {{ project.tasks.name }}
            </p>
            <div class="dflex justify-end">
                <button @click="this.selectedId = project.id; this.editProject()" class="btn-icon btn-icon-success" >
                    Edit
                </button>
                <button @click="this.selectedId = project.id; this.deleteProject()" class="btn-icon btn-icon-danger" >
                    Del
                </button>
            </div>
        </div>

    </div>
</template>
<script>
import axios from "axios";
import router from "../router/index.js";

export default {
    name: 'index',
    data() {
        return {
            projects: null,
            selectedId: null,
        };
    },
    async mounted() {
        await this.getProjects();
    },
    methods: {
        getProjects() {
            axios.get('../api/projects').then((response) =>
                {
                    this.projects = response.data.data;
                }
            );
        },
        editProject() {
            const id = this.selectedId;
            const path = `/project/${id}`;

            router.push(path);
        },
        deleteProject() {
            const id = this.selectedId;
            const path = `../api/projects/${id}`;
            axios.delete(path).then((response) =>
            {
                this.project = response.data.data;
                this.getProjects();
            });
        },
    },
};
</script>
