import { createRouter, createWebHistory } from "vue-router";
import GenerateIndex from "../components/GenerateIndex.vue";

const routes = [
    {
        path: '/',
        name: 'welcome',
        component: GenerateIndex
  }
];
export default createRouter({
    history: createWebHistory(),
    routes
})