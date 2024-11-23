import './bootstrap';

import { createApp } from 'vue';

import app from './vue/app.vue';

import router from './vue/router';

createApp(app).use(router).mount('#app');
