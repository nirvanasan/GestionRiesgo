<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView/>
  
      
      <!-- Contenido principal -->
      <!-- Barra de navegación -->
      <nav class="navigation">
        <ul class="main-nav">
          <div class="main-nav__item">
            <router-link to="/dofa" class="create-account"><a router class="nav-link">DOFA</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/clasificacion" class="create-account"><a href="#" class="nav-link">Clasificación</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/controles" class="create-account"><a href="#" class="nav-link">Controles</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/accion" class="create-account"><a href="#" class="nav-link">Acción</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/seguimiento" class="create-account"><a href="#" class="nav-link">Seguimiento</a></router-link>
          </div>
        </ul>
      </nav>
      <main class="main-content">
        <section>
          <h4>Bienvenido a la sección principal</h4>
          <p>Aquí puedes agregar el contenido que desees mostrar.</p>
        </section>
      </main>
    </div>
  </template>
  
  <script>
  import EncabezadoView from '../EncabezadoView.vue';
  export default {
    name: 'MainPage',
    components: {
      EncabezadoView
    }
  };
  </script>
  
  <style scoped>
  .pagina {
    display: grid;
    grid-template-columns: repeat(20, 1fr); /* 20 columnas iguales */
    grid-template-rows: 100px 100px auto; /* Filas más pequeñas */
    background-image: url('/src/assets/img/Fondo2.png');
    background-position: center center;
    background-size: cover;
    font-family: Arial, sans-serif;
    height: 100vh; /* Ocupa el 100% del viewport */

  }
  
  header {
    grid-column: 5 / 17; /* Ocupa todas las columnas */
    grid-row: 1 / 2; /* Ocupa la primera fila */
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 30px;
    background-color: #ffffff;
    box-shadow: 0px 4px 8px rgba(87, 85, 85, 0.8);
    margin-top: 10px;
  }
  
  .navigation {
    grid-column: 5 / 17; /* Ocupa de la columna 5 a la 17 */
    grid-row: 2 / 3; /* Debajo del header */
    margin-top: 50px;
  
  }
  
  .main-nav {
    display: flex;
    justify-content: space-around;
  }
  
  .main-content {
    grid-column: 5 / 17; /* Ocupa de la columna 5 a la 17 */
    grid-row: 3; /* Empieza desde la fila 3 */
    background-color: #ffffff;
    padding: 20px;
    padding-top: 0;
    box-shadow: 0px 4px 8px rgba(87, 85, 85, 0.8);
    height: 350px; /* Ajusta la altura según tus necesidades */
    width: 100%; /* Ajusta el ancho según tus necesidades */
}
  
  .logo {
    max-width: 100px;
    max-height: 100px;
  }
  
  .logout-button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #c91717;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .logout-button:hover {
    background-color: rgba(237, 172, 172, 0.863);
  }
  
  .nav-link {
    padding: 10px 40px;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    background-color: #c91717;
  }
  
  .nav-link:hover {
    background-color: white;
    color: red;
  }

  /* */
  </style>