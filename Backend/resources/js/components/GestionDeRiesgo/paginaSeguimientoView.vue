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
            <div class="option2">
            <input type="radio" id="documentado-si" value="Sí" v-model="documentado" />
            <label for="documentado-si">Sí</label>
            <input type="radio" id="documentado-no" value="No" v-model="documentado" />
            <label for="documentado-no">No</label>
          </div>
        </div>
          
        <div class="options-group">
        <div class="option">
          <label>¿Se eliminó la causa raíz de la NC? ¿Se aprovechó la oportunidad? ¿O se mitigó el riesgo?</label>
          <div class="option2">
            <input
              type="radio"
              id="implementado-si"
              value="Sí"
              v-model="implementado"
              @change="verificarImplementado"
            />
            <label for="implementado-si">Sí</label>
            <input
              type="radio"
              id="implementado-no"
              value="No"
              v-model="implementado"
              @change="verificarImplementado"
            />
            <label for="implementado-no">No</label>
          </div>
        </div>
      </div>
         
                  
          <div class="option">
            <label>¿Se hizo el cierre eficaz de las acciones del riesgo/oportunidad?</label>
            <div class="option2">
            <input type="radio" id="cierre-si" value="Sí" v-model="cierre" />
            <label for="cierre-si">Sí</label>
            <input type="radio" id="cierre-no" value="No" v-model="cierre" />
            <label for="cierre-no">No</label>
            </div>
          </div>
          
          <div class="option">
            <label>¿Se genera un nuevo riesgo u oportunidad?</label>
            <div class="option2">
            <input type="radio" id="riesgoN-si" value="Sí" v-model="riesgoN" />
            <label for="riesgoN-si">Sí</label>
            <input type="radio" id="riesgoN-no" value="No" v-model="riesgoN" />
            <label for="riesgoN-no">No</label>
          </div>
          </div>
        </div>
      </div>

      <div class="right-section">
        <!-- Parte superior: Oportunidad y Riesgo -->
        <div class="section">
          <h3>Accion</h3>
          <select v-model="AccionSeleccionada">
            <option v-for="accion in Accion" :key="accion.id" :value="accion">{{ accion.id_elemento /*+ ": " + accion.informacion*/ }}</option>
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

        <div class="tex"> 
          <label for="control-actual">Justificación</label>
          <textarea id="control-actual" v-model="justificacion"></textarea>
        </div>

        <!-- Botones -->
        <div v-show="mostrarFechaAdicional" class="form-group1">
          <label for="fecha2">Próximo seguimiento:</label>
          <input type="date" id="fecha2" v-model="fecha2" />
        </div>

        <div class="valor-botones">
           
          <button @click="limpiarFormulario">Limpiar</button>
          <button @click="enviarFormulario">Enviar</button>
          
          <button @click="historialUsuario">Historia de seguimiento de área</button>
        </div>
        
        <div class="main-nav__item" v-if="rol !== 1">
          <div class="boton-historial">
            <button @click="historial">Historia de seguimiento general</button>
          </div>
        </div>
        

      </div>
    </main>
  </div>
</template>



<script>
import { RouterLink } from "vue-router";
import EncabezadoView from "./../EncabezadoView.vue";
import NavegacionView from "./../navegacionView.vue";
import axios from "axios";

export default {
  name: "MainPage",
  components: {
    EncabezadoView,
    NavegacionView,
  },
  data() {
    return {
      Accion: [],
      AccionSeleccionada: null,
      documentado: null,
      implementado: null,
      cierre: null,
      riesgoN: null,
      fecha: null, 
      probabilidad: 0,
      impacto: 0,
      controlActual: "", 
      justificacion: "",
      valoracionControl: 0,
      implementado: null,
      mostrarFechaAdicional: false,
      fecha2: null,
      rol: null,
    };
  },
  mounted(){
    this.cargarAcciones();

    const userData = localStorage.getItem("user");
    if (userData) {
      this.user = JSON.parse(userData);
      this.rol = this.user.rol;
    }
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

    async registrarNotificacion(){
        try {
            await axios.post('http://127.0.0.1:8000/api/notificaciones', {
                id_usuario: this.user.id,
                mensaje: 'Nuevo seguimiento registrado'
            });

            console.log('Notificación guardada correctamente');
        } catch (error) {
            console.error('Error al registrar la notificación:', error);
        }
      },

    verificarImplementado() {
      this.mostrarFechaAdicional = this.implementado === "No";
      if (!this.mostrarFechaAdicional) {
        this.fecha2 = ""; // Limpiar la fecha si no se requiere
      }
    },

    historial(){
      window.location.href= 'http://127.0.0.1:8000/historial';
    },
    historialUsuario(){
      window.location.href= 'http://127.0.0.1:8000/historialUsuario';
    },

    async cargarAcciones() {

      try {
        const response = await axios.get("http://127.0.0.1:8000/api/buscar-acciones");
        this.Accion = response.data.data;
        //console.log(this.Accion);
      } catch (error) {
        console.error("Error al cargar los procesos:", error);
        this.error = "No se pudieron cargar los procesos.";
      }
      },

    async enviarFormulario() {
      
      /*
      console.log("Datos del formulario:", {
        accion_id: this.AccionSeleccionada.id_elemento,
        controlActual: this.controlActual,
        justificacion: this.justificacion,
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
        proximo_seguimiento: this.fecha2,
        });
        */


        console.log("Datos 2:",{
          control_actual: this.controlActual,
          p1: this.documentado,
          p2: this.implementado,
          p3: this.cierre,
          p4: this.riesgoN,
          accion_id: this.AccionSeleccionada.id_elemento,
          probabilidad: this.probabilidad,
          fecha: this.fecha,
          impacto: this.impacto,
          valoracion_riesgo: this.valoracionRiesgo,
          valoracion_control: this.valoracionControl,
          valoracion_total: this.valoracionTotal,
          justificacion: this.justificacion,
          proximo_seguimiento: this.fecha2
        });

        try{
          const response = await axios.post("http://127.0.0.1:8000/api/seguimiento", {
            control_actual: this.controlActual,
            p1: this.documentado,
            p2: this.implementado,
            p3: this.cierre,
            p4: this.riesgoN,
            accion_id: this.AccionSeleccionada.id_elemento,
            probabilidad: this.probabilidad,
            fecha: this.fecha,
            impacto: this.impacto,
            valoracion_riesgo: this.valoracionRiesgo,
            valoracion_control: this.valoracionControl,
            valoracion_total: this.valoracionTotal,
            justificacion: this.justificacion,
            proximo_seguimiento: this.fecha2

          });

          alert("Seguimiento guardado con éxito");
          this.registrarNotificacion();
          //console.log(response.data);

        } catch (error){
          console.error("Error al enviar los datos:", error);
          alert("Hubo un problema al guardar el seguimiento");
        }

  
    },
    limpiarFormulario() {

      this.controlActual = "";
      this.justificacion = "";
      this.documentado = null;
      this.implementado = null;
      this.cierre = null;
      this.riesgoN = null;
      this.fecha = "";
      this.probabilidad = 0;
      this.impacto = 0;
      this.valoracionControl = 0;
      this.AccionSeleccionada = null;

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
  height: 90%;
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
  width: 96%;
  height: 30%;
  min-height: 150px;
  padding: 10px;
  border: 1px solid #000000;
  border-radius: 4px;
  background-color: #ffffff6a;
}

.tex textarea{
  resize: none;
  width: 98%;
  height: 30%;
  min-height: 20px;
  padding: 10px;
  border: 1px solid #000000;
  border-radius: 4px;
  background-color: #ffffff6a;
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
.form-group1{
  gap: 150px;
  width: 30%;
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
  border: 1px solid #000000d3;
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
  position: absolute;
  right: 159px; /* Mueve el div hacia la derecha */
  top: 83%; /* Mueve el div hacia abajo */
  display: flex;
  gap: 20px;
}

.boton-historial {
  display: flex;
  flex-direction: column; /* Coloca los botones en columna */
  gap: 10px; /* Espacio entre los botones */
  align-items: flex-end; /* Alinea los botones a la derecha */
  width: max-content; /* Evita que el div ocupe todo el ancho */
  min-height: 50px; /* Mantiene espacio para evitar movimientos */
  position: absolute; /* Permite moverlo libremente */
  right:10.2%; /* Mueve el div hacia la derecha */
  top: 88%; /* Mueve el div más abajo */
}


.boton-historial button {
  width: 210px; /* Ajusta el ancho de los botones */
  padding: 4px; /* Reduce el tamaño del botón */
  font-size: 14px; /* Ajusta el tamaño del texto */
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
  gap: 11.5px; /* Espacio entre cada opción */
  margin-top: 8px; /* Espacio entre el textarea y las opciones */
}

.option {
  display: flex;
  align-items: center;
  gap: 140px; /* Espacio entre cada opción */
 
  border-radius: 5px; /* Esquinas redondeadas (opcional) */
  padding: 5px; /* Espacio interior del div */
}
.option2 {
  display: flex;
  align-items: left;
  gap: 7px; /* Espacio entre cada opción */
  border: 2px solid #000000; /* Borde azul de 2 píxeles */
  border-radius: 5px; /* Esquinas redondeadas (opcional) */
  padding: 5px; /* Espacio interior del div */
}


label {
  font-size: 14px;
  font-weight: bold;
}

input[type="radio"] {
  margin-left: 5px;
}

.main-nav {
    display: flex;
    gap: 30px; /* Espaciado entre los botones */
    text-align: center;
}







</style>