<template>
    <main>
        <router-view :key='router.currentRoute' />
    </main>
</template>
<script setup>
import router from "./router/index.js";
</script>
