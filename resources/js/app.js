
import { createApp } from 'vue';
import App from './App.vue';
import { createRouter, createWebHistory } from 'vue-router';
import Categories from './Components/Categories.vue';
import Restaurant from './Components/Restaurant.vue';

const routes = [
  { path: '/', component: Restaurant },
  { path: '/categories', component: Categories },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp(App)
  .use(router)
  .mount('#app');