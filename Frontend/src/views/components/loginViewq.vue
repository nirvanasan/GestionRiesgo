<template>
  <div class="login-page">
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
        <div class="login-card">
          <div class="card-section">
            <h3>Login</h3>
          </div>
          <form @submit.prevent="login">
            <div class="input-group">
              <label for="email">Usuario</label>
              <input 
                v-model="email"
                type="email" 
                id="email" 
                required
                placeholder="Ingresa tu email"
              />
            </div>
            <div class="input-group">
              <label for="password">Contraseña</label>
              <input
                v-model="password"
                type="password"
                id="password"
                required
                placeholder="Ingresa tu contraseña"
              />
            </div>
            <div class="div-input-check">
              <input type="checkbox" v-model="remember" id="remember" />
              <label for="remember">Recuérdame</label>
            </div>
            <button type="submit" class="submit-btn" >Iniciar sesión</button>
          </form>
          <div class="links">
            <router-link to="/register" class="create-account"><a router class="create-account">Crear cuenta</a></router-link>
            <router-link to="/recuperar" class="create-account"><a router  class="forgot-password">¿Olvidé la contraseña?</a></router-link>
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
      email: '',
      password: '',
      remember: false,
    };
  },
  methods: {
    login() {
      console.log('Email:', this.email);
      console.log('Password:', this.password);
    }
  }
};
</script>

<style scoped>

body {
  margin: 0; /* Elimina los márgenes del body */
  padding: 0; /* Elimina cualquier relleno */
  height: 100%; /* Asegura que el body ocupe toda la altura del viewport */
}



/* Configuración para el fondo de la página */
.login-page {
  height: 100vh; /* Ocupa toda la altura visible */
  display: flex;
  align-items: center; /* Centra verticalmente */
  justify-content: center; /* Centra horizontalmente */
  background-image: url('/src/assets/img/Fondo1.png'); /* Imagen de fondo */
  background-size: cover; /* La imagen cubre toda el área */
  background-position: center; /* Centra la imagen */
  background-repeat: no-repeat; /* Evita la repetición de la imagen */
  overflow: hidden; /* Evita que el contenido sobrepase los bordes */
}

html, body {
  height: 100%;
  overflow: hidden; /* Evita scroll vertical o horizontal innecesario */
}


.grid-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr) ;
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



.login-card {
    width: 300px;  /* Establece un ancho fijo menor */
    padding: 20px; /* Añade algo de relleno dentro del div */
    margin: 20px auto; /* Centra el div horizontalmente */
    border-radius: 10px; /* Bordes redondeados */
    background-color: transparent ; /* Color de fondo blanco */
  
    
}

.card-section {
  margin-bottom: 20px;
  text-align: center;
}

 
.input-group {
  margin-bottom: 15px;
}

.div-input-check{
  display: flex;
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




.btn2 {
  width: 90%;
  padding: 5px;
  background-color:   rgba(225, 217, 73, 0.542);
  color: rgb(3, 3, 3);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  grid-column: 2/3;
  grid-row: 1/3;

}
.btn1 {
  width: 90%;
  padding: 5px;
  background-color:   rgba(225, 217, 73, 0.542);
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  grid-column: 1/2;
  grid-row: 1/3;

}

.submit-btn:hover {
  background-color: #acccee;
}

.links {
  display: flex;
  justify-content: space-between; 
  margin-top: 10px;
  text-align: left;
  flex-wrap: wrap;
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
  background-image: url('/src/assets/img/Logo-Tomy.png');  /*Reemplaza con la ruta correcta */
  background-size: cover; /* Ajusta la imagen para cubrir todo el div */
  background-position: 3px; /* Centra la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
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

  .login-img {
    max-width: 200px;
  }

  .login-card {
   
  }
  

}
</style>
