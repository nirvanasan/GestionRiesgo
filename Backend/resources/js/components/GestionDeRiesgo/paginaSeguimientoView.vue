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

      <!-- Sección derecha: Grupos -->
      <div class="right-section">
        <!-- Grupo 1: Probabilidad, Impacto, Valoración del Control -->
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

        <!-- Grupo 2: Fecha, Valoración del Riesgo, Valoración Total -->
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

          <div class="valor-botones">
          <button @click="enviarFormulario">Enviar</button>
          <button @click="limpiarFormulario">Limpiar</button>
        </div>
        </div>

        <!-- Botones -->
        
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

.right-section {
  flex: 2;
  display: flex;
  margin: 2%;
}

.group {
  display: flex;
  flex-direction: column;
  margin-left: 10%;
  gap: 20px;
}

.form-group {
  display: flex;
  flex-direction: column;
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
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

button:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}

/* si o no  */
.options-group {
  display: flex;
  flex-direction: column;
  gap: 10px; /* Espacio entre cada opción */
  margin-top: 10px; /* Espacio entre el textarea y las opciones */
}

.option {
  display: flex;
  align-items: center;
  gap: 10px; /* Espacio entre los elementos de cada opción */
}

label {
  font-size: 14px;
  font-weight: bold;
}

input[type="radio"] {
  margin-left: 5px;
}

/* botones  */

.valor-botones  {
  display: flex;
  width: 50px; /* Cambia este valor según el tamaño deseado */
  gap: 20px;
 
}


button {
  padding: 8px;
  border: none;
  border-radius: 4px;
  color: #000000;
  cursor: pointer;
  background-color: gray;
}


button:nth-child(1) {
  background-color: #f4c136; /* Rojo para limpiar */
}

button:nth-child(2) {
  background-color: rgb(235, 41, 41); /* Verde para ingresar */
}



</style>
