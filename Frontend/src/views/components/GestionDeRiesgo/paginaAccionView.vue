<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView/>
  
      
     
      <!-- Barra de navegación -->
        <NavegacionView/>
      <!-- Contenido principal -->
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
import NavegacionView from "../navegacionView.vue";
  export default {

    components: {
      EncabezadoView,
      NavegacionView
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

  
  .box1 {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-image: url('');
  background-size: 200px; /* Ajusta el tamaño de la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
  background-position: center; /* Mueve el logo hacia abajo */
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
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
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