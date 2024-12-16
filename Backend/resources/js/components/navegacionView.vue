<template>
  <nav class="navigation">
    <ul class="main-nav">
      <div class="main-nav__item">
        <router-link 
          to="/eleccion" 
          class="create-account nav-link" 
          :class="{ 'selected': selectedButton === '/eleccion' }"
          @click="selectedButton = '/eleccion'"
        >
          Dofa
        </router-link>
      </div>
      <div class="main-nav__item">
        <router-link 
          to="/clasificacion" 
          class="create-account nav-link" 
          :class="{ 'selected': selectedButton === '/clasificacion' }"
          @click="selectedButton = '/clasificacion'"
        >
          Clasificación
        </router-link>
      </div>
      <div class="main-nav__item">
        <router-link 
          to="/controles" 
          class="create-account nav-link" 
          :class="{ 'selected': selectedButton === '/controles' }"
          @click="selectedButton = '/controles'"
        >
          Controles
        </router-link>
      </div>
      <div class="main-nav__item">
        <router-link 
          to="/accion" 
          class="create-account nav-link" 
          :class="{ 'selected': selectedButton === '/accion' }"
          @click="selectedButton = '/accion'"
        >
          Acción
        </router-link>
      </div>
      <div class="main-nav__item">
        <router-link 
          to="/seguimiento" 
          class="create-account nav-link" 
          :class="{ 'selected': selectedButton === '/seguimiento' }"
          @click="selectedButton = '/seguimiento'"
        >
          Seguimiento
        </router-link>
      </div>
    </ul>
  </nav>
</template>

<script setup>
import { ref } from 'vue';

// Variable reactiva para almacenar el botón seleccionado
const selectedButton = ref('');
</script>

<style scoped>
.navigation {
  grid-column: 5 / 17;
  grid-row: 2 / 3;
  margin-top: 50px;
}

.main-nav {
  display: flex;
  justify-content: space-around;
}

.nav-link {
  padding: 10px 40px;
  color: white;
  border-radius: 10px;
  text-decoration: none;
  background-color: #c91717;
  transition: all 0.3s ease;
}

.nav-link:hover {
  background-color: white;
  color: red;
}

/* Estilo para el botón seleccionado */
.nav-link.selected {
  background-color: white;
  color: red;
  border: 2px solid #c91717; /* Opcional: para destacar */
}
</style>
