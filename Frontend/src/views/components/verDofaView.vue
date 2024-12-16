<template>
  <div class="pagina">
    <!-- Botón de Volver -->
     <div>
        <button class="btn-volver" @click="volver">← Volver</button>
     </div>
    <div class="grid">
      <!-- Sección izquierda: Información en forma de tabla -->
      <div class="informacion">
        <h2>DOFA</h2>
        <div class="tabla-dofa">
          <div class="celda">
            <h3>Debilidad</h3>
            <p v-if="dofaResultados.debilidad">{{ dofaResultados.debilidad }}</p>
            <p v-else>No hay información disponible.</p>
          </div>
          <div class="celda">
            <h3>Oportunidad</h3>
            <p v-if="dofaResultados.oportunidad">{{ dofaResultados.oportunidad }}</p>
            <p v-else>No hay información disponible.</p>
          </div>
          <div class="celda">
            <h3>Fortaleza</h3>
            <p v-if="dofaResultados.fortaleza">{{ dofaResultados.fortaleza }}</p>
            <p v-else>No hay información disponible.</p>
          </div>
          <div class="celda">
            <h3>Amenaza</h3>
            <p v-if="dofaResultados.amenaza">{{ dofaResultados.amenaza }}</p>
            <p v-else>No hay información disponible.</p>
          </div>
        </div>
      </div>

      <!-- Sección derecha: Menús desplegables -->
      <div class="menu-desplegables">
        <h2>Opciones</h2>

        <div class="opcion">
          <label for="dofa">DOFA</label>
          <select id="dofa" v-model="dofa">
            <option value="">Selecciona una opción</option>
            <option value="debilidad">Debilidad</option>
            <option value="oportunidad">Oportunidad</option>
            <option value="fortaleza">Fortaleza</option>
            <option value="amenaza">Amenaza</option>
            <option value="completa">Ver DOFA completa</option>
          </select>
        </div>

        <div class="opcion">
          <label for="tipo">Tipo</label>
          <select id="tipo" v-model="tipo">
            <option value="">Selecciona una opción</option>
            <option value="operativo">Operativo</option>
            <option value="estrategico">Estratégico</option>
            <option value="tactico">Táctico</option>
          </select>
        </div>


        <div class="opcion">
          <label for="area">Área</label>
          <select id="area" v-model="area">
            <option value="">Selecciona una opción</option>
            <option value="sistemas">Sistemas</option>
            <option value="gestion-humana">Gestión Humana</option>
            <option value="produccion">Producción</option>
          </select>
        </div>

        <!-- Mensaje de error -->
        <p v-if="error" class="error">{{ error }}</p>

        <!-- Botón Buscar Información -->
        <button class="btn-buscar" @click="validarYBuscar">Buscar Información</button>
      </div>
    </div>
  </div>
</template>


<script>
import axios from "axios";

export default {
  name: "VistaPrincipal",
  data() {
    return {
      dofa: "", // Almacena la opción seleccionada en el menú DOFA
      tipo: "", // Almacena la opción seleccionada en el menú Tipo
      //proceso: "", // Almacena el valor ingresado en el campo Proceso
      area: "", // Almacena la opción seleccionada en el menú Área
      error: "", // Mensaje de error si falla la validación
      dofaResultados: {
        debilidad: "",
        oportunidad: "",
        fortaleza: "",
        amenaza: "",
      }, // Resultados de la consulta a la base de datos divididos por secciones
    };
  },
  methods: {
    volver() {
      // Navega hacia atrás en el historial
      this.$router.go(-1);
    },
    validarYBuscar() {
      // Limpiar errores previos
      this.error = "";

      // Validaciones básicas
      if (!this.tipo) {
        this.error = "Por favor selecciona una opción en el menú Tipo.";
        return;
      }
      // if (!this.proceso) {
      //   this.error = "Por favor ingresa un valor en el campo Proceso.";
      //   return;
      // }
      if (!this.area) {
        this.error = "Por favor selecciona una opción en el menú Área.";
        return;
      }

      // Si todas las validaciones pasan, enviar solicitud al backend
      this.buscarInformacion();
    },
    async buscarInformacion() {
      try {
        // Construir el payload para el backend
        const payload = {
          dofa: this.dofa,
          tipo: this.tipo,
          proceso: this.proceso,
          area: this.area,
        };

        // Realizar la solicitud al backend
        const response = await axios.post("/api/buscar-informacion", payload);

        // Actualizar los resultados de las diferentes categorías
        this.dofaResultados = response.data;
      } catch (error) {
        this.error = "Ocurrió un error al buscar la información. Intenta nuevamente.";
        console.error(error);
      }
    },
  },
};
</script>


<style scoped>

/* Estilo del mensaje de error */
.error {
  color: red;
  font-size: 14px;
  margin-top: 10px;
}
/* Configuración de la página con diseño de fondo */
.pagina {
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url("/src/assets/img/Fondo2.png");
  background-position: center center;
  background-size: cover;
  font-family: Arial, sans-serif;
  height: 100vh;
}

.btn-volver {
  position: absolute;
  top: 20px;
  left: 20px;
  background-color: #c91717;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
}

.btn-volver:hover {
  background-color: #ff4d4d;
}

/* Contenedor para dividir en dos secciones */
.grid {
  display: grid;
  grid-template-columns: 3fr 1fr; /* La parte derecha es más angosta */
  width: 90%;
  height: 80%;
  gap: 20px;
}

/* Estilo de la sección izquierda */
.informacion {
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}

.cuadro-informacion {
  margin-top: 20px;
  padding: 10px;
  background: #f7f7f7;
  border: 1px solid #ddd;
  border-radius: 5px;
}

/* Estilo de la sección derecha */
.menu-desplegables {
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

/* Estilo para cada menú desplegable */
.opcion {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

select,
input {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

/* Estilo del botón Buscar Información */
.btn-buscar {
  background-color:  #c91717;
  color: white;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  width: 100%;
}

.btn-buscar:hover {
  background-color: rgb(236, 236, 139);
  color: red;
}

/* diseño de la parte izquierda. */
.tabla-dofa {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: px;
}

.celda {
  border: 1px solid #ccc;
  padding: 18%;
  border-radius: 8px;
  background-color: #f9f9f9;
  text-align: center;
}

.celda h3 {
  margin-bottom: 10px;
}

.error {
  color: red;
  margin-top: 10px;
}

</style>
