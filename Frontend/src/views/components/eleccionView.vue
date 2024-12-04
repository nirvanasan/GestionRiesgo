<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />
    <!-- Barra de navegación -->

        <main class="main-content">

          <section class="input-container">
              <div class="main-nav">
                  <div class="main-nav__item">
                      <router-link to="/dofa" class="create-account nav-link">Crear dofa</router-link>
                  </div>
                  <div class="main-nav__item">
                      <router-link to="/VerDofa" class="create-account nav-link">Ver dofa</router-link>
                  </div>
                  <div class="main-nav__item">
                      <router-link to="/proceso" class="create-account nav-link">Crear proceso</router-link>
                  </div>
              </div>
          </section>
        </main>
  </div>
</template>

<script>
import EncabezadoView from '../components/EncabezadoView.vue';

export default {
  name: 'MainPage',
  components: {
    EncabezadoView,
  }
}
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


.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 150px;
  width: 105%;
  border-radius: 8px;
}


/* diseño de los botones de eleccion */
.nav-link {
padding: 10px 30px;
color: white;
border-radius: 10px;
text-decoration: none;
background-color: #c91717;
}

.main-nav {
    display: flex;
    gap: 30px; /* Espaciado entre los botones */
    text-align: center;
}

.nav-link:hover {
background-color: white;
color: red;
}

.input-container {
    display: flex;
    justify-content: center; /* Centra horizontalmente el contenido */
    align-items: center; /* Centra verticalmente el contenido */
    height: 100px; /* Opcional: asegura que el contenedor ocupe toda la altura de la ventana */
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(255, 255, 255, 0.1);
}



</style>
