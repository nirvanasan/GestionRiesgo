import './bootstrap';

import { createApp } from 'vue';
import App from './components/App.vue'; // Tu componente raíz de Vue
import router from './router.js';

import Login from './components/loginViewq.vue';
import Registro from './components/registroView.vue';
import Recuperar from './components/recuperarView.vue';
import Main from './components/HomeView.vue';
import Dofa from './components/GestionDeRiesgo/pageDofaView.vue';


const app = createApp(App);

app.use(router); // Registra el router en la aplicación

app.mount('#app');
app.mount('#registro');
app.mount('#home')
app.mount('#recuperar')
app.mount('#main')
app.mount('#dofa')


app.config.globalProperties.$axios = axios;