<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />

    <!-- Barra de navegación -->
    <NavegacionView />

    <!-- Contenido principal -->
    <main class="main-content">
      <div class="left-panel">
        <div class="section">
          <h3>OPORTUNIDAD</h3>
          <select v-model="oportunidadSeleccionada" @change="actualizarSeleccion('oportunidad')">
            <option v-for="op in oportunidades" :key="op.id" :value="op">{{ op.id_elemento + ": " + op.descripcion }}</option>
          </select>
        </div>
        <div class="section">
          <h3>RIESGO</h3>
          <select v-model="riesgoSeleccionado" @change="actualizarSeleccion('riesgo')">
            <option v-for="riesgo in riesgos" :key="riesgo.id" :value="riesgo">{{ riesgo.id_elemento + ": " + riesgo.descripcion }}</option>
          </select>
        </div>
        <div class="section">
          <h3>INFORMACIÓN GENERAL</h3>
          <textarea v-model="informacionGeneral" placeholder="Escribe aquí la información general"></textarea>
        </div>
      </div>

      <!-- Contenedor derecho -->
      <div class="contenedor-derecha">
        <input type="text" v-model="accionRecomendada" placeholder="Acción recomendada" />



        <div class="select-container">
            <select v-model="responsable" class="custom-select">
              <option disabled value="">Seleccione un responsable </option>
              <option v-for="opcion in responsables" :key="opcion.id" :value="opcion.name">
                {{ opcion.name }}
              </option>
            </select>
          </div>

          
        <input type="text" v-model="accion" placeholder="Acción" />
        <!-- Selector para el proceso con flecha -->
          <div class="select-container">
            <select v-model="proceso" class="custom-select">
              <option disabled value="">Seleccione un proceso</option>
              <option v-for="opcion in procesos" :key="opcion.id" :value="opcion.nombre">
                {{ opcion.nombre }}
              </option>
            </select>
          </div>
          
        <div class="fechas">
          <div>
            <label>FECHA DE SEGUIMIENTO </label>
            <input type="date" v-model="fechaSeguimientoCierre" />
          </div>
          <div>
            <label>FECHA DE CIERRE</label>
            <input type="date" v-model="fechaCierre" />
          </div>
          <!-- <div class="probabilidad-impacto">
            <input type="text" v-model="probabilidad" placeholder="Probabilidad" />
            <input type="text" v-model="impacto" placeholder="Impacto" />
          </div> -->
        </div>

        <div class="valor-botones">
          <!-- <input type="text" v-model="valor" placeholder="Valor" /> -->
          <button @click="limpiarCampos">Limpiar</button>
          <button @click="enviarDatos">Ingresar</button>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import EncabezadoView from '../EncabezadoView.vue';
import NavegacionView from "../navegacionView.vue";
import axios from "axios";

export default {
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
      informacionGeneral: "",
      accionRecomendada: "",
      responsable: "",
      responsables: [],
      accion: "",
      proceso: "",
      procesos: [],
      fechaCierre: "",
      fechaSeguimiento: "",
      probabilidad: "",
      impacto: "",
      valor: "",
      user: {}
    };
  },
  methods: {

    // Método para cargar responsables desde el backend
    async cargarResponsables() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/cargar-usuarios");
        this.responsables = response.data.users;
        console.log(response.data)
      } catch (error) {
        console.error("Error al cargar los responsables:", error);
        alert("No se pudieron cargar los responsables.");
      }
    },

    async cargarProcesos() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/procesos-buscar");
        this.procesos = response.data;
      } catch (error) {
        console.error("Error al cargar los procesos:", error);
        this.error = "No se pudieron cargar los procesos.";
      }
    },

    // Método para obtener controles desde el backend
    async obtenerControles() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/cargar-controles', {
          params: { usuario: this.user.id },
        });

        this.oportunidades = response.data.controles.filter(
          control => control.tipo === 'Oportunidad'
        );
        this.riesgos = response.data.controles.filter(
          control => control.tipo === 'Riesgo'
        );
      } catch (error) {
        console.error('Error al obtener los controles:', error);
        alert('Error al cargar los datos de controles.');
      }
    },

    // Método para validar los campos antes de enviar
    validarCampos() {
      const errores = [];
      if (!this.oportunidadSeleccionada) errores.push("Seleccione una oportunidad.");
      if (!this.riesgoSeleccionado) errores.push("Seleccione un riesgo.");
      if (!this.informacionGeneral) errores.push("Complete la información general.");
      if (!this.accionRecomendada) errores.push("Complete la acción recomendada.");
      if (!this.responsable) errores.push("Complete el responsable.");
      if (!this.accion) errores.push("Complete la acción.");
      if (!this.proceso) errores.push("Seleccione un proceso.");
      if (!this.fechaCierre) errores.push("Complete la fecha de cierre.");
      if (!this.fechaSeguimiento) errores.push("Complete la fecha de seguimiento.");
      if (!this.probabilidad) errores.push("Complete la probabilidad.");
      if (!this.impacto) errores.push("Complete el impacto.");
      if (!this.valor) errores.push("Complete el valor.");

      if (errores.length > 0) {
        alert(errores.join("\n"));
        return false;
      }
      return true;
    },

    // Método para limpiar los campos
    limpiarCampos() {
      this.oportunidadSeleccionada = null;
      this.riesgoSeleccionado = null;
      this.informacionGeneral = "";
      this.accionRecomendada = "";
      this.responsable = "";
      this.accion = "";
      this.proceso = "";
      this.fechaCierre = "";
      this.fechaSeguimiento = "";
      this.probabilidad = "";
      this.impacto = "";
      this.valor = "";
    },

    // Método para enviar los datos al backend
    enviarDatos() {
      if (!this.validarCampos()) return;

      console.log("Datos ingresados:");
      console.log("Oportunidad:", this.oportunidadSeleccionada.descripcion);
      console.log("Riesgo:", this.riesgoSeleccionado.descripcion);
      console.log("Información General:", this.informacionGeneral);
      console.log("Acción Recomendada:", this.accionRecomendada);
      console.log("Responsable:", this.responsable);
      console.log("Acción:", this.accion);
      console.log("Proceso:", this.proceso);
      console.log("Fecha de Cierre:", this.fechaCierre);
      console.log("Fecha de Seguimiento:", this.fechaSeguimiento);
      console.log("Probabilidad:", this.probabilidad);
      console.log("Impacto:", this.impacto);
      console.log("Valor:", this.valor);
    }
  },
  mounted() {
    const userData = localStorage.getItem("user");
    if (userData) {
      this.user = JSON.parse(userData);
      this.cargarResponsables();
      this.obtenerControles();
      this.cargarProcesos();
    }
   
    
  }
};
</script>


  
  <style scoped>
  .pagina {
    display: grid;
    grid-template-columns: repeat(20, 1fr); /* 20 columnas iguales */
    grid-template-rows: 100px 100px auto; /* Filas más pequeñas */
    background-image: url('../img/Fondo2.png');
    background-position: center center;
    background-size: cover;
    font-family: Arial, sans-serif;
    height: 100vh; /* Ocupa el 100% del viewport */

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
  display: flex; /* Habilita el modelo de Flexbox */
  justify-content: space-between; /* Espacio entre los elementos */
  align-items: flex-start; /* Alinea los elementos al inicio vertical */
}


.left-panel {
  padding: 20px;
  width: 300px;
  margin: 0 20px;
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

textarea {
  height: 80px; /* Ajusta la altura según sea necesario */
  resize: none; /* Evita que el usuario cambie el tamaño */
}

h3 {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 8px;
}

/* Contenedor derecho */
.contenedor-derecha {
  display: flex;
  flex-direction: column;
  gap: 30px;

  padding: 20px;
  border-radius: 8px;
  width: 70%; /* Ajusta este valor para hacerlo más ancho */
}

.contenedor-derecha textarea,
.contenedor-derecha input {
  width: 96%;
  padding: 8px;
  border: 1px solid #000000e6;
  border-radius: 4px;
  background-color: #fdfdfd83;
}

.contenedor-derecha .fechas {
  display: flex;
  gap: 10px;
}

.contenedor-derecha .fechas div {
  display: flex;
  flex-direction: column;
  width: 200px;
  gap: 5px; 
  height: 35px
}

.contenedor-derecha .probabilidad-impacto {
  display: flex;
  justify-content: space-between;
  width: 300px;
  gap: 2px; 
}

.probabilidad-impacto input {
  width: 245px; /* Ajusta este valor según el tamaño deseado */
  height: 30px; /* Opcional: ajustar la altura */
  font-size: 12px; /* Opcional: ajustar el tamaño de la fuente */
  padding: 2px; /* Opcional: ajustar el relleno interno */
}

.contenedor-derecha {
  display: flex;
  justify-content: space-between;
}

.valor-botones  {
  display: flex;
  width: 550px; /* Cambia este valor según el tamaño deseado */
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


/* estilo de eleccion */

/* Contenedor para posicionar el select y la flecha */
.select-container {
  position: relative;
  width: 100%; /* Ajusta el ancho del contenedor según sea necesario */
}

/* Personalización del select */
.custom-select {
  width: 98.5%;
  padding: 9px;
  font-size: 13px;
  border-radius: 5px;
  background-color: #f9f9f9b5;
  color: #636262;
  appearance: none; /* Oculta la flecha nativa */
  -webkit-appearance: none;
  -moz-appearance: none;
}

/* Flecha personalizada */
.select-container::after {
  content: "▼"; /* Flecha hacia abajo */
  font-size: 18px; /* Tamaño de la flecha */
  color: #000000; /* Color de la flecha */
  position: absolute;
  top: 50%; /* Centrar verticalmente */
  right: 15px; /* Mueve la flecha más a la derecha */
  transform: translateY(-50%);
  pointer-events: none; /* Evita que interfiera con clics */
}

  </style>