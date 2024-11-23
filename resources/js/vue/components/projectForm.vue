<template>
    <div class="projects__create ">

        <div class="projects__create__titlebar dflex align-items-center">
            <div class="projects__create__titlebar--item justify-start">
                <h1 v-if="editMode" class="my-1">Edit Product</h1>
                <h1 v-else class="my-1">Add Product</h1>
            </div>
            <div class="projects__create__titlebar--item">
                <div class="customers__titlebar--item ml-4">
                    <router-link to="/" class="btn btn-secondary my-1">Back</router-link>
                </div>
            </div>
        </div>

        <div class="projects__create__cardWrapper mt-2">
            <div class="projects__create__main">
                <div class="projects__create__main--addInfo card py-2 px-2 bg-white">
                    <label for="name" class="mb-1">Name</label>
                    <input id="name" type="text" v-model="project.name" class="input">
                </div>
            </div>
        </div>

        <div class="dflex my-1">
            <button v-if="editMode" @click="updateProject" class="btn btn-secondary" >Update</button>
            <button v-else @click="addProject" class="btn btn-secondary" >Save</button>
        </div>
        <!-- Tasks -->
        <div class="projects__list table  my-3">

            <div class="customers__titlebar dflex justify-content-between align-items-center">
                <div class="customers__titlebar--item">
                    <h1 class="my-1">Tasks</h1>
                </div>
                <div class="customers__titlebar--item">
                    <router-link :to='path' class="btn btn-secondary my-1">Add Tasks</router-link>
                </div>
            </div>

            <div class="table--heading mt-2 projects__list__heading " style="padding-top: 20px;background:#FFF">
                <p class="table--heading--col2">
                    Tasks
                </p>
                <p class="table--heading--col3">
                    Due Date
                </p>

                <p class="table--heading--col4">Actions</p>
            </div>

            <div class="table--items projects__list__item" v-for="task in tasks" :key="task.id" >
                <a href="#" class="table--items--col2">
                    {{ task.name }}
                </a>
                <p class="table--items--col2">
                    {{ task.due_date }}
                </p>
                <div class="dflex justify-end">
                    <button @click="this.selectedId = task.id; this.editTask()" class="btn-icon btn-icon-success" >
                        Edit
                    </button>
                    <button @click="this.selectedId = task.id; this.deleteProject()" class="btn-icon btn-icon-danger" >
                        Del
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
import axios from 'axios';
import router from "../router/index.js";
import {useRoute} from "vue-router";
export default {
    name: 'project',
    data() {
        return {
            project: {
                name: "",
            },
            tasks: null,
            selectedId: null,
            editMode: false,
        };
    },
    computed: {
        path() {
            return '/task?project='+this.$route.params.id;
        },
    },
    mounted() {
        if (useRoute().name === 'projectEdit'){
            this.editMode = true;
            this.getProject();
        }
    },
    methods: {
        addProject() {
            axios.post('../api/projects', this.project).then(
                router.push('/')
            )
        },
        getProject() {
            const id = this.$route.params.id;
            const path = `../api/projects/${id}`;
            axios.get(path, this.project).then((response) =>
            {
                this.project = response.data.data;
                this.tasks = response.data.data.tasks;
            });
        },
        updateProject() {
            const id = this.$route.params.id;
            const path = `../api/projects/${id}`;
            axios.put(path, this.project).then((response) =>
            {
                this.project = response.data.data;
                router.push('/');
            });
        },
        editTask() {
            const id = this.selectedId;
            const path = `/task/${id}`;

            router.push(path);
        },
    },
};
</script>
