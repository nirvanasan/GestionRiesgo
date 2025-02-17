<template>
  <div class="pagina">
    <!-- Encabezado de la página -->
    <EncabezadoView />

    <!-- Barra de navegación -->
    <NavegacionView />

    <!-- Contenido principal -->
    <main class="main-content">
      <div class="left-panel">
        <div class="section">
          <a href="/VerDofa" target="_blank" class="create-account nav-link">VER DOFA</a>
          <h3>OPORTUNIDAD</h3>
          <select v-model="oportunidadSeleccionada" @change="actualizarSeleccion('oportunidad')">
            <option v-for="op in oportunidades" :key="op.id" :value="op">{{ op.id_elemento + ": " + op.descripcion }}</option>
          </select>
        </div>
        <div class="section">
          <h3>RIESGO</h3>
          <select v-model="riesgoSeleccionado" @change="actualizarSeleccion('riesgo')">
            <option v-for="riesgo in riesgos" :key="riesgo.id" :value="riesgo">{{ riesgo.id_elemento + ": " + riesgo.descripcion }}</option>
          </select>
        </div>
        <div class="section">
          <h3>INFORMACIÓN GENERAL</h3>
          <textarea v-model="informacionGeneral" placeholder="Escribe aquí la información general"></textarea>
        </div>  
      </div>

      <!-- Contenedor derecho -->
      <div class="contenedor-derecha">
        <input type="text" v-model="accionRecomendada" placeholder="Acción recomendada" />

        <!-- <div class="select-container">
            <select 
              v-model="responsable"
              class="custom-select"
              :class="{ 'option-selected': responsable !== '' }">
              <option disabled value="">Seleccione un responsable </option>
              <option v-for="opcion in Responsables" :key="opcion.id" :value="opcion.nombre">
                {{ opcion.nombre }}
              </option>
            </select>
          </div> -->

        <div class="select-container">
            <select v-model="responsable" class="custom-select"
            :class="{ 'option-selected': responsable !== '' }">
              <option disabled value="">Seleccione un responsable </option>
              <option v-for="opcion in responsables" :key="opcion.id" :value="opcion.name">
                {{ opcion.name }}
              </option>
            </select>
          </div>

          
        <input type="text" v-model="accion" placeholder="Acción" />
        <!-- Selector para el proceso con flecha -->
          <div class="select-container">
            <select v-model="proceso" class="custom-select"
            :class="{ 'option-selected': proceso !== '' }">
              <option disabled value="">Seleccione un proceso</option>
              <option v-for="opcion in procesos" :key="opcion.id" :value="opcion.nombre">
                {{ opcion.nombre }}
              </option>
            </select>
          </div>
          
        <div class="fechas">
          <div>
            <label>Fecha de cierre de las acciones </label>
            <input type="date" v-model="fechaCierre" />
          </div>
          <div>
            <label>Fecha de próxiomo seguimiento </label>
            <input type="date" v-model="fechaSeguimiento" />
          </div>
          <!-- <div>
            <label>Fecha de de proximo seguimiento al riesgo </label>
            <input type="date" v-model="fechaCierre" />
          </div> -->
         
          <!-- <div class="probabilidad-impacto">
            <input type="text" v-model="probabilidad" placeholder="Probabilidad" />
            <input type="text" v-model="impacto" placeholder="Impacto" />
          </div> -->
        </div>

        <div class="valor-botones">
          <!-- <input type="text" v-model="valor" placeholder="Valor" /> -->
          <button @click="limpiarCampos">Limpiar</button>
          <button @click="enviarDatos">Ingresar</button>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import EncabezadoView from '../EncabezadoView.vue';
import NavegacionView from "../navegacionView.vue";
import axios from "axios";

export default {
  components: {
    EncabezadoView,
    NavegacionView,
  },
  data() {
    return {
      oportunidades: [],
      riesgos: [],
      oportunidadSeleccionada: null,
      riesgoSeleccionado: null,
      informacionGeneral: "",
      accionRecomendada: "",
      responsable: "",
      responsables: [],
      accion: "",
      proceso: "",
      procesos: [],
      fechaCierre: "",
      fechaSeguimiento: "",
      probabilidad: "",
      impacto: "",
      valor: "",
      user: {}
    };
  },
  methods: {

    actualizarSeleccion(tipo) {
      if (tipo === 'oportunidad') {
        this.riesgoSeleccionado = null;
      } else if (tipo === 'riesgo') {
        this.oportunidadSeleccionada = null;
      }
    },

    // Método para cargar responsables desde el backend
    async cargarResponsables() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/cargar-usuarios");
        this.responsables = response.data.users;
        console.log(response.data)
      } catch (error) {
        console.error("Error al cargar los responsables:", error);
        alert("No se pudieron cargar los responsables.");
      }
    },

    async cargarProcesos() {
      try {
        const response = await axios.get("http://127.0.0.1:8000/api/procesos-buscar");
        this.procesos = response.data;
      } catch (error) {
        console.error("Error al cargar los procesos:", error);
        this.error = "No se pudieron cargar los procesos.";
      }
    },

    // Método para obtener controles desde el backend
    async obtenerControles() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/cargar-controles', {
          params: { usuario: this.user.id },
        });

        this.oportunidades = response.data.controles.filter(
          control => control.tipo === 'Oportunidad'
        );
        this.riesgos = response.data.controles.filter(
          control => control.tipo === 'Riesgo'
        );
      } catch (error) {
        console.error('Error al obtener los controles:', error);
        alert('Error al cargar los datos de controles.');
      }
    },

    

    // Método para limpiar los campos
    limpiarCampos() {
      this.oportunidadSeleccionada = null;
      this.riesgoSeleccionado = null;
      this.informacionGeneral = "";
      this.accionRecomendada = "";
      this.responsable = "";
      this.accion = "";
      this.proceso = "";
      this.fechaCierre = null;
      this.fechaSeguimiento = null;
      this.probabilidad = "";
      this.impacto = "";
      this.valor = "";
    },

    
    async enviarDatos() {

    if (
      !this.oportunidadSeleccionada && !this.riesgoSeleccionado || // Debe seleccionarse oportunidad o riesgo
      !this.informacionGeneral.trim() || // Información general es obligatoria
      !this.accionRecomendada.trim() || // Acción recomendada es obligatoria
      !this.responsable || // Responsable es obligatorio
      !this.accion.trim() || // Acción es obligatoria
      !this.proceso || // Proceso es obligatorio
      !this.fechaSeguimiento || // Fecha de seguimiento es obligatoria
      !this.fechaCierre // Fecha de cierre es obligatoria
    ) {
      alert("Por favor, complete todos los campos obligatorios antes de enviar.");
      return; // Detener el envío
    }

      if(this.oportunidadSeleccionada){


        try {

          await axios.post("http://127.0.0.1:8000/api/acciones", {
            id_elemento: this.oportunidadSeleccionada.id_elemento,
            tipo: "Oportunidad",
            informacion: this.informacionGeneral,
            accion: this.accionRecomendada,
            responsable: this.responsable,
            acciones: this.accion,
            proceso: this.proceso,
            fecha_seguimiento: this.fechaSeguimiento,
            fecha_cierre: this.fechaCierre,
          });

          alert("Acción registrada exitosamente.");
          this.limpiarCampos();
        } catch (error) {
          console.error("Error al enviar los datos:", error);
          alert("Ocurrió un error al registrar la acción.");
        }

      }else {


        try {

          await axios.post("http://127.0.0.1:8000/api/acciones", {
            id_elemento: this.riesgoSeleccionado.id_elemento,
            tipo: "Riesgo",
            informacion: this.informacionGeneral,
            accion: this.accionRecomendada,
            responsable: this.responsable,
            acciones: this.accion,
            proceso: this.proceso,
            fecha_seguimiento: this.fechaSeguimiento,
            fecha_cierre: this.fechaCierre,
          });

          alert("Acción registrada exitosamente.");
          this.limpiarCampos();
          } catch (error) {
          console.error("Error al enviar los datos:", error);
          alert("Ocurrió un error al registrar la acción.");
          }


      }

      }

      


  },
  mounted() {
    const userData = localStorage.getItem("user");
    if (userData) {
      this.user = JSON.parse(userData);
      this.cargarResponsables();
      this.obtenerControles();
      this.cargarProcesos();
    }
   
    
  }
};
</script>


  
  <style scoped>
  .pagina {
    display: grid;
    grid-template-columns: repeat(20, 1fr); /* 20 columnas iguales */
    grid-template-rows: 100px 100px auto; /* Filas más pequeñas */
    background-image: url('../img/Fondo2.png');
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
  height: 450px;
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
  width: 96%;
  padding: 8px;
  border: 1px solid #000000e6;
  border-radius: 4px;
  background-color: #fdfdfd83;
}

.contenedor-derecha .fechas {
  display: flex;
  gap: 10px;
}

.contenedor-derecha .fechas div {
  display: flex;
  flex-direction: column;
  width: 200px;
  gap: 5px; 
  height: 35px
}

.contenedor-derecha .probabilidad-impacto {
  display: flex;
  justify-content: space-between;
  width: 300px;
  gap: 2px; 
}

.probabilidad-impacto input {
  width: 245px; /* Ajusta este valor según el tamaño deseado */
  height: 30px; /* Opcional: ajustar la altura */
  font-size: 12px; /* Opcional: ajustar el tamaño de la fuente */
  padding: 2px; /* Opcional: ajustar el relleno interno */
}

.contenedor-derecha {
  display: flex;
  justify-content: space-between;
}

.valor-botones  {
  display: flex;
  width: 50px; /* Cambia este valor según el tamaño deseado */
  gap: 20px;
}


button {
  padding: 10px;
  border: none;
  border-radius: 4px;
  color: #ffe0e0;
  cursor: pointer;
  background-color: rgb(235, 41, 41); /* Verde para ingresar */
  position: relative;
  top: 19px; /* Mueve el botón hacia abajo */
}
 button:hover{
  background-color: #ffe100;
  color: black;
 }

/* estilo de eleccion */

/* Contenedor para posicionar el select y la flecha */
.select-container {
  position: relative;
  width: 100%; /* Ajusta el ancho del contenedor según sea necesario */
}

/* Personalización del select */
.custom-select {
  width: 99%;
  padding: 9px;
  font-size: 13px;
  border-radius: 5px;
  background-color: #f9f9f9d7;
  color: #898282;
  appearance: none; /* Oculta la flecha nativa */
  -webkit-appearance: none;
  -moz-appearance: none;

}

.custom-select.option-selected {
  color: #000000; /* Darker text color */
  background-color: #fff5f598; /* Temporary background to test */
}


/* Flecha personalizada */
.select-container::after {
  content: "▼"; /* Flecha hacia abajo */
  font-size: 18px; /* Tamaño de la flecha */
  color: #000000; /* Color de la flecha */
  position: absolute;
  top: 50%; /* Centrar verticalmente */
  right: 15px; /* Mueve la flecha más a la derecha */
  transform: translateY(-50%);
  pointer-events: none; /* Evita que interfiera con clics */
}
/* diseño de los botones de eleccion */
.nav-link {
padding: 5px 10px;
color: white;
border-radius: 10px;
text-decoration: none;
background-color: #c91717;

}

.main-nav {
    display: flex;
    gap: 20px; /* Espaciado entre los botones */
    text-align: center;
}

.nav-link:hover {
background-color: white;
color: red;
}

  </style>