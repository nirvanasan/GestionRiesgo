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
            <option v-for="op in oportunidades" :key="op.id" :value="op">{{ op.descripcion }}</option>
          </select>
        </div>
        <div class="section">
          <h3>RIESGO</h3>
          <select v-model="riesgoSeleccionado" @change="actualizarSeleccion('riesgo')">
            <option v-for="riesgo in riesgos" :key="riesgo.id" :value="riesgo">{{ riesgo.descripcion }}</option>
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
        <input type="text" v-model="responsable" placeholder="Responsable" />
        <input type="text" v-model="accion" placeholder="Acción" />
        <input type="text" v-model="proceso" placeholder="Proceso" />
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
      accion: "",
      proceso: "",
      fechaCierre: "",
      fechaSeguimiento: "",
      probabilidad: "",
      impacto: "",
      valor: ""
    };
  },
  methods: {

    

    actualizarSeleccion(tipo) {
      console.log(`${tipo} seleccionado`);
    },
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
    enviarDatos() {
      if (
        !this.oportunidadSeleccionada ||
        !this.riesgoSeleccionado ||
        !this.informacionGeneral ||
        !this.accionRecomendada ||
        !this.responsable ||
        !this.accion ||
        !this.proceso ||
        !this.fechaCierre ||
        !this.fechaSeguimiento ||
        !this.probabilidad ||
        !this.impacto ||
        !this.valor
      ) {
        alert("Todos los campos son obligatorios.");
        return;
      }

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
  width: 90%;
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
  background-color: gray; /* Verde para ingresar */
}

  </style>