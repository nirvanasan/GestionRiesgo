<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />

    <!-- Barra de navegación -->
    <NavegacionView />

    <main class="main-content">
      <!-- Botón de retroceso -->
      <router-link to="/eleccion" class="btn-atras">Atrás</router-link>

      <section class="input-container">
        <!-- Sección derecha: Formularios -->
        <div class="right-section">
          <!-- Selector de Proceso -->
          <div class="form-group">
            <label for="proceso">Proceso</label>
            <select id="proceso" v-model="proceso">
              <option v-for="proceso in procesos" :key="proceso.id" :value="proceso.id">
                {{ proceso.nombre }}
              </option>
            </select>
          </div>

          <!-- Selector de Cuadrante -->
          <div class="form-group">
            <label for="cuadrante">Seleccione un cuadrante</label>
            <select v-model="selectedCuadrante" id="cuadrante">
              <option value="Fortaleza">Fortaleza</option>
              <option value="Debilidad">Debilidad</option>
              <option value="Oportunidad">Oportunidad</option>
              <option value="Amenaza">Amenaza</option>
            </select>
          </div>

          <!-- Selector de Tipo -->
          <div class="form-group">
            <label for="tipo">Tipo</label>
            <select v-model="selectedTipo" id="tipo">
              <option value="Estratégico">Estratégico</option>
              <option value="Operativo">Operativo</option>
              <option value="Táctico">Táctico</option>
            </select>
          </div>

          <!-- Campo de Descripción -->
          <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea
              v-model="descripcion"
              @keyup.enter="handleSubmit"
              id="descripcion"
              placeholder="Ingrese la descripción"
            ></textarea>
          </div>

          <!-- Botones -->
          <div class="button-group">
            <button @click="limpiar" class="btn limpiar-btn">Limpiar</button>
            <button @click="handleSubmit" class="btn ingresar-btn">Insertar</button>
          </div>
        </div>

        <!-- Sección izquierda: Listas de cuadrantes -->
        <div class="left-column">
          <!-- Debilidad -->
          <label>Debilidad</label>
          <div class="readonly-box">
            <span v-if="debilidades.length === 0" style="color: gray; font-style: italic">Ingrese aquí</span>
            <div v-for="(item, index) in debilidades" :key="index">
              <div v-if="editingItem === item">
                <textarea v-model="editingText" class="edit-input"></textarea>
                <button @click="saveEdit(item, index, 'debilidades')" class="btn save-btn">Guardar</button>
                <button @click="cancelEdit" class="btn cancel-btn">Cancelar</button>
              </div>
              <div v-else>
                <span :class="getTypeClass(item.type)">
                  {{ item.type }}:
                </span>
                {{ item.text }}
                <button @click="editItem(item, item.text)" class="btn edit-btn">Editar</button>
              </div>
            </div>
          </div>

          <!-- Oportunidad -->
          <label>Oportunidad</label>
          <div class="readonly-box">
            <span v-if="oportunidades.length === 0" style="color: gray; font-style: italic">Ingrese aquí</span>
            <div v-for="(item, index) in oportunidades" :key="index">
              <span :class="getTypeClass(item.type)">
                {{ item.type }}:
              </span>
              {{ item.text }}
            </div>
          </div>
        </div>

        <!-- Sección derecha adicional: Fortalezas y Amenazas -->
        <div class="right-column">
          <!-- Fortaleza -->
          <label>Fortaleza</label>
          <div class="readonly-box">
            <span v-if="fortalezas.length === 0" style="color: gray; font-style: italic">Ingrese aquí</span>
            <div v-for="(item, index) in fortalezas" :key="index">
              <span :class="getTypeClass(item.type)">
                {{ item.type }}:
              </span>
              {{ item.text }}
            </div>
          </div>

          <!-- Amenaza -->
          <label>Amenaza</label>
          <div class="readonly-box">
            <span v-if="amenazas.length === 0" style="color: gray; font-style: italic">Ingrese aquí</span>
            <div v-for="(item, index) in amenazas" :key="index">
              <span :class="getTypeClass(item.type)">
                {{ item.type }}:
              </span>
              {{ item.text }}
            </div>
          </div>

          <!-- Botón de Enviar Datos -->
          <div class="button-container">
            <button @click="enviarDatos" class="button">Enviar datos</button>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>


<script>
import EncabezadoView from '../EncabezadoView.vue';
import NavegacionView from '../navegacionView.vue';

export default {
  name: 'MainPage',
  components: {
    EncabezadoView,
    NavegacionView,
  },
  data() {
    return {
      debilidades: [],
      oportunidades: [],
      fortalezas: [],
      amenazas: [],
      descripcion: "",
      selectedCuadrante: "",
      selectedTipo: "",
      user: {},
      procesos: [],
    };
  },
  mounted() {
    const userData = localStorage.getItem('user');
    if (userData) {
      this.user = JSON.parse(userData); // Asignar el objeto usuario desde localStorage
    }
    this.cargarProcesos();
  },
  computed: {
    // Computado para deshabilitar el botón "Enviar" si hay campos vacíos
    isEnviarDisabled() {
      return !(this.input1 && this.input2 && this.input3 && this.input4);
    },
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
    handleSubmit() {
      if (!this.descripcion.trim()) {
        alert("Debe ingresar una descripción!");
        return;
      }
      // Crear objeto con texto y tipo
      const entry = { text: this.descripcion, type: this.selectedTipo };
      // Agregar al cuadrante correspondiente
      switch (this.selectedCuadrante) {
        case "Debilidad":
          this.debilidades.push(entry);
          break;
        case "Oportunidad":
          this.oportunidades.push(entry);
          break;
        case "Fortaleza":
          this.fortalezas.push(entry);
          break;
        case "Amenaza":
          this.amenazas.push(entry);
          break;
      }
      this.descripcion = ""; // Limpiar campo descripción
    },
    limpiar() {
      this.debilidades = [];
      this.oportunidades = [];
      this.fortalezas = [];
      this.amenazas = [];
    },
    // Determinar clase CSS según el tipo
    getTypeClass(type) {
      switch (type) {
        case "Estratégico":
          return "type-estrategico";
        case "Operativo":
          return "type-operativo";
        case "Táctico":
          return "type-tactico";
        default:
          return "";
      }
    },
    enviarDatos() {
      if (
        this.debilidades.length === 0 &&
        this.oportunidades.length === 0 &&
        this.fortalezas.length === 0 &&
        this.amenazas.length === 0
      ) {
        alert("Por favor agregue un elemento antes de enviar");
        return;
      }
      const procesoSeleccionado = this.procesos.find(proceso => proceso.id === this.proceso);
      if (!procesoSeleccionado) {
        alert("Por favor seleccione un proceso");
        return;
      }
      // Crear objeto con datos a enviar
      const data = {
        Debilidad: this.debilidades.map(item => ({ tipo: item.type, descripcion: item.text })),
        Amenaza: this.amenazas.map(item => ({ tipo: item.type, descripcion: item.text })),
        Oportunidad: this.oportunidades.map(item => ({ tipo: item.type, descripcion: item.text })),
        Fortaleza: this.fortalezas.map(item => ({ tipo: item.type, descripcion: item.text })),
        id_usuario: this.user.id,
        id_proceso: procesoSeleccionado.id,
      };
      console.log(JSON.stringify(data, null, 2));
      // Enviar datos al servidor
      fetch('http://127.0.0.1:8000/api/guardar-dofa', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
        .then(response => response.json())
        .then(response => {
          alert(response.message);
          this.limpiar();
        })
        .catch(error => {
          console.error('Error al enviar los datos:', error);
          alert('Error al enviar los datos.');
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

.navigation { 
  grid-column: 5 / 17;
  grid-row: 2 / 3;
  margin-top: 50px;
}

.main-nav {
  display: flex;
  justify-content: space-around;
}

.main-content {
  position: relative;
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 20px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
}

.nav-link {
  padding: 10px 40px;
  color: white;
  border-radius: 10px;
  text-decoration: none;
  background-color: #c91717;
}

.nav-link:hover {
  background-color: white;
  color: red;
}

.input-container {
  display: flex;
  justify-content: space-between;
  gap: 40px;
 
}

.left-column, .right-column {
  display: inline-block;
  vertical-align: top;
  width: 40%; /* Ajusta según tu diseño */
  margin: 10px;
}

textarea {
  padding: 15px;
  font-size: 18px;
  height: 150px;
  border: 2px solid #000000;
  border-radius: 8px;
  resize: vertical;
  box-sizing: border-box;
  background-color: #f4f1f1c7;
}

.right-section {
  display: flex;
  flex-direction: column;
  gap: 8px;
  max-width: 300px;
  margin-left: 25px;
  transform: translateY(30px);
}

.form-group {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 5px;
  font-weight: bold;
}

select,
textarea {
  padding: 10px;
  border: 1px solid #cccccc;
  border-radius: 5px;
  font-size: 14px;
}

.button-container {
  display: flex;
  justify-content: flex-end;
  padding: 10px;
  gap: 10px;
  width: 90%;
}

.button {
  background-color: #c51922;
  color: white;
  border: none;
  padding: 8px 8px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.button:hover {
  background-color: #fbeb0f;
}

.type-estrategico {
  color: purple;
  font-weight: bold;
}

.readonly-box {
  border: 1px solid #ccc;
  padding: 10px;
  border-radius: 4px;
  background-color: #f9f9f9b1;
  min-height: 138px;
  max-height: 150px;
  overflow-y: auto;
  white-space: pre-wrap; /* Permite que los saltos de línea sean respetados */
  word-wrap: break-word; /* Permite que las palabras largas se ajusten dentro del contenedor */
  font-family: inherit;
  font-size: 14px;
  
}

.type-estrategico {
  color: #007bff; /* Color para tipo Estratégico */
  font-weight: bold;
  font-size: 14px;
}

.type-operativo {
  color: #28a745; /* Color para tipo Operativo */
  font-weight: bold;
  font-size: 14px;
}

.type-tactico {
  color: #ffc107; /* Color para tipo Táctico */
  font-weight: bold;
  font-size: 14px;
}

.opcion {
  margin-bottom: 20px;
}

/* boton de atras*/

.btn-atras {
  position: absolute; /* Posicionamiento relativo al contenedor */
  top: 10px;          /* Espaciado desde el borde superior */
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

/* editar*/

.edit-input {
  width: 100%;
  height: auto;
  font-size: 14px;
}

.btn {
  margin: 5px;
  padding: 5px 10px;
  font-size: 12px;
  cursor: pointer;
}

.save-btn {
  background-color: #4caf50;
  color: white;
}

.cancel-btn {
  background-color: #f44336;
  color: white;
}

.edit-btn {
  background-color: #2196f3;
  color: white;
}



</style>
