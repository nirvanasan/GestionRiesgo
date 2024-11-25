<template>
  <div class="register-page">
    <div class="grid-container">
      <div class="logo">
        <img src="" class="logo-img" />
      </div>
      <!-- Columna izquierda con la imagen -->
      <div class="left-side">
        <img src="" class="login-img" />
      </div>

      <!-- Columna derecha con el formulario -->
      <div class="right-side">
        <div class="reset-card">
          <div class="card-section">
            <h3>Registro de usuario</h3>
          </div>
          <form @submit.prevent="register">
            <div class="input-group">
              <label for="name">Nombre</label>
              <input v-model="name" type="text" id="name" required placeholder="Ingresa tu nombre" />
            </div>

            <div class="input-group">
              <label for="email">Correo</label>
              <input v-model="email" type="email" id="email" required placeholder="Ingresa tu correo" />
            </div>

            <div class="input-group">
              <label for="password">Contraseña</label>
              <input v-model="password" type="password" id="password" required placeholder="Ingresa tu contraseña" />
            </div>

            <div class="input-group">
              <label for="confirmPassword">Repetir Contraseña</label>
              <input v-model="confirmPassword" type="password" id="confirmPassword" required placeholder="Repite tu contraseña" />
            </div>

            <button type="submit" class="submit-btn">Registrarse</button>
          </form>

          <div class="links">
            <router-link to="/" class="back-login">Volver al login</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      username: '',
      email: '',
      password: '',
      confirmPassword: '',
    };
  },
  methods: {
    register() {
      if (this.password !== this.confirmPassword) {
        alert('Las contraseñas no coinciden');
        return;
      }

      // Lógica de registro
      console.log('Nombre:', this.name);
      console.log('Usuario:', this.username);
      console.log('Correo:', this.email);
      console.log('Contraseña:', this.password);
    },
  },
};
</script>

<style scoped>
.register-page {
  height: 100vh;
  display: flex;
  align-items: center; /* Centra verticalmente */
  justify-content: center; /* Centra horizontalmente */
  background-image: url('/src/assets/img/Fondo1.png'); /* Ruta de la imagen de fondo */
  background-size: cover; /* Asegura que la imagen cubra toda la pantalla */
  background-position: center; /* Centra la imagen de fondo */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
  grid-template-rows: repeat(10, 1fr);
  width: 80%;
  max-width: 1200px;
  height: 100%;
}

.left-side {
  display: flex;
  justify-content: center;
  align-items: center;
  grid-column: 3/6;
  grid-row: 3/10;
  border-radius: 10px;
 /* Fondo compuesto */
  background: rgba(245, 225, 164, 0.9) url('/src/assets/img/galletita.svg') no-repeat center;
  background-size: 90% 90%; /* Ajusta la imagen proporcionalmente al contenedor */
  background-position: center; /* Centra la imagen */
}

.right-side {
  background-color: rgb(211, 12, 12);
  display: flex;
  justify-content: center;
  align-items: center;
  grid-column: 6/10;
  grid-row: 3/10;
  border-radius: 10px;
}

.reset-card {
  width: 300px;
  padding: 20px;
  margin: 20px auto;
  border-radius: 10px;
  background-color: transparent;
}

.card-section {
  margin-bottom: 20px;
  text-align: center;
}

h3 {
  margin-top: 10px;
  margin-bottom: 10px;
  color: #000000;
}

.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.input-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #f9f3f3;
  border-radius: 4px;
}

.submit-btn {
  width: 50%;
  padding: 10px;
  background-color: #f4ef86ed;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin: 0 auto; /* Esta propiedad centra el botón */
  display: block; /* Asegura que el botón sea tratado como un bloque */
}

.submit-btn:hover {
  background-color: #acccee;
}

.links {
  display: flex;
  justify-content: center;
  margin-top: 10px;
  text-align: center;
}

.links a {
  display: block;
  color: #000000;
  text-decoration: none;
  margin-bottom: 5px;
}

.links a:hover {
  text-decoration: underline;
}

.logo {
    grid-column: 1/4;
    grid-row: 1/4;
    background-image: url('/src/assets/img/Logo-Tomy.png');
    background-size: cover;
    background-position: 3px;
    background-repeat: no-repeat;
    display: flex;
    width: 200px;
    height: 100px;
  }

/* Estilo responsivo para pantallas pequeñas */
@media (max-width: 768px) {
  .grid-container {
    grid-template-columns: 1fr;
    width: 90%;
  }

  .reset-img {
    max-width: 200px;
  }

  .reset-card {
    /* Puedes ajustar el estilo aquí si es necesario */
  }
}
</style>
