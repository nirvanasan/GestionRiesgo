<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView />
  
      <!-- Barra de navegación -->
      <NavegacionView />
  
      <!-- Contenido principal -->
      <main class="main-content">

      </main>
    </div>
  </template>

<script>
import EncabezadoView from './../EncabezadoView.vue';
import NavegacionView from "./../navegacionView.vue";
export default {
  name: 'MainPage',
  components: {
    EncabezadoView,
    NavegacionView,
  }
}
</script>


<style scoped>
.pagina {
    display: grid;
    grid-template-columns: repeat(20, 1fr); /* 20 columnas iguales */
    grid-template-rows: 100px 100px auto; /* Filas más pequeñas */
    background-image: url('../img/Fondo2.png');
    background-position: center center;
    background-size: cover;
    font-family: Arial, sans-serif;
    height: 100vh; /* Ocupa el 100% del viewport */

  }
  .main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
  display: flex; /* Habilita el modelo de Flexbox */
  justify-content: space-between; /* Espacio entre los elementos */
  align-items: flex-start; /* Alinea los elementos al inicio vertical */
}
</style>