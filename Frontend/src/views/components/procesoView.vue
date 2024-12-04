<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />
    <!-- Barra de navegación -->
    <NavegacionView/>

        <main class="main-content">

          <section class="input-container">

            <!-- Botón de Ir Atrás 
            <div class="back-button-container">
              <button @click="goBack" class="back-btn">← Ir Atrás</button>
            </div>-->
            <div class="form-container">
              <div class="form-card">
                <div class="card-header">
                  <h3>Formulario de Inscripción de Proceso</h3>
                </div>
                <form @submit.prevent="registerProcess">
                  <div class="input-group">
                    <label for="process-name">Nombre del Proceso</label>
                    <input 
                      v-model="processName" 
                      type="text" 
                      id="process-name" 
                      required 
                      placeholder="Ingresa el nombre del proceso" 
                    />
                  </div>
                  <div class="input-group">
                    <label for="description">Descripción</label>
                    <textarea 
                      v-model="description" 
                      id="description" 
                      rows="5" 
                      required 
                      placeholder="Ingresa una descripción del proceso"
                    ></textarea>
                  </div>
                  <button type="submit" class="submit-btn">Registrar Proceso</button>
                </form>
                <div v-if="message" :class="{'success-message': isSuccess, 'error-message': !isSuccess}">
                  {{ message }}
                </div>
              </div>
            </div>
      
          </section>
        </main>
  </div>
</template>

<script>
import EncabezadoView from '../components/EncabezadoView.vue';
import NavegacionView from "../components/navegacionView.vue";
export default {
  name: 'MainPage',
  components: {
    EncabezadoView,
    NavegacionView,
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

.input-container {
    display: flex;
    justify-content: center; /* Centra horizontalmente el contenido */
    align-items: center; /* Centra verticalmente el contenido */
    height: 400px; /* Opcional: asegura que el contenedor ocupe toda la altura de la ventana */
    padding: 20px;
    border-radius: 15px;
}


.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  padding: 10px;
  height: 450px;
  width: 105%;
  border-radius: 8px;
}

/* diseño de agregar proceso */


/* Contenedor del formulario */
.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  max-width: 600px;
  padding: 40px;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Tarjeta del formulario */
.form-card {
  width: 90%;
  position: relative; /* Posiciona elementos relativos dentro de la tarjeta */
}

.back-button-container {
  position: absolute;
  top: 10px; /* Ajusta la distancia desde el borde superior */
  left: 60px; /* Ajusta la distancia desde el borde izquierdo */
  z-index: 100;
}

.back-btn {
  padding: 8px 15px;
  background-color: #f4ef86ed;
  color: #000;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
}

.back-btn:hover {
  background-color: #acccee;
}

/* Encabezado */
.card-header {
  margin-bottom: 20px;
  text-align: center;
  font-family: 'Lucida Sans', 'Arial', sans-serif;
}

/* Mensajes de éxito y error */
.success-message {
  color: green;
  margin-top: 10px;
  text-align: center;
}

.error-message {
  color: red;
  margin-top: 10px;
  text-align: center;
}

/* Estilo de los campos */
.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.input-group input,
.input-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}

/* Botón de enviar */
.submit-btn {
  width: 100%;
  padding: 10px;
  background-color: #f4ef86ed;
  color: #000;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  font-size: 16px;
}

.submit-btn:hover {
  background-color: #acccee;
}

/* Diseño responsivo */
@media (max-width: 768px) {
  .form-container {
    width: 90%;
  }
}



</style>
