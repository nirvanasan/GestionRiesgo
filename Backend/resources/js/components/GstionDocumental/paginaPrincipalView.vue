<template>
  <div class="fondo">
    <h1>PÁGINA EN CONSTRUCCIÓN</h1>
    <button @click="goBack" class="btn-volver">Volver</button>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router';

const router = useRouter();

const goBack = () => {
  router.go(-1); // Vuelve a la página anterior
};
</script>

<style scoped>
.fondo {
  background-image: url("../img/construccion.jpg"); /* Ruta desde la carpeta 'public' */
  background-size: cover; /* Cubre toda la pantalla */
  background-position: center;
  width: 100%;
  height: 100vh;
  display: flex;
  flex-direction: column; /* Asegura que los elementos se apilen verticalmente */
  justify-content: center; /* Centra verticalmente */
  align-items: center; /* Centra horizontalmente */
  text-align: center;
  color: rgb(253, 254, 247);
  opacity: 90%;
}

h1 {
  font-size: 3rem;
  margin-bottom: 20px;
}

.btn-volver {
  background-color: #ff6600;
  color: white;
  border: none;
  padding: 10px 20px;
  font-size: 1.2rem;
  cursor: pointer;
  border-radius: 5px;
  transition: background 0.3s;
}

.btn-volver:hover {
  background-color: #e65c00;
}
</style>
