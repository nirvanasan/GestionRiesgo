<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />

    <!-- Barra de navegación -->
    <NavegacionView />

    <!-- Contenido principal -->
    <main class="main-content">
      <!-- Sección izquierda: Cuadro de texto del control actual -->
      <div class="left-section">
        <label for="control-actual">Control Actual del Proceso:</label>
        <textarea id="control-actual" v-model="controlActual"></textarea>
        
        <!-- Opciones de Sí o No -->
        <div class="options-group">
          <div class="option">
            <label>¿Cambió el valor del riesgo u oportunidad residual?</label>
            <input type="radio" id="documentado-si" value="Sí" v-model="documentado" />
            <label for="documentado-si">Sí</label>
            <input type="radio" id="documentado-no" value="No" v-model="documentado" />
            <label for="documentado-no">No</label>
          </div>
          
          <div class="option">
            <label>¿Se eliminó la causa raíz de la NC? ¿Se aprovechó la oportunidad? ¿O se mitigó el riesgo?</label>
            <input type="radio" id="implementado-si" value="Sí" v-model="implementado" />
            <label for="implementado-si">Sí</label>
            <input type="radio" id="implementado-no" value="No" v-model="implementado" />
            <label for="implementado-no">No</label>
          </div>
          
          <div class="option">
            <label>¿Se hizo el cierre eficaz de las acciones del riesgo/oportunidad?</label>
            <input type="radio" id="cierre-si" value="Sí" v-model="cierre" />
            <label for="cierre-si">Sí</label>
            <input type="radio" id="cierre-no" value="No" v-model="cierre" />
            <label for="cierre-no">No</label>
          </div>
          
          <div class="option">
            <label>¿Se genera un nuevo riesgo u oportunidad?</label>
            <input type="radio" id="riesgoN-si" value="Sí" v-model="riesgoN" />
            <label for="riesgoN-si">Sí</label>
            <input type="radio" id="riesgoN-no" value="No" v-model="riesgoN" />
            <label for="riesgoN-no">No</label>
          </div>
        </div>
      </div>

      <div class="right-section">
        <!-- Parte superior: Oportunidad y Riesgo -->
        <div class="section">
          <h3>Acion</h3>
          <select v-model="AcionSeleccionada" @change="actualizarSeleccion('Acion')">
            <option v-for="op in Aciones" :key="op.id" :value="op">{{ op.id_elemento + ": " + op.descripcion }}</option>
          </select>
        </div>
       

        <!-- Parte inferior: campos principales en dos columnas -->
        <div class="main-fields-container">
          <!-- Primera columna -->
          <div class="group">
            <div class="form-group">
              <label for="probabilidad">Probabilidad:</label>
              <input type="number" id="probabilidad" v-model="probabilidad" min="0" max="5" />
            </div>
            <div class="form-group">
              <label for="impacto">Impacto:</label>
              <input type="number" id="impacto" v-model="impacto" min="0" max="5" />
            </div>
            <div class="form-group">
              <label for="valoracion-control">Valoración del Control:</label>
              <input type="number" id="valoracion-control" v-model="valoracionControl" min="0" max="5" />
            </div>
          </div>

          <!-- Segunda columna -->
          <div class="group">
            <div class="form-group">
              <label for="fecha">Fecha:</label>
              <input type="date" id="fecha" v-model="fecha" />
            </div>
            <div class="form-group">
              <label for="valoracion-riesgo">Valoración del Riesgo:</label>
              <input type="number" id="valoracion-riesgo" :value="valoracionRiesgo" readonly />
            </div>
            <div class="form-group">
              <label for="valoracion-total">Valoración Total:</label>
              <input type="number" id="valoracion-total" :value="valoracionTotal" readonly />
            </div>
          </div>
        </div>

        <!-- Botones -->
        <div class="valor-botones">
          <button @click="limpiarFormulario">Limpiar</button>
          <button @click="enviarFormulario">Enviar</button>
        </div>


        
      </div>
    </main>
  </div>
</template>



<script>
import EncabezadoView from "./../EncabezadoView.vue";
import NavegacionView from "./../navegacionView.vue";

export default {
  name: "MainPage",
  components: {
    EncabezadoView,
    NavegacionView,
  },
  data() {
    return {
      documentado: null,
      implementado: null,
      cierre: null,
      riesgoN: null,
      fecha: "", 
      probabilidad: 0,
      impacto: 0,
      controlActual: "", 
      valoracionControl: 0,
    };
  },
  computed: {
    valoracionRiesgo() {
      return this.probabilidad * this.impacto;
    },
    valoracionTotal() {
      return this.valoracionRiesgo * this.valoracionControl;
    },
  },
  methods: {
    enviarFormulario() {
      if (
        this.controlActual &&
        this.documentado &&
        this.implementado &&
        this.cierre &&
        this.riesgoN &&
        this.fecha
      ) {
        console.log("Datos del formulario:", {
          controlActual: this.controlActual,
          documentado: this.documentado,
          implementado: this.implementado,
          cierre: this.cierre,
          riesgoN: this.riesgoN,
          fecha: this.fecha,
          probabilidad: this.probabilidad,
          impacto: this.impacto,
          valoracionControl: this.valoracionControl,
          valoracionRiesgo: this.valoracionRiesgo,
          valoracionTotal: this.valoracionTotal,
        });
      } else {
        alert("Todos los campos son obligatorios.");
      }
    },
    limpiarFormulario() {
      this.controlActual = "";
      this.documentado = null;
      this.implementado = null;
      this.cierre = null;
      this.riesgoN = null;
      this.fecha = "";
      this.probabilidad = 0;
      this.impacto = 0;
      this.valoracionControl = 0;
    },
  },
};
</script>




<style scoped>
.pagina {
  display: grid;
  grid-template-columns: repeat(20, 1fr);
  grid-template-rows: 100px 100px auto;
  background-image: url('../img/Fondo2.png');
  background-position: center center;
  background-size: cover;
  font-family: Arial, sans-serif;
  height: 100vh;
}

.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 85%;
  width: 105%;
  border-radius: 8px;
  display: flex;
  gap: 20px; /* Espacio entre las dos secciones */
}

.left-section {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 15px;
}

.left-section textarea {
  resize: none;
  width: 90%;
  height: 30%;
  min-height: 150px;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Contenedor para oportunidad y riesgo */
.top-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between; /* Espaciado uniforme */
  gap: 20px;
}

/* Contenedor para los campos principales */
.main-fields-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  gap: 20px;
}

/* Estilo individual para las columnas */
.group {
  flex: 1; /* Ambas columnas ocupan el mismo espacio */
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* Botones */
.valor-botones {
  display: flex;
  justify-content: center;
  gap: 20px;
  margin-top: 20px;
}

.top-container {
  display: flex;
  flex-direction: row;
  justify-content: space-between; /* Espaciado uniforme */
  gap: 20px;
}
.section {
  margin-bottom: 15px;
}

.section select, 
.section textarea {
  width: 100%;
  font-size: 14px;
  background-color: rgba(240, 248, 255, 0.226);
  border: 1px solid #ccc;
  padding: 8px;
  box-sizing: border-box;
}



/* Contenedor para los grupos */
.groups-container {
  display: flex;
  flex-direction: row; /* Organiza en columnas */
  justify-content: space-between; /* Espacio entre grupo1 y grupo2 */
  gap: 20px; /* Espaciado entre las columnas */
}

/* Ajusta los estilos de los grupos */
.group1,
.group2 {
  flex: 1; /* Ambos ocupan el mismo espacio */
  display: flex;
  flex-direction: column;
  gap: 15px;
}

/* Contenedor para los botones */
.valor-botones {
  display: flex;
  justify-content: center; /* Centra los botones */
  gap: 20px; /* Espaciado entre los botones */
  margin-top: 20px; /* Espacio respecto al contenido superior */
}

.input-group {
  display: flex;
  align-items: center;
  gap: 10px;
}

input[type="number"],
textarea,
input[type="date"] {
  padding: 5px;
  border-radius: 4px;
  border: 1px solid #ccc;
  width: 100%;
}

button {
  padding: 5px 10px;
  background-color: #C51922;
  color: rgb(255, 255, 255);
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:hover{
  background-color: #ffe100;
  color: black;
}

/* si o no  */
.options-group {
  display: flex;
  flex-direction: column;
  gap: 20px; /* Espacio entre cada opción */
  margin-top: 8px; /* Espacio entre el textarea y las opciones */
}

.option {
  display: flex;
  align-items: center;
  gap: 5px; /* Espacio entre cada opción */
  border: 2px solid #000000; /* Borde azul de 2 píxeles */
  border-radius: 5px; /* Esquinas redondeadas (opcional) */
  padding: 8px; /* Espacio interior del div */
}


label {
  font-size: 14px;
  font-weight: bold;
}

input[type="radio"] {
  margin-left: 5px;
}

/* botones  */







</style>
