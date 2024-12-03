<!-- src/components/Encabezado.vue -->
<template>
  <div class="container">
    <div class="box1"></div>
    <div class="box">
        <p>USUARIO: {{ user.name }}</p>
        <p>FECHA: {{ date }}</p>
        <p>HORA: {{ time }}</p>
      </div>
    <div class="box">
      <button class="button" @click="logout">Cerrar Sesión</button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      date: new Date().toLocaleDateString(),
      time: new Date().toLocaleTimeString(),
      user: {},
    };
    
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
.container {
  grid-column: 4 / 19;
  grid-row: 1 / 2;
  display: flex;
  justify-content: space-between;
  height: 150px;
  border: 2px solid white;
  border-radius: 5px;
  background-color: rgba(255, 255, 255, 0.9);
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
  background-image: url('/Frontend/src/assets/img/Logo-Tomy.png');
  background-size: 200px; /* Ajusta el tamaño de la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
  background-position: center; /* Mueve el logo hacia abajo */
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
