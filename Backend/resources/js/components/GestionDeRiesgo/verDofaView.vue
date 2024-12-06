<template>
  <div class="pagina">
    <div class="grid">
      <!-- Sección izquierda: Información en forma de tabla -->
      <div class="informacion">
        <h2>DOFA</h2>
        <div class="tabla-dofa">
          <div class="celda">
            <h3>Debilidad</h3>
            <!-- Mostrar todas las debilidades -->
            <ul v-if="dofaResultados.Debilidades && dofaResultados.Debilidades.length">
              <li v-for="(debilidad, index) in dofaResultados.Debilidades" :key="index">
                {{ debilidad.descripcion }}
              </li>
            </ul>
            <p v-else>No hay información disponible.</p>
          </div>
          <div class="celda">
            <h3>Oportunidad</h3>
            <!-- Mostrar todas las oportunidades -->
            <ul v-if="dofaResultados.Oportunidades && dofaResultados.Oportunidades.length">
              <li v-for="(oportunidad, index) in dofaResultados.Oportunidades" :key="index">
                {{ oportunidad.descripcion }}
              </li>
            </ul>
            <p v-else>No hay información disponible.</p>
          </div>
          <div class="celda">
            <h3>Fortaleza</h3>
            <!-- Mostrar todas las fortalezas -->
            <ul v-if="dofaResultados.Fortalezas && dofaResultados.Fortalezas.length">
              <li v-for="(fortaleza, index) in dofaResultados.Fortalezas" :key="index">
                {{ fortaleza.descripcion }}
              </li>
            </ul>
            <p v-else>No hay información disponible.</p>
          </div>
          <div class="celda">
            <h3>Amenaza</h3>
            <!-- Mostrar todas las amenazas -->
            <ul v-if="dofaResultados.Amenazas && dofaResultados.Amenazas.length">
              <li v-for="(amenaza, index) in dofaResultados.Amenazas" :key="index">
                {{ amenaza.descripcion }}
              </li>
            </ul>
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
            <option value="Debilidad">Debilidad</option>
            <option value="Oportunidad">Oportunidad</option>
            <option value="Fortaleza">Fortaleza</option>
            <option value="Amenaza">Amenaza</option>
          </select>
        </div>

        <div class="opcion">
          <label for="tipo">Tipo</label>
          <select id="tipo" v-model="tipo">
            <option value="">Selecciona una opción</option>
            <option value="Operativo">Operativo</option>
            <option value="Estratégico">Estratégico</option>
            <option value="Táctico">Táctico</option>
          </select>
        </div>

        <div class="opcion">
          <label for="proceso">Proceso</label>
          <input id="proceso" type="text" v-model="proceso" placeholder="Ingresa el proceso aquí" />
        </div>

        <div class="opcion">
          <label for="area">Área</label>
          <select id="area" v-model="area">
            <option value="">Selecciona una opción</option>
            <option value="Sistemas">Sistemas</option>
            <option value="Gestión Humana">Gestión Humana</option>
            <option value="Producción">Producción</option>
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
      area: "", // Almacena la opción seleccionada en el menú Área
      error: "", // Mensaje de error si falla la validación
      dofaResultados: {
        Debilidades: [],
        Oportunidades: [],
        Fortalezas: [],
        Amenazas: [],
      },
      user: {}, // Resultados de la consulta a la base de datos divididos por secciones
    };
  },
  mounted() {
    const userData = localStorage.getItem("user");
    if (userData) {
      this.user = JSON.parse(userData);
    }
  },
  methods: {
    validarYBuscar() {
      // Limpiar errores previos
      this.error = "";

      // Validaciones: No es necesario validar 'tipo' ya que se debe permitir vacíos para obtener todos los resultados.
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
          id_usuario: this.user.id,
          dofa: this.dofa,
          tipo: this.tipo,  // Puede estar vacío si se quiere traer todos los tipos
          //area: this.area,  // Si es necesario en el backend
        };

        // Realizar la solicitud al backend
        const response = await axios.post("http://127.0.0.1:8000/api/buscar-dofa", payload);

        // Actualizar los resultados de las diferentes categorías
        this.dofaResultados = response.data;

        console.log(JSON.stringify(this.dofaResultados, null, 2)); // Log para ver la respuesta completa
      } catch (error) {
        // Manejo de errores con más detalle
        this.error = "Ocurrió un error al buscar la información. Intenta nuevamente.";
        console.error("Detalles del error:", error.response || error);
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
  background-image: url("../img/Fondo2.png");
  background-position: center center;
  background-size: cover;
  font-family: Arial, sans-serif;
  height: 100vh;
}

/* Contenedor para dividir en dos secciones */
.grid {
  display: grid;
  grid-template-columns: 3fr 1fr;
  width: 80%;
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
  padding: 8px;
  border-radius: 5px;
  border: 1px solid #ccc;
}

button {
  padding: 10px 20px;
  background-color: #4caf50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>
