import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/components/HomeView.vue'
import AboutView from '../views/AboutView.vue'
import LoginView from '@/views/components/loginViewq.vue'
import RegistroView from '@/views/components/registroView.vue'
import RecuperarView from '@/views/components/recuperarView.vue'
import PageDofaView from '@/views/components/GestionDeRiesgo/pageDofaView.vue'
import PaginaControlesView from '@/views/components/GestionDeRiesgo/paginaControlesView.vue'
import PaginaAccionView from '@/views/components/GestionDeRiesgo/paginaAccionView.vue'
import PaginaSeguimientoView from '@/views/components/GestionDeRiesgo/paginaSeguimientoView.vue'
import PaginaClasificacionView from '@/views/components/GestionDeRiesgo/paginaClasificacionView.vue'

const routes = [
  {
    path: '/home',
    name: 'home',
    component: HomeView,
    
    children:[
     
    ],
  },

  {
    path: '/dofa',
    name: 'dofa',
    component: PageDofaView
  },

 

  // Ruta para About
  {
    path: '/about',
    name: 'about',
    component: AboutView,
  },

  

  // Rutas relacionadas con autenticación
  {
    path: '/',
    name: 'login',
    component: LoginView,
  },

  
  {
    path: '/register',
    name: 'register',
    component: RegistroView,
  },
  {
    path: '/recuperar',
    name: 'recuperar',
    component: RecuperarView,
  },

  
  {
    path: '/controles',
    name: 'controles',
    component: PaginaControlesView
  },
  {
    path: '/accion',
    name: 'accion',
    component: PaginaAccionView
  },
  {
    path: '/seguimiento',
    name: 'seguimiento',
    component: PaginaSeguimientoView
  },
  {
    path: '/clasificacion',
    name: 'clasificacion',
    component: PaginaClasificacionView
  },
  
   
  



]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
