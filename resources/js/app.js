require('./bootstrap');

import { createApp } from "vue";
import router from "./router";
import GenerateIndex from "./components/GenerateIndex.vue";



createApp({
    components: {
        GenerateIndex
    }

})
    .use(router)
    .mount('#app');