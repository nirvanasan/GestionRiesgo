<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView />

      <!-- Barra de navegación -->
       <NavegacionView/>

      <!-- Contenido principal -->
      
      <main class="main-content">
              <div class="container">
          <!-- Parte izquierda -->
          <div class="left-panel">
            <div class="section">
              <h3>OPORTUNIDAD</h3>
              <select multiple>
                <option v-for="op in oportunidades" :key="op">{{ op }}</option>
              </select>
            </div>
            <div class="section">
              <h3>RIESGO</h3>
              <select multiple>
                <option v-for="riesgo in riesgos" :key="riesgo">{{ riesgo }}</option>
              </select>
            </div>
          </div>

          <!-- Parte derecha -->
          <div class="right-panel">
            <div>
              <h3>CAUSAS POTENCIALES</h3>
              <textarea v-model="causasPotenciales"></textarea>
            </div>
            <div>
              <h3>EFECTO POTENCIAL</h3>
              <textarea v-model="efectoPotencial"></textarea>
            </div>
            <div class="probabilidad-container">
              <div>
                <label>PROBABILIDAD</label>
                <input type="number" v-model="probabilidad" min="1" max="5" />
              </div>
              <div>
                <label>IMPACTO</label>
                <input type="number" v-model="impacto" min="1" max="5" />
              </div>
            </div>
            <div class="valoracion-container">
              <label>VALORACIÓN</label>
              <input type="text" v-model="valoracion" readonly />
            </div>
            <div class="buttons">
              <button @click="limpiar" class="btn limpiar">Limpiar</button>
              <button @click="ingresar" class="btn ingresar">Ingresar</button>
            </div>
          </div>
        </div>
      </main>
      
      
    </div>
</template>

<script>
import EncabezadoView from "../EncabezadoView.vue";
import NavegacionView from "../navegacionView.vue";


export default {
  name: "MainPage",
  components: {
    EncabezadoView,
    NavegacionView
  },

  data() {
    return {
      oportunidades: ["Oportunidad 1", "Oportunidad 2", "Oportunidad 3", "Oportunidad 4", "Oportunidad 3", "Oportunidad 4"],
      riesgos: ["Riesgo 1", "Riesgo 2", "Riesgo 3", "Riesgo 4","Riesgo 3", "Riesgo 4"],
      causasPotenciales: "",
      efectoPotencial: "",
      probabilidad: 5,
      impacto: 5,
      valoracion: "",
    };
  },
  methods: {
    limpiar() {
      this.causasPotenciales = "";
      this.efectoPotencial = "";
      this.probabilidad = 5;
      this.impacto = 5;
      this.valoracion = "";
    },
    ingresar() {
      this.valoracion = this.probabilidad * this.impacto;
      alert("Datos ingresados correctamente. Valoración: " + this.valoracion);
    },
  },
  
};
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


.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffff96;
  padding: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
}

.container {
  display: flex;
  justify-content: space-between;
}

/* Panel izquierdo */
.left-panel {
  border: 1px solid #000;
  padding: 50px;
  width: 270px;
  margin: 30px 65px;
}

.section {
  margin-bottom: 16px;
  
}


h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 8px;
}

select {
  width: 100%;
  height: 80px;
}

/* Panel derecho */
.right-panel {
  flex: 0 1 50%;          /* Opcional: ajusta el ancho relativo */
  max-width: 500px;       /* Ancho máximo */
  padding: 10px;
  background-color: white; /* Opcional: para destacar el panel */
  border: 1px solid #ddd; /* Opcional: para visualización */
  border-radius: 8px;     /* Opcional: esquinas redondeadas */
  text-align: center;

}

textarea {
  width: 60%;
  height: 80px;
  margin-bottom: 10px;
  resize: none;
  background-color: rgba(245, 245, 245, 0.645);
}

.probabilidad-container {
  display: flex;
  gap: 20px;
  margin-bottom: 16px;  
}
.valoracion-container {
  display: flex;
  gap: 10px;
  margin-bottom: 16px;
  text-align: center;

}

input[type="number"],
input[type="text"] {
  width: 100%;
  padding: 4px;
}

.buttons {
  display: flex;
  gap: 16px;
}

.btn {
  padding: 8px 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.limpiar {
  background-color: #d2b48c;
}

.ingresar {
  background-color: #ff4d4d;
  color: white;
}
</style>
