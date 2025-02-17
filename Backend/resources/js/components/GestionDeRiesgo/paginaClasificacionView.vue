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
            <h3>Oportunidad Inherente</h3>
            <select v-model="oportunidadSeleccionada" @change="actualizarSeleccion('oportunidad')">
              <option v-for="op in oportunidades" :key="op.id" :value="op">{{ op.codigo /*+ ": " + op.descripcion */}}</option>
            </select>
          </div>
          <div class="section">
            <h3>Riesgo Inherente</h3>
            <select v-model="riesgoSeleccionado" @change="actualizarSeleccion('riesgo')">
              <option v-for="riesgo in riesgos" :key="riesgo.id" :value="riesgo">{{ riesgo.codigo /*+ ": " + riesgo.descripcion*/}}</option>
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
            <input type="text" v-model="valoracion" :style="valoracionStyle" style="text-align: center;" readonly />
            <span>{{ valoracionLabel }}</span>
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
      probabilidad: 1,
      impacto: 1,
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

    valoracionStyle() {
      const valor = this.valoracion;
      if (this.riesgoSeleccionado) {
        if (valor >= 1 && valor <= 4) return { backgroundColor: "yellow" };
        if (valor >= 5 && valor <= 14) return { backgroundColor: "#F2A285" };
        if (valor >= 15 && valor <= 25) return { backgroundColor: "red" };
      } else if (this.oportunidadSeleccionada) {
        if (valor >= 1 && valor <= 4) return { backgroundColor: "gray" };
        if (valor >= 5 && valor <= 14) return { backgroundColor: "lightblue" };
        if (valor >= 15 && valor <= 25) return { backgroundColor: "darkblue", color: "white" };
      }
      return {};
    },

    valoracionLabel() {
      const valor = this.valoracion;
      if (this.riesgoSeleccionado) {
        if (valor >= 1 && valor <= 4) return "Aceptable";
        if (valor >= 5 && valor <= 14) return "Tolerable";
        if (valor >= 15 && valor <= 25) return "Inaceptable";
      } else if (this.oportunidadSeleccionada) {
        if (valor >= 1 && valor <= 4) return "No considerable";
        if (valor >= 5 && valor <= 14) return "A considerar";
        if (valor >= 15 && valor <= 25) return "A aprovechar";
      }
      return "";
    },
  },

  methods: {
    reloadPage() {
      window.location.reload();
    },

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
        id_usuario: this.user.id,
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
          
          this.limpiar();
        })
        .catch((error) => {
          console.error("Error:", error);
        });

      alert("Datos enviados exitosamente.");
      this.reloadPage();
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
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
  justify-content: space-between; /* Espacio entre los elementos */
  align-items: flex-start; /* Alinea los elementos al inicio vertical */
}

.container {
  display: flex;
  
}

/* Panel izquierdo */
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

h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 8px;
}

/* Panel derecho */
.right-panel {
  flex: 0 1 60%;          /* Opcional: ajusta el ancho relativo */
  max-width: 635px;       /* Ancho máximo */
  background-color: rgba(255, 255, 255, 0); /* Opcional: para destacar el panel */
  border: 1px solid black; /* Línea divisoria */
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
  padding: 8px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  background-color: #C51922;
  color: #ffffff;
}

.btn:hover{
  background-color: #ffe100;
  color: rgb(0, 0, 0);
}
</style>
