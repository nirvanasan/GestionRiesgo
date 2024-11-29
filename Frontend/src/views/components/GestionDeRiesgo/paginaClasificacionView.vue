<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView />

      <!-- Barra de navegación -->
       <NavegacionView/>

      <!-- Contenido principal -->
      
      <ContenedorView />
      
    </div>
</template>

<script>
import ContenedorView from "../contenedorView.vue";
import EncabezadoView from "../EncabezadoView.vue";
import NavegacionView from "../navegacionView.vue";


export default {
  name: "MainPage",
  components: {
    EncabezadoView,
    ContenedorView,
    NavegacionView
  },
  
};
</script>

<style scoped>
.pagina {
  display: grid;
  grid-template-columns: repeat(20, 1fr);
  grid-template-rows: 100px 100px auto;
  background-image: url("/src/assets/img/Fondo2.png");
  background-position: center center;
  background-size: cover;
  font-family: Arial, sans-serif;
  height: 100vh;
}

.navigation {
  grid-column: 5 / 17;
  grid-row: 2 / 3;
  margin-top: 50px;
}



.container {
  display: flex;
  justify-content: space-between;
}

.panel {
  flex: 1;
  margin-right: 20px;
}

.panel-section {
  margin-bottom: 20px;
}

h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.list-container {
  border: 1px solid #000;
  padding: 10px;
  height: 150px;
  overflow-y: auto;
}

.inputs {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.input-group {
  margin-bottom: 20px;
}

textarea {
  width: 100%;
  height: 50px;
  resize: none;
}

.inline-input {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.inline-input input {
  margin-left: 10px;
  width: 60px;
}

.buttons {
  display: flex;
  justify-content: space-between;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.limpiar {
  background-color: gold;
  color: black;
}

.ingresar {
  background-color: red;
  color: white;
}
</style>
