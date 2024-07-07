import './bootstrap';
import {createApp} from "vue";
import router from "./router/router.js";

import App from './App.vue';
console.log('test');
createApp(App).use(router).mount("#app")
