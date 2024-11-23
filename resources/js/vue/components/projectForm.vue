<template>
    <div class="projects__create ">

        <div class="projects__create__titlebar dflex justify-content-between align-items-center">
            <div class="projects__create__titlebar--item">
                <h1 class="my-1">Add Project</h1>
            </div>
            <div class="projects__create__titlebar--item">

                <div class="customers__titlebar--item">
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
        <!-- Footer Bar -->
        <div class="dflex justify-content-between align-items-center my-3">
            <p ></p>
            <button @click="addProject" class="btn btn-secondary" >Save</button>
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
            editMode: false,
        };
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
            });
        },
    },
};
</script>
