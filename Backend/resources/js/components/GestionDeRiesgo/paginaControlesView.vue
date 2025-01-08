<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />

    <!-- Barra de navegación -->
    <NavegacionView />
    <!-- Contenido principal -->
    <main class="main-content">
      <section class="input-container">
        <div class="left-panel">
          <div class="section">
            <h3>OPORTUNIDAD</h3>
            <select v-model="oportunidadSeleccionada" @change="actualizarSeleccion('oportunidad')">
              <option v-for="op in oportunidades" :key="op.id" :value="op">{{ op.id_elemento + ": " + op.causa }}</option>
            </select>
          </div>
          <div class="section">
            <h3>RIESGO</h3>
            <select v-model="riesgoSeleccionado" @change="actualizarSeleccion('riesgo')">
              <option v-for="riesgo in riesgos" :key="riesgo.id" :value="riesgo">{{ riesgo.id_elemento + ": " +  riesgo.causa }}</option>
            </select>
          </div>
        </div>
        <div class="right-panel">
          <div>
            <h3>CONTROL ACTUAL DEL PROCESO</h3>
            <textarea v-model="causasPotenciales"></textarea>
          </div>

          <div class="probabilidad-container">
            <div>
              <label>Valoracion del control</label>
              <input type="number" v-model="probabilidad" min="1" max="5" />
            </div>
            <div>
              <label>Valoracion del riesgo/oportunidad residual</label>
              <input type="number" v-model="impacto" min="1" max="5" disabled/>
            </div>
          </div>

          <div class="buttons">
            <button @click="limpiar" class="btn limpiar">Limpiar</button>
            <button @click="ingresar" class="btn ingresar">Enviar</button>
          </div>

          <div v-if="error" class="error-message">
            {{ error }}
          </div>

        </div>
      </section>
    </main>
  </div>
</template>

<script>
import axios from "axios";
import EncabezadoView from "../EncabezadoView.vue";
import NavegacionView from "../navegacionView.vue";

export default {
  name: "MainPage",
  components: {
    EncabezadoView,
    NavegacionView,
  },
  data() {
    return {
      oportunidades: [],
      riesgos: [],
      oportunidadSeleccionada: null,
      riesgoSeleccionado: null,
      causasPotenciales: null,
      probabilidad: 1,
      impacto: 1,
      user: {},
      error: null,
    };
  },
  methods: {

    reloadPage() {
      window.location.reload();
    },


    async cargarDatos() {
      try {
       
        const response = await axios.get("http://127.0.0.1:8000/api/cargar-clasificacion");
        const datos = response.data.data;

        console.log(datos);

        // Separar las oportunidades y los riesgos
        this.oportunidades = datos.filter((item) => item.tipo === "Oportunidad");
        this.riesgos = datos.filter((item) => item.tipo === "Riesgo");
      } catch (error) {
        console.log("Error al cargar los datos:");
      }
    },
    actualizarSeleccion(tipo) {
      if (tipo === "oportunidad" && this.oportunidadSeleccionada) {
        this.riesgoSeleccionado = null; // Limpiar selección de riesgo
      } else if (tipo === "riesgo" && this.riesgoSeleccionado) {
        this.oportunidadSeleccionada = null; // Limpiar selección de oportunidad
      }
    },
    limpiar() {
      this.oportunidadSeleccionada = null;
      this.riesgoSeleccionado = null;
      this.causasPotenciales = "";
      this.probabilidad = null;
      this.impacto = null;
    },
    ingresar() {

      // Validar que al menos una opción esté seleccionada
      if (!this.oportunidadSeleccionada && !this.riesgoSeleccionado) {
        this.error = "Debe seleccionar al menos una opción entre oportunidad y riesgo.";
        return;
      }

      // Validar que los campos estén completos
      if (!this.causasPotenciales) {
        this.error = "Debe ingresar una descripción en 'Control actual del proceso'.";
        return;
      }
      if (!this.probabilidad || this.probabilidad < 1 || this.probabilidad > 5) {
        this.error = "Debe ingresar un valor de probabilidad entre 1 y 5.";
        return;
      }
      if (!this.impacto || this.impacto < 1 || this.impacto > 5) {
        this.error = "Debe ingresar un valor de impacto entre 1 y 5.";
        return;
      }

      // Si todo está correcto, enviar los datos
      this.error = "";
      let payload;

      if(this.oportunidadSeleccionada){

        /*
        console.log("Ingresar datos:", {
          id_elemento: this.oportunidadSeleccionada.id_elemento,
          usuario: this.user.id,
          tipo: "Oportunidad",
          descripcion: this.oportunidadSeleccionada.causa,
          control: this.causasPotenciales,
          probabilidad: this.probabilidad,
          impacto: this.impacto,
          
      });
      */

      payload = {

        id_elemento: this.oportunidadSeleccionada.id_elemento,
        usuario: this.user.id,
        tipo: "Oportunidad",
        descripcion: this.oportunidadSeleccionada.causa,
        control: this.causasPotenciales,
        probabilidad: this.probabilidad,
        impacto: this.impacto
      }


      

      } else if (this.riesgoSeleccionado){


        /*
        console.log("Ingresar datos:", {
          id_elemento: this.riesgoSeleccionado.id_elemento,
          usuario: this.user.id,
          tipo: "Riesgo",
          descripcion: this.riesgoSeleccionado.causa,
          control: this.causasPotenciales,
          probabilidad: this.probabilidad,
          impacto: this.impacto,
      });
      */

        payload = {

          id_elemento: this.riesgoSeleccionado.id_elemento,
          usuario: this.user.id,
          tipo: "Riesgo",
          descripcion: this.riesgoSeleccionado.causa,
          control: this.causasPotenciales,
          probabilidad: this.probabilidad,
          impacto: this.impacto
        }

      }


      axios
      .post("http://127.0.0.1:8000/api/cargar-control", payload)
      .then((response) => {

        console.log("Datos enviados correctamente:", response.data);
        alert("Datos ingresados con éxito.");

        this.limpiar(); // Limpiar el formulario después de enviar
        this.reloadPage();
      })
      .catch((error) => {
        console.error("Error al enviar los datos:", error);
        this.error = "Hubo un error al enviar los datos. Por favor, inténtelo de nuevo.";
      });
      //console.log(payload);
      
      },

  },
  mounted() {
    const userData = localStorage.getItem("user");
    if (userData) {
      this.user = JSON.parse(userData);
    }
    this.cargarDatos();
  },
};
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
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
  justify-content: space-between; /* Espacio entre los elementos */
  align-items: flex-start; /* Alinea los elementos al inicio vertical */
}

.input-container {
  display: flex;
  justify-content: space-between;
  gap: 40px;
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

  .left-panel {

padding: 60px;
width: 250px;
margin: 0px 60px;
}

.section {
margin-bottom: 10px;
}

.section select {
width: 300px; /* Cambia este valor según el ancho deseado */
height: 50px; /* Cambia este valor según la altura deseada */
font-size: 14px; /* Aumenta el tamaño del texto si es necesario */
background-color: rgba(240, 248, 255, 0.226);
}

  .right-panel {
  flex: 0 1 50%;
  max-width: 600px;
  padding: 15px;
  border: 1px solid black; /* Línea divisoria */
  border-radius: 8px;
  text-align: center;
  display: flex;
  flex-direction: column;
  gap: 10px; /* Espacio entre los bloques */
}

textarea {
  width: 90%; /* Ancho del textarea */
  height: 140px;
  margin-bottom: 10px;
  resize: none;
  background-color: rgba(245, 245, 245, 0.645);
  border: 1px solid black; /* Opcional: Bordes más visibles */
}

.probabilidad-container {
  display: flex;
  flex-direction: column; /* Alinear en columna */
  gap: 16px; /* Espacio entre filas */
  align-items: center; /* Centrar los campos */
}

.probabilidad-container div {
  display: flex;
  flex-direction: column;
  align-items: center;
  font-size: 16px;
  gap: 5px; /* Espacio entre etiqueta y entrada */
}

input[type="number"] {
  width: 60px;
  padding: 5px;
  text-align: center; /* Centrar el contenido */
  border: 1px solid black; /* Bordes visibles */
  background-color: rgba(245, 245, 245, 0.645);
}

.buttons {
  display: flex;
  gap: 20px; /* Espacio entre los botones */
  justify-content: center; /* Centrado horizontal */
}

.btn {
  padding: 8px 20px;
  border: none;
  border-radius: 30px;
  cursor: pointer;
  font-size: 10px;
  font-weight: bold;
}

.limpiar {
  background-color: #d2b48c;
}

.ingresar {
  background-color: #ff4d4d;
  color: white;
}

.error-message {
  color: red;
  font-size: 14px;
  margin-top: 10px;
}
  /* */
  </style>