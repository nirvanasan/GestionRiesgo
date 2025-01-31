import { createRouter, createWebHistory } from 'vue-router';

// Importa los componentes que usarás en las rutas
import Registro from '@/components/registroView.vue';
import Home from '@/components/loginViewq.vue';
import Main from './components/HomeView.vue';
import Recuperar from './components/recuperarView.vue';
import Dofa from './components/GestionDeRiesgo/pageDofaView.vue';
import Eleccion from './components/GestionDeRiesgo/eleccionView.vue';
import Proceso from './components/GestionDeRiesgo/procesoView.vue';
import VerDofa from './components/GestionDeRiesgo/verDofaView.vue';
import Clasificacion from './components/GestionDeRiesgo/paginaClasificacionView.vue';
import Controles from './components/GestionDeRiesgo/paginaControlesView.vue';
import Accion from './components/GestionDeRiesgo/paginaAccionView.vue';
import Seguimiento from './components/GestionDeRiesgo/paginaSeguimientoView.vue';
import Historial from './components/GestionDeRiesgo/historialView.vue';


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
    {
    path: '/eleccion',
    name: 'eleccion',
    component: Eleccion,
    meta: {
        requiresAuth: true,
        title: "DOFA"
        }
    },
    {
      path: '/proceso',
      name: 'proceso',
      component: Proceso,
      meta: {
          requiresAuth: true,
          title: "DOFA"
          }
    },
    {
      path: '/VerDofa',
      name: 'VerDofa',
      component: VerDofa,
      meta: {
          requiresAuth: true,
          title: "DOFA"
          }
    },
    {
      path: '/clasificacion',
      name: 'clasificacion',
      component: Clasificacion,
      meta: {
          requiresAuth: true,
          title: "Clasificacion"
          }
    },
    {
      path: '/controles',
      name: 'controles',
      component: Controles,
      meta: {
          requiresAuth: true,
          title: "Controles"
          }
    },
    {
      path: '/accion',
      name: 'accion',
      component: Accion,
      meta: {
          requiresAuth: true,
          title: "Accion"
          }
    },
    {
      path: '/seguimiento',
      name: 'seguimiento',
      component: Seguimiento,
      meta: {
          requiresAuth: true,
          title: "Seguimiento"
          }
    },
    {
      path: '/historial',
      name: 'historial',
      component: Historial,
      meta: {
          requiresAuth: true,
          title: "historial"
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
