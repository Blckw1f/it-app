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
        <!-- Footer Bar -->
        <div class="dflex my-1">
            <button v-if="editMode" @click="updateProject" class="btn btn-secondary" >Update</button>
            <button v-else @click="addProject" class="btn btn-secondary" >Save</button>
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
        updateProject() {
            const id = this.$route.params.id;
            const path = `../api/projects/${id}`;
            axios.put(path, this.project).then((response) =>
            {
                this.project = response.data.data;
                router.push('/');
            });
        },
    },
};
</script>
