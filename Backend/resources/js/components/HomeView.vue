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
        <router-link to="/eleccion" class="menu-titulo">AQUÍ</router-link>


        <b><p>GESTIÓN DOCUMENTAL</p></b>
        <router-link to="/GestionDocumental" class="menu-titulo">AQUÍ</router-link>
      </div>

    
      <div class="sub-container right">
        <b><p>Notificaciones</p></b>
        <div class="container3">
          <ul>
            <li v-for="(notification, index) in notifications" :key="index">
              <span v-if="!notification.leida"><span style="color: crimson;"><strong>[Nueva]</strong></span></span>
              {{ notification.mensaje }} - {{ new Date(notification.created_at).toLocaleString() }}
              <button @click="marcarComoLeida(notification.id)" v-if="!notification.leida">Marcar como leída</button>
            </li>
          </ul>
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
      notifications: [],
      user: {}
    };
  },
  mounted() {
    // Verificar si el usuario está autenticado
    const userData = localStorage.getItem('user');
    if (userData) {
      this.user = JSON.parse(userData); // Asignar el objeto usuario desde localStorage
      this.obtenerNotificaciones();
    } else {
      this.$router.push('/login'); // Redirigir si no está autenticado
    }
    this.updateTime();
    setInterval(this.updateTime, 1000);
  },
  methods: {

    obtenerNotificaciones() {
      axios.get(`http://127.0.0.1:8000/api/notificaciones?usuario=${this.user.id}`)
        .then(response => {
          this.notifications = response.data;
        })
        .catch(error => {
          console.error("Error al obtener las notificaciones:", error);
        });
    },
    marcarComoLeida(id) {
      axios.put(`http://127.0.0.1:8000/api/notificaciones/${id}/leida`)
        .then(() => {
          this.notifications = this.notifications.map(n => 
            n.id === id ? { ...n, leida: true } : n
          );
        })
        .catch(error => {
          console.error("Error al marcar la notificación como leída:", error);
        });
    },
    
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
      this.$router.push('/main')
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
  height: 500px;
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

/* Estilo para cuando el botón está en estado hover */
.menu-titulo:hover {
  background-color: #ff0000; /* Cambio de color de fondo */
  color: #faf9f9; /* Cambio de color del texto */
  transform: scale(1.05); /* Efecto de aumento */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para un efecto de profundidad */
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