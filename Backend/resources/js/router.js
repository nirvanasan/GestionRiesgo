import { createRouter, createWebHistory } from 'vue-router';

// Importa los componentes que usarás en las rutas
import Registro from '@/components/registroView.vue';
import Home from '@/components/loginViewq.vue';
import Main from './components/HomeView.vue';
import Recuperar from './components/recuperarView.vue';
import Dofa from './components/GestionDeRiesgo/pageDofaView.vue';

const routes = [
    {
        path: '/login', // Ruta raíz
        name: 'home',
        component: Home,
        meta: {title: "Login"}
    },
    {
        path: '/registro', 
        name: 'registro',
        component: Registro,
        meta: {title: "Registro"}
    },
    {
        path: '/recuperar',
        name: 'recuperar',
        component: Recuperar,
        meta: {title: "Recuperacion"}
    },
    {
        path: '/main',
        name: 'main',
        component: Main,
        meta: {
            requiresAuth: true,
            title: "Home"
            }
    },
    {
      path: '/dofa',
      name: 'dofa',
      component: Dofa,
      meta: {
          requiresAuth: true,
          title: "DOFA"
          }
  },
];

const router = createRouter({
    history: createWebHistory(), // Usa el modo de historial del navegador
    routes,
});

router.beforeEach((to, from, next) => {

    if (to.meta && to.meta.title) {
        document.title = to.meta.title;
      } else {
        document.title = 'Home'; // Título por defecto
    }

    const isAuthenticated = localStorage.getItem('user') !== null;
    
    if (to.meta.requiresAuth && !isAuthenticated) {
      next('/login'); // Redirige a login si no está autenticado
    } else {
      next(); // Continua con la navegación
    }
  });

export default router;
