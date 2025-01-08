import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue'; // Tu componente raíz de Vue
import router from './router.js';

const app = createApp(App);

app.use(router); // Registra el router en la aplicación

app.mount('#app');
app.mount('#registro');
app.mount('#home')
app.mount('#recuperar')
app.mount('#main')
app.mount('#dofa')
app.mount('#eleccion')
app.mount('#proceso')
app.mount('#VerDofa')
app.mount('#clasificacion')
app.mount('#controles')
app.mount('#accion')

app.config.globalProperties.$axios = axios;