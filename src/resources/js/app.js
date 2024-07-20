import './bootstrap';
import {createApp} from "vue";
import router from "./router/router.js";
import store from "./store/store.js";

import App from './App.vue';
console.log('test');
createApp(App)
    .use(router)
    .use(store)
    .mount("#app")
