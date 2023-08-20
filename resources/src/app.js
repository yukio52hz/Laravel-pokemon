import './bootstrap';

import {createApp} from 'vue'

import App from '../src/App.vue'
import router from './router/router'

// createApp(App).mount("#app").use(router)

const app = createApp(App)
app.use(router)
app.mount("#app")
