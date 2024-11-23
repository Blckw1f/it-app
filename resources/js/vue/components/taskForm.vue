<template>
    <div class="projects__create ">

        <div class="projects__create__titlebar dflex align-items-center">
            <div class="projects__create__titlebar--item justify-start">
                <h1 v-if="editMode" class="my-1">Edit Task</h1>
                <h1 v-else class="my-1">Add Task</h1>
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
                    <input id="name" type="text" v-model="task.name" class="input">
                </div>
                <div class="projects__create__main--addInfo card py-2 px-2 bg-white">
                    <label for="name" class="mb-1">Due Date</label>
                    <input id="name" type="date" v-model="task.due_date" class="input">
                </div>
            </div>
        </div>

        <div class="dflex my-1">
            <button v-if="editMode" @click="updateTask" class="btn btn-secondary" >Update</button>
            <button v-else @click="addTask" class="btn btn-secondary" >Save</button>
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
            task: {
                name: "",
                due_date: "",
                project_id: "",
            },
            editMode: false,
        };
    },
    mounted() {
        if (useRoute().name === 'taskEdit'){
            this.editMode = true;
            this.getTask();
        }
    },
    methods: {
        addTask() {
            this.task.project_id = this.$route.query.project;
            axios.post('../api/tasks', this.task).then(
                router.push(-1)
            )
        },
        getTask() {
            const id = this.$route.params.id;
            const path = `../api/tasks/${id}`;
            axios.get(path, this.task).then((response) =>
            {
                this.task = response.data.data;
            });
        },
        updateTask() {
            const id = this.$route.params.id;
            const path = `../api/tasks/${id}`;
            axios.put(path, this.task).then((response) =>
            {
                this.task = response.data.data;
                router.push('/');
            });
        },
    },
};
</script>
