<template>
  <div class="grid">
    <!-- Header Section -->
    <div class="container">
      <div class="box1"></div>
      <div class="box">
        <p>USUARIO: N.N</p>
        <p>FECHA: {{ date }}</p>
        <p>HORA: {{ time }}</p>
      </div>
      <div class="box">
        <button class="button" @click="logout">Cerrar Sesión</button>
      </div>
    </div>

    <br />

    <!-- Main Content Section -->
    <div class="container2">
      <!-- Sidebar Menu -->
      <div class="sub-container left">
        <b><p>GESTIÓN DE RIESGOS</p></b>
        <router-link to="/eleccion" class="menu-titulo"><div>DOFA</div></router-link>

        <b><p>GESTIÓN DOCUMENTAL</p></b>
        <div class="menu-titulo" @click="toggleMenu('menu2')">Documentos</div>
        <ul v-if="activeMenu === 'menu2'" class="menu-opciones">
          <li @click="selectOption('Ver Carpetas')">Ver Carpetas</li>
          <li @click="selectOption('Subir/Eliminar')">Subir/Eliminar</li>
        </ul>
      </div>

      <!-- Notifications Panel -->
      <div class="sub-container right">
        <b><p>TAREAS</p></b>
        <div class="container3">
          <li v-for="(notification, index) in notifications" :key="index">{{ notification }}</li>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      date: new Date().toLocaleDateString(),
      time: new Date().toLocaleTimeString(),
      activeMenu: null,
      notifications: [
        "notificacion 1", "notificacion 2", "notificacion 3", 
        "notificacion 4", "notificacion 5", "notificacion 6",
        "notificacion 7", "notificacion 8", "notificacion 9",
        "notificacion 10", "notificacion 11"
      ]
    };
  },
  methods: {
    logout() {
      alert("Sesión cerrada.");
    },

    selectOption(option) {
      alert(`Opción seleccionada: ${option}`);
      this.activeMenu = null; // Cierra el menú después de seleccionar
    },
  },
};
</script>

<style scoped>
/* Main styling */
.grid {
  display: grid;
  grid-template-columns: repeat(20, 1fr);
  grid-template-rows: 100px auto;
  height: 100vh;
  margin: 0;
  background-image: url('/src/assets/img/Fondo2.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.container {
  grid-column: 5 / 17;
  grid-row: 1 / 2;
  display: flex;
  justify-content: space-between;
  height: 150px;
  border: 2px solid white;
  border-radius: 5px;
  background-color: rgba(255, 255, 255, 0.9);
}

.container2 {
  grid-column: 6 / 20;
  grid-row: 6 / 5;
  display: flex;
  width: 70%;
  height: 550px;
  border-radius: 7px;
}

.sub-container {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  font-size: 20px;
  flex-direction: column;
  opacity: 0.95;
}

.sub-container.left {
  background-color: #d3c384;
  color: black;
  border-top-left-radius: 20px;
  border-bottom-left-radius: 20px;
}

.sub-container.right {
  background-color: #e22424;
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
}

.menu-titulo {
  text-align: center;
  cursor: pointer;
  background-color: white;
  color: black;
  padding: 10px;
  width: 200px;
  border-radius: 8px;
  text-decoration: none;
}

.menu-opciones {
  list-style-type: none;
  padding: 0;
  margin: 0;
  border: 1px solid #ccc;
  width: 200px;
  background-color: white;
}

.menu-opciones li {
  padding: 10px;
  border-bottom: 1px solid #ddd;
  cursor: pointer;
}

.menu-opciones li:hover {
  background-color: #fbeb0fa0;
}

.container3 {
  display: flex;
  height: 400px;
  width: 80%;
  border: 2px solid white;
  border-radius: 10px;
  background-color: rgba(255, 255, 255);
  flex-direction: column;
  color: black;
  overflow-y: scroll;
}

.container3 li {
  padding: 10px;
  background-color: #f9f9f9;
  border-bottom: 1px solid #ddd;
  cursor: pointer;
}

.box {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  
}
.box1 {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-image: url('/src/assets/img/Logo-Tomy.png');
  background-size: 200px; /* Ajusta el tamaño de la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
  background-position: center; /* Mueve el logo hacia abajo */
}

.box p {
  color: black;
  margin: 5px 0;
}

.button {
  background-color: #C51922;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.button:hover {
  background-color: #fbeb0f;
}
</style>