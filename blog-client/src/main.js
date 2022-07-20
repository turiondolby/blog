import {createApp} from 'vue'
import App from './App.vue'
import './assets/app.css'
import router from './router';
import store from "./store";
import axios from "axios"

axios.defaults.baseURL = 'http://127.0.0.1:8000/'
axios.defaults.withCredentials = true;

store.dispatch('authenticate').then(() => {
    createApp(App)
        .use(router)
        .use(store)
        .mount('#app')
})
