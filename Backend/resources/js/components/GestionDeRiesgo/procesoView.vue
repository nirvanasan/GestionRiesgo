<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />
    <!-- Barra de navegación -->
    <NavegacionView/>

        <main class="main-content">

          <section class="input-container">

          
              <router-link
                  to="/eleccion"
                  class="btn-atras"
                  >
                  Atrás
              </router-link>
           
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
                  <button type="submit" class="submit-btn" @click="enviar">Registrar Proceso</button>
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
import axios from "axios";

import EncabezadoView from './../EncabezadoView.vue';
import NavegacionView from "./../navegacionView.vue";

export default {
  name: 'MainPage',
  components: {
    EncabezadoView,
    NavegacionView,
  },
  data(){
    return{
      processName: "",
      description: ""
    }
  },
  methods:{
    enviar(){

      const payload = {
        nombre: this.processName,
        descripcion: this.description,
      };
      
      console.log(payload)
      
      //alert("Se ha enviado la infromacion!")
      axios.post('http://127.0.0.1:8000/api/procesos', payload)
      .then(response => {
        this.message = 'Proceso registrado con exito';
        this.isSuccess = true;
        this.processName = '';
        this.description = '';
      })
      .catch(error => {
        this.message = 'Error al registrar el proceso';
        this.isSuccess = false;
        console.error(error);
      }

      )
    }
  }
}
</script>


<style scoped>
.pagina {
  display: grid;
  grid-template-columns: repeat(20, 1fr);
  grid-template-rows: 100px 100px auto;
  background-image: url("../img/Fondo2.png");
  background-position: center center;
  background-size: cover;
  font-family: Arial, sans-serif;
  height: 100vh;
}

.input-container {
  
    justify-content: center; /* Centra horizontalmente el contenido */
    align-items: center; /* Centra verticalmente el contenido */
    height: 400px; /* Opcional: asegura que el contenedor ocupe toda la altura de la ventana */
    padding: 20px;
    border-radius: 15px;
}


.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 480px;
  width: 105%;
  border-radius: 8px;
  justify-content: space-between; /* Espacio entre los elementos */
  align-items: flex-start; /* Alinea los elementos al inicio vertical */
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
  transform: translateX(200px); /* Ajusta el valor según sea necesario */
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
  background-color: #e22424;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
}

.back-btn:hover {
  background-color: #ff0000;
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
  width: 104%;
  padding: 10px;
  background-color: #e22424;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  font-size: 16px;
}

.atras-btn{
  text-align: left;
}

.btn-atras {
  padding: 8px 12px;
  background-color: #c51922;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  text-decoration: none;
  transition: background-color 0.3s;
}

.btn-atras:hover {
  background-color: #fbeb0f;
  color: black;
}

.submit-btn:hover {
  background-color: rgb(255, 251, 0);
  color: black;
}

/* Diseño responsivo */
@media (max-width: 768px) {
  .form-container {
    width: 90%;
  }
}



</style>
