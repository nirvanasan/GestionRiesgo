<!-- src/components/Encabezado.vue -->
<template>
  <div class="container">

    <div class="box1"><RouterLink to="/main" class="logo-link"></RouterLink></div>

    <div class="box1">
      
    </div>


    <div class="box">
      <p> <strong>USUARIO:</strong>  {{ user.name }} </p>
      <p> <strong>FECHA:</strong>  {{ date }}</p>
      <p> <strong>HORA:</strong>  {{ time }}</p>
    </div>
    
    <div class="box">
      <button class="button" @click="logout">
        Cerrar Sesión
      </button>
        <RouterLink to="/main" class="button1">Mis tareas</RouterLink>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      date: new Date().toLocaleDateString(),
      time: new Date().toLocaleTimeString(),
      user:{}
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
    updateTime() {
      const now = new Date();
      this.date = now.toLocaleDateString();
      this.time = now.toLocaleTimeString();
    },
  }
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
  gap:10px;
  
}
.box1 {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-image: url('img/Logo-Tomy.png');
  background-size: 200px;
  background-repeat: no-repeat;
  background-position: center;
  position: relative; /* Necesario para posicionar el enlace */

}

.logo-link {
  position: absolute;
  width: 140px; /* Mismo tamaño que el logo */
  height: 80px;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border-radius: 40%;
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
  text-decoration: none;
  font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

.button {
  background-color: #c51919;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
  text-decoration: none;
  font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}
.button1 {
  background-color: #f8e345;
  color: rgb(0, 0, 0);
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
  text-decoration: none;
  font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
}

.button:hover {
  background-color: #fbeb0f;
}
.button1:hover {
  background-color: #ac9d9d;
}
</style>