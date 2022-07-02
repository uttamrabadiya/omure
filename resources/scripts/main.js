import { createApp } from 'vue'
import App from './App.vue'
import store from './store'
import router from './routes'
import '../sass/app.scss'
import '@/scripts/plugins/axios.js'

createApp(App)
    .use(store)
    .use(router)
    .mount("#app")
