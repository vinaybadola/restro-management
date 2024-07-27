// import "./bootstrap";
// import { createApp } from "vue";

// import Resturant from './Components/Resturant.vue';

// createApp(Resturant).mount("#app");

import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import Categories from './Components/Categories.vue';
import Resturant from './Components/Resturant.vue';

const routes = [
  { path: '/', component: Resturant },
  { path: '/categories', component: Categories },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App)
  .use(router)
  .mount('#app');