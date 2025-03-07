<template>
  <div class="pagina">
    <div class="grid">
      <!-- Sección izquierda: Información en forma de cuadrícula -->
      <div class="informacion">
        <div class="atras-btn">
          <router-link
              to="/eleccion"
              class="btn-atras"
              >
              Atrás
          </router-link>
        </div>
        <h2>DOFA</h2>
        <div class="tabla-dofa">
          <!-- Debilidades -->
          <div class="celda">
            <h3>Debilidad</h3>
            <ul v-if="dofaResultados.Debilidades && dofaResultados.Debilidades.length">
              <li v-for="(debilidad, index) in dofaResultados.Debilidades" :key="index">
                <b>{{ debilidad.codigo }}</b>{{": " + debilidad.descripcion + " "}} <span style="color: red;">({{debilidad.tipo }})</span>
              </li>
            </ul>
            <p v-else>No hay debilidades registradas.</p>
          </div>
          
          <!-- Oportunidades -->
          <div class="celda">
            <h3>Oportunidad</h3>
            <ul v-if="dofaResultados.Oportunidades && dofaResultados.Oportunidades.length">
              <li v-for="(oportunidad, index) in dofaResultados.Oportunidades" :key="index">
                <b>{{ oportunidad.codigo }}</b>{{": " + oportunidad.descripcion + " "}} <span style="color: red;">({{oportunidad.tipo }})</span>
              </li>
            </ul>
            <p v-else>No hay oportunidades registradas.</p>
          </div>
          
          <!-- Fortalezas -->
          <div class="celda">
            <h3>Fortaleza</h3>
            <ul v-if="dofaResultados.Fortalezas && dofaResultados.Fortalezas.length">
              <li v-for="(fortaleza, index) in dofaResultados.Fortalezas" :key="index">
                <b>{{ fortaleza.codigo }}</b>{{": " + fortaleza.descripcion + " "}} <span style="color: red;">({{fortaleza.tipo }})</span>
              </li>
            </ul>
            <p v-else>No hay fortalezas registradas.</p>
          </div>
          
          <!-- Amenazas -->
          <div class="celda">
            <h3>Amenaza</h3>
            <ul v-if="dofaResultados.Amenazas && dofaResultados.Amenazas.length">
              <li v-for="(amenaza, index) in dofaResultados.Amenazas" :key="index">
                <b>{{ amenaza.codigo }}</b>{{": " + amenaza.descripcion + " "}} <span style="color: red;">({{amenaza.tipo }})</span>
              </li>
            </ul>
            <p v-else>No hay amenazas registradas.</p>
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
          <select id="proceso" v-model="proceso">
            <option value="">Selecciona una opción</option>
            <option v-for="proceso in procesos" :key="proceso.id" :value="proceso.id">
              {{ proceso.nombre }}
            </option>
          </select>
        </div>

        <p v-if="error" class="error">{{ error }}</p>

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
      //area: "", // Almacena la opción seleccionada en el menú Área
      procesos: [],
      proceso: '',
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

    this.cargarProcesos();
  },
  methods: {
    

    async cargarProcesos() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/procesos-buscar");
        this.procesos = response.data;
      } catch (error) {
        console.error("Error al cargar los procesos:", error);
        this.error = "No se pudieron cargar los procesos.";
      }
    },


    validarYBuscar() {
      // Limpiar errores previos
      this.error = "";

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
          proceso: this.proceso
        };

        console.log(payload);

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
  text-align: center;
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
  background-color: #ef0c0c;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: #fffb00;
  color: #000000;
}

.celda {
  background: #f7f7f7;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 30px; /* Incrementa espacio interno */
  text-align: center;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  min-width: 250px; /* Tamaño mínimo */
  min-height: 180px; /* Altura mínima */
  max-height: 200px; /* Ajusta la altura máxima según lo necesites */
  overflow-y: auto;  /* Activa el scroll vertical si el contenido es mayor */
  border: 1px solid #ccc; /* Opcional: solo para visualizar mejor */
}

.tabla-dofa {
  display: grid;
  grid-template-columns: repeat(2, 1fr); /* Dos columnas */
}

.celda h3 {
  font-size: 18px;
  margin-bottom: 10px;
}

.celda ul {
  list-style-type:square; /* Tipo de viñeta (disco, círculo, cuadrado) */
  padding-left: 20px; /* Espaciado a la izquierda de la lista */
  text-align: left;
}

.celda ul li {
  font-size: 14px;
  margin: 5px 0;
  margin-bottom: 0px; /* Espacio entre los elementos de la lista */

}


/* boton de atras*/

.atras-btn{
  text-align: left;
}

.btn-atras {
  padding: 8px 12px;
  background-color: #c51922;
  color: white;
  border: none;
  border-radius: 5px;
  font-size: 14px;
  font-weight: bold;
  cursor: pointer;
  text-decoration: none;
  transition: background-color 0.3s;
}

.btn-atras:hover {
  background-color: #fbeb0f;
  color: black;
}


</style>
