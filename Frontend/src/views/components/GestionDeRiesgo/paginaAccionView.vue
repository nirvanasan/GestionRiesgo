<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView/>
  
      
     
      <!-- Barra de navegación -->
        <NavegacionView/>
      <!-- Contenido principal -->
      <main class="main-content">
       <ContenedorView />
        <div class="contenedor-izquierda">
          
        </div>

        <!-- Contenedor derecho -->
        <div class="contenedor-derecha">
          <input type="text" placeholder="Acción recomendada" />
          <input type="text" placeholder="Responsable" />
          <input type="text" placeholder="Acción" />
          <input type="text" placeholder="Proceso" />
          <div class="fechas">
            <div>
              <label>FECHA DE CIERRE</label>
              <input type="date" />
            </div>
            <div>
              <label>FECHA DE SEGUIMIENTO</label>
              <input type="date" />
            </div>
            <div class="probabilidad-impacto">
              <input type="text" placeholder="Probabilidad" />
              <input type="text" placeholder="Impacto" />
            </div>
          </div>
          
          <div class="valor-botones">
            <input type="text" placeholder="Valor" />
            <button>Limpiar</button>
            <button>Ingresar</button>
          </div>
        </div>
      </main>
    </div>
  </template>
  
  <script>

import ContenedorView from '../contenedorView.vue';
import EncabezadoView from '../EncabezadoView.vue';
import NavegacionView from "../navegacionView.vue";


  export default {

    components: {
      EncabezadoView,
      NavegacionView,
      ContenedorView

    },
  data() {
    return {
      informacionGeneral: "",
      accionesRecomendadas: "",
      responsables: "",
      acciones: "",
      proceso: "",
      fechaCierre: false,
      fechaSeguimiento: false,
      probabilidad: 5,
      impacto: 5,
      valoracion: "",
    };
  },
  methods: {
    limpiar() {
      this.informacionGeneral = "";
      this.accionesRecomendadas = "";
      this.responsables = "";
      this.acciones = "";
      this.proceso = "";
      this.fechaCierre = false;
      this.fechaSeguimiento = false;
      this.probabilidad = 5;
      this.impacto = 5;
      this.valoracion = "";
    },
    ingresar() {
      this.valoracion = this.probabilidad * this.impacto;
      console.log("Datos ingresados:", {
        informacionGeneral: this.informacionGeneral,
        accionesRecomendadas: this.accionesRecomendadas,
        responsables: this.responsables,
        acciones: this.acciones,
        proceso: this.proceso,
        fechaCierre: this.fechaCierre,
        fechaSeguimiento: this.fechaSeguimiento,
        probabilidad: this.probabilidad,
        impacto: this.impacto,
        valoracion: this.valoracion,
      });
    },
    agregarAccion() {
      console.log("Acción recomendada añadida:", this.accionesRecomendadas);
    },
    agregarResponsable() {
      console.log("Responsable añadido:", this.responsables);
    },
    agregarAccionEspecifica() {
      console.log("Acción específica añadida:", this.acciones);
    },
    agregarProceso() {
      console.log("Proceso añadido:", this.proceso);
    },
  },
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
  .main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 480px;
  width: 105%;
  border-radius: 8px;
  display: flex; /* Habilita el modelo de Flexbox */
  justify-content: space-between; /* Espacio entre los elementos */
  align-items: flex-start; /* Alinea los elementos al inicio vertical */
}
/* Contenedor principal */



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
  justify-content: space-between;
  gap: 10px;
}

.contenedor-derecha .fechas div {
  display: flex;
  flex-direction: column;
}

.contenedor-derecha .probabilidad-impacto {
  display: flex;
  justify-content: space-between;
  width: 300px;
  gap: 2px;
}

.contenedor-derecha .valor-botones {
  display: flex;
  justify-content: space-between;
  gap: 30px;
}

button {
  padding: 10px;
  border: none;
  border-radius: 4px;
  color: #fff;
  cursor: pointer;
}

button:nth-child(1) {
  background-color: #f44336; /* Rojo para limpiar */
}

button:nth-child(2) {
  background-color: #4caf50; /* Verde para ingresar */
}

  </style>