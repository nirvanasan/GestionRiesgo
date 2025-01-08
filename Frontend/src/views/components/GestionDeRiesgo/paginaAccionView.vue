<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView/>
  
      
     
      <!-- Barra de navegación -->
        <NavegacionView/>
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

import EncabezadoView from '../EncabezadoView.vue';
import NavegacionView from "../navegacionView.vue";


  export default {

    components: {
      EncabezadoView,
      NavegacionView,
    },
    data() {
    return {
      oportunidades: [
        { id: 1, descripcion: "Oportunidad 1" },
        { id: 2, descripcion: "Oportunidad 2" },
        { id: 3, descripcion: "Oportunidad 3" }
      ],
      riesgos: [
        { id: 1, descripcion: "Riesgo 1" },
        { id: 2, descripcion: "Riesgo 2" },
        { id: 3, descripcion: "Riesgo 3" }
      ],
      oportunidadSeleccionada: null,
      riesgoSeleccionado: null,
      informacionGeneral: ""
    };
  },
  methods: {
    actualizarSeleccion(tipo) {
      console.log(`${tipo} seleccionado`);
    }
  }
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

.probabilidad-impacto input {
  width: 230px; /* Ajusta este valor según el tamaño deseado */
  height: 30px; /* Opcional: ajustar la altura */
  font-size: 12px; /* Opcional: ajustar el tamaño de la fuente */
  padding: 2px; /* Opcional: ajustar el relleno interno */
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
  background-color: #f4c136; /* Rojo para limpiar */
}

button:nth-child(2) {
  background-color: #ff0000; /* Verde para ingresar */
}

  </style>