<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />

    <!-- Barra de navegación -->
    <navegacionView />

    <!-- Contenido principal -->
    <main class="main-content">
      <div class="container">
        <!-- Parte izquierda -->
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
              <option v-for="riesgo in riesgos" :key="riesgo.id" :value="riesgo">{{ riesgo.descripcion}}</option>
            </select>
          </div>
        </div>

        <!-- Parte derecha -->
        <div class="right-panel">
          <div>
            <h3>CAUSAS POTENCIALES</h3>
            <textarea v-model="causas"></textarea>
          </div>
          <div>
            <h3>EFECTO POTENCIAL</h3>
            <textarea v-model="efecto"></textarea>
          </div>
          <div class="probabilidad-container">
            <div>
              <label>PROBABILIDAD </label>
              <input type="number" v-model="probabilidad" min="1" max="5" />
            </div>
            <div>
              <label>IMPACTO </label>
              <input type="number" v-model="impacto" min="1" max="5" />
            </div>
          </div>
          <div class="valoracion-container">
            <label>VALORACIÓN </label>
            <input type="text" v-model="valoracion" style="text-align: center;" readonly />
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
import navegacionView from "../navegacionView.vue";

export default {
  name: "MainPage",
  components: {
    EncabezadoView,
    navegacionView,
  },

  data() {
    return {
      oportunidades: "", // Aquí se almacenarán las fortalezas y oportunidades
      riesgos: "", // Aquí se almacenarán las debilidades y amenazas
      oportunidadSeleccionada: "",
      riesgoSeleccionado: "",
      causas: "",
      efecto: "",
      probabilidad: 0,
      impacto: 0,
      user: {},
    };
  },

  mounted() {
    const userData = localStorage.getItem("user");
    if (userData) {
      this.user = JSON.parse(userData);
    }
    this.cargarDatos();
  },
  
  computed: {
    valoracion() {
      return this.probabilidad * this.impacto;
    },
  },

  methods: {

    actualizarSeleccion(campo) {
      if (campo === "oportunidad" && this.oportunidadSeleccionada) {
        this.riesgoSeleccionado = null;
      } else if (campo === "riesgo" && this.riesgoSeleccionado) {
        this.oportunidadSeleccionada = null;
      }
    },

    ingresar() {
      // Validaciones básicas
      if (!this.oportunidadSeleccionada && !this.riesgoSeleccionado) {
        alert("Debe seleccionar una opción en Oportunidad o Riesgo.");
        return;
      }

      if (!this.causas.trim() || !this.efecto.trim()) {
        alert("Debe rellenar las causas y el efecto.");
        return;
      }

      if (this.probabilidad < 1 || this.probabilidad > 5 || this.impacto < 1 || this.impacto > 5) {
        alert("La probabilidad y el impacto deben estar entre 1 y 5.");
        return;
      }

      const tipo = this.oportunidadSeleccionada ? "Oportunidad" : "Riesgo";
      const seleccionado = this.oportunidadSeleccionada || this.riesgoSeleccionado;

      const payload = {
        id_elemento: seleccionado.codigo,
        tipo,
        causa: this.causas,
        efecto: this.efecto,
        probabilidad: this.probabilidad,
        impacto: this.impacto,
        valoracion: this.valoracion,
      };

      fetch("http://127.0.0.1:8000/api/clasificacion", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(payload),
      })
        .then((response) => {
          if (!response.ok) {
            throw new Error("Error al enviar la información.");
          }
          return response.json();
        })
        .then((data) => {
          alert("Datos enviados exitosamente.");
          this.limpiar();
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    },

    limpiar() {
      
      this.oportunidadSeleccionada = "";
      this.riesgoSeleccionado = "";
      this.causas = "";
      this.efecto = "";
      this.probabilidad = 0;
      this.impacto = 0;
      
      },

    cargarDatos() {

      if (!this.user.id) {
      console.error("Usuario no definido.");
      return;
    }

      const payload = {
        id_usuario: this.user.id,
      };

      fetch("http://127.0.0.1:8000/api/oportunidad-riesgo", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(payload),
      })
        .then((response) => response.json())
        .then((data) => {
          this.oportunidades = [...data.Fortalezas, ...data.Oportunidades];
          this.riesgos = [...data.Debilidades, ...data.Amenazas];
          //console.log(this.oportunidades)
          
       
        })
        .catch((error) => {
          console.error("Error al cargar datos:", error);
        });
    },
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


.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
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

  padding: 20px;
  width: 270px;
  margin: 0px 55px;
}

.section {
  margin-bottom: 10px;
}

.section select {
  width: 300px; /* Cambia este valor según el ancho deseado */
  height: 140px; /* Cambia este valor según la altura deseada */
  font-size: 14px; /* Aumenta el tamaño del texto si es necesario */
  background-color: rgba(240, 248, 255, 0.226);
}



h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 8px;
}


/* Panel derecho */
.right-panel {
  flex: 0 1 60%;          /* Opcional: ajusta el ancho relativo */
  max-width: 600px;       /* Ancho máximo */
  padding: 8px;
  background-color: rgba(255, 255, 255, 0); /* Opcional: para destacar el panel */

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
  gap: 16px; /* Espacio entre las columnas */
  justify-content: center; /* Centra horizontalmente */
  margin-bottom: 15px;
}

.input-group {
  display: flex;
  flex-direction: column; /* Coloca la etiqueta encima del input */
  align-items: center; /* Centra la etiqueta y el input */
  text-align: center;
}
.valoracion-container {
  display: flex;
  flex-direction: column; /* Coloca los elementos en columna */
  align-items: center; /* Centra los elementos horizontalmente */
  gap: 8px; /* Espacio entre el texto y el input */
  margin-bottom: 16px;
  text-align: center; /* Centra el texto */
}

input[type="number"],
input[type="text"] {
  width: 20%;
  padding: 5px;
}

.buttons {
  display: flex;
  gap: 10px;
  justify-content: center; /* Centrado horizontal */
  align-items: center; /* Centrado vertical */
  height: 30px; /* O el valor que necesites para el tamaño del contenedor */
}

.btn {
  padding: 5px 10px;
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
