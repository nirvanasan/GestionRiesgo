<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />
    <!-- Barra de navegación -->
    <NavegacionView/>

    <main class="main-content">
      <section class="input-container">
        <div class="right-section">
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

        <div class="left-column">
            <label>Debilidad</label>
            <div class="readonly-box">
              <span v-if="debilidades.length === 0" style="color: gray; font-style: italic">Aquí va la Debilidad</span>
              <p v-for="(item, index) in debilidades" :key="index">
                <span :class="getTypeClass(item.type)">
                  {{ item.type }}:
                </span>
                {{ item.text }}
              </p>
            </div>

            <label>Oportunidad</label>
            <div class="readonly-box">
              <span v-if="oportunidades.length === 0" style="color: gray; font-style: italic">Aquí va la Oportunidad</span>
              <p v-for="(item, index) in oportunidades" :key="index">
                <span :class="getTypeClass(item.type)">
                  {{ item.type }}:
                </span>
                {{ item.text }}
              </p>
            </div>
          </div>

          <div class="right-column">
            <label>Fortaleza</label>
            <div class="readonly-box">
              <span v-if="fortalezas.length === 0" style="color: gray; font-style: italic">Aquí va la Fortaleza</span>
              <p v-for="(item, index) in fortalezas" :key="index">
                <span :class="getTypeClass(item.type)">
                  {{ item.type }}:
                </span>
                {{ item.text }}
              </p>
            </div>

            <label>Amenaza</label>
            <div class="readonly-box">
              <span v-if="amenazas.length === 0" style="color: gray; font-style: italic">Aquí va la Amenaza</span>
              <p v-for="(item, index) in amenazas" :key="index">
                <span :class="getTypeClass(item.type)">
                  {{ item.type }}:
                </span>
                {{ item.text }}
              </p>
            </div>

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
import NavegacionView from "../navegacionView.vue";

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
      selectedCuadrante: "Debilidad",
      selectedTipo: "Estratégico",
    };
  },
  computed: {
    // Computado para deshabilitar el botón "Enviar" si hay campos vacíos
    isEnviarDisabled() {
      return !(this.input1 && this.input2 && this.input3 && this.input4);
    }
  },

  
  methods: {
  handleSubmit() {
    if (!this.descripcion.trim()) {
      alert("Datos enviados!!.");
      return;
    }

    // Creación del objeto con texto y tipo
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

    this.descripcion = ""; // Limpia el campo de descripción
  },

  limpiar() {
    this.debilidades = [];
    this.oportunidades = [];
    this.fortalezas = [];
    this.amenazas = [];
  },


   // Nueva función para determinar la clase CSS
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
    // Validación: todos los campos de la DOFA deben estar llenos antes de enviar
    if (this.isEnviarDisabled) {
      alert('Por favor, complete todos los campos de la DOFA antes de enviar.');
      return;
    }

    // Datos a enviar
    const data = {
      debilidad: this.input1,
      oportunidad: this.input2,
      fortaleza: this.input3,
      amenaza: this.input4
    };

    // Envía los datos mediante una petición POST
    fetch('https://tudominio.com/api/enviar', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    })
      .then(response => response.json())
      .then(data => {
        console.log('Datos enviados con éxito:', data);
        alert('Datos enviados correctamente.');
      })
      .catch(error => {
        console.error('Error al enviar los datos:', error);
        alert('Error al enviar los datos.');
      });
  },

 
}
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
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffffc0;
  padding: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
}


.input-container {
  display: flex;
  justify-content: space-between;
  gap: 40px;
}

.left-column,
.right-column {
  display: flex;
  flex-direction: column;
  gap: 10px;
  width: 38%;
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
  gap: 20px;
  max-width: 400px;
  margin-left: 30px;
  transform: translateY(35px);
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


</style>
