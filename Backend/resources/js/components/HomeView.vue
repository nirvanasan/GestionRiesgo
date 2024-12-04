<template>
  <div class="grid">
    <!-- Header Section -->
    <div class="container">
      <div class="box1"></div>
      <div class="box">
        
        <p> <strong>USUARIO:</strong>  {{ user.name }} </p>
        <p> <strong>FECHA:</strong>  {{ date }}</p>
        <p> <strong>HORA:</strong>  {{ time }}</p>

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
        <router-link to="/eleccion" class="menu-titulo">DOFA</router-link>


        <b><p>GESTIÓN DOCUMENTAL</p></b>
        <div class="menu-titulo" @click="toggleMenu('menu2')">Documentos</div>
        <ul v-if="activeMenu === 'menu2'" class="menu-opciones">
          <li @click="selectOption('Ver Carpetas')">Ver Carpetas</li>
          <li @click="selectOption('Subir/Eliminar')">Subir/Eliminar</li>
        </ul>
      </div>

    
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
axios.defaults.withCredentials = true;


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
      ],
      user: {}
    };
  },
  mounted() {
    // Verificar si el usuario está autenticado
    const userData = localStorage.getItem('user');
    if (userData) {
      this.user = JSON.parse(userData); // Asignar el objeto usuario desde localStorage
    } else {
      this.$router.push('/login'); // Redirigir si no está autenticado
    }
    this.updateTime();
    setInterval(this.updateTime, 1000);
  },
  methods: {
    logout() {
      localStorage.removeItem('user'); // Elimina los datos del usuario
      //alert("Sesión cerrada.");
      localStorage.removeItem('token');
      this.$router.push('/login'); // Redirigir a la página de login
    },
    toggleMenu(menu) {
      // Alterna entre abrir/cerrar el menú seleccionado
      this.activeMenu = this.activeMenu === menu ? null : menu;
      
    },
    selectOption(option) {
      
      this.activeMenu = null; // Cierra el menú después de seleccionar
      this.$router.push('/dofa')
    },
    updateTime() {
      const now = new Date();
      this.date = now.toLocaleDateString();
      this.time = now.toLocaleTimeString();
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
  background-image: url('img/Fondo2.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.container {
  font-family:'Courier New', Courier, monospace;
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
  grid-row: 5 / 5;
  display: flex;
  width: 70%;
  height: 550px;
  border-radius: 7px;
  padding-top: 8%;
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
  background-image: url('img/Logo-Tomy.png');
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