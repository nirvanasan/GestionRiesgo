<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
          <EncabezadoView/>
      <!-- Contenido principal -->
      <!-- Barra de navegación -->
      <nav class="navigation">
        <ul class="main-nav">

          <div class="main-nav__item">
            <router-link to="/dofa" class="create-account"><a router class="nav-link">Dofa</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/clasificacion" class="create-account"><a href="#" class="nav-link">Clasificación</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/controles" class="create-account"><a href="#" class="nav-link">Controles</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/accion" class="create-account"><a href="#" class="nav-link">Acción</a></router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/seguimiento" class="create-account"><a  class="nav-link">Seguimiento</a></router-link>
          </div>
        </ul>
      </nav>
      <main class="main-content">
        <section class="input-container">

          <div class="right-section">
    <!-- Selector de Cuadrante -->
              <div class="form-group">
                <label for="cuadrante">Seleccione un cuadrante</label>
                <select v-model="selectedCuadrante" id="cuadrante">
                  <option value="Fortaleza" >Fortaleza</option>
                  <option value="Debilidad" >Debilidad</option>
                  <option value="Oportunidad" >Oportunidad</option>
                  <option value="Amenaza" >Amenaza</option>
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
                <button @click="handleSubmit"  class="btn ingresar-btn">Ingresar</button>
                
              </div>
            </div>


            <div class="left-column">
              <label for="descripcion">Debilidad</label>
              <textarea v-model="input1" readonly placeholder="Aquí va la Debilidad"></textarea>
              <label for="descripcion">Oportunidad</label>
              <textarea v-model="input2" readonly placeholder="Aquí va la Oportunidad"></textarea>
            </div>
            <div class="right-column">
              <label for="descripcion">Fortaleza</label>
              <textarea v-model="input3" readonly placeholder="Aquí va la Fortaleza"></textarea>
              <label for="descripcion">Amenaza</label>
              <textarea v-model="input4" readonly placeholder="Aquí va la Amenaza"></textarea>
              <div class="button-container">
                <button class="button ">
                  Enviar datos
                </button>
              </div>
              
            </div>
            


      </section>

      </main>
    </div>
  </template>
  
  <script>
import EncabezadoView from '../EncabezadoView.vue';

export default {
  name: 'MainPage',
  components: {
    EncabezadoView
  },
  data() {
    return {
      input1: '',
      input2: '',
      input3: '',
      input4: '',
      descripcion: '',
      selectedCuadrante: 'Debilidad',
      selectedTipo: ''
    };
  },
  computed: {
    // Computado para deshabilitar el botón si hay campos vacíos
    isEnviarDisabled() {
      return !(this.input1 && this.input2 && this.input3 && this.input4);
    }
  },
  methods: {
    handleSubmit() {
      console.log('Cuadrante:', this.selectedCuadrante);
      console.log('Tipo:', this.selectedTipo);
      console.log('Descripción:', this.descripcion);

      const viñeta = '• ';

      switch (this.selectedCuadrante) {
        case 'Debilidad':
          this.input1 += viñeta + this.descripcion + '\n';
          break;
        case 'Oportunidad':
          this.input2 += viñeta + this.descripcion + '\n';
          break;
        case 'Fortaleza':
          this.input3 += viñeta + this.descripcion + '\n';
          break;
        case 'Amenaza':
          this.input4 += viñeta + this.descripcion + '\n';
          break;
      }

      this.descripcion = '';
    },
    limpiar() {
      this.input1 = '';
      this.input2 = '';
      this.input3 = '';
      this.input4 = '';
    },
    enviarDatos() {
      if (this.isEnviarDisabled) {
        alert('Por favor, complete todos los campos de la DOFA antes de enviar.');
        return;
      }

      const data = {
        debilidad: this.input1,
        oportunidad: this.input2,
        fortaleza: this.input3,
        amenaza: this.input4
      };

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
  
  .container {
  grid-column: 4 / 19; /* Ocupa todas las columnas */
  grid-row: 1 / 2; /* Ocupa la primera fila */
  display: flex;
  justify-content: space-between;
  height: 150px;
  border: 2px solid white;
  border-radius: 5px;
  background-color: rgba(255, 255, 255, 0.9);
 
}
  
  .navigation {
    grid-column: 5 / 17; /* Ocupa de la columna 5 a la 17 */
    grid-row: 2 / 3; /* Debajo del header */
    margin-top: 50px;
  
  }
  
  .main-nav {
    display: flex;
    justify-content: space-around;
  }
  
  .main-content {
    grid-column: 4 / 18; /* Ocupa de la columna 5 a la 17 */
    grid-row: 3; /* Empieza desde la fila 3 */
    background-color: #ffffffc0;
    padding: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
    height: 450px; /* Ajusta la altura según tus necesidades */
    width: 105%; /* Ajusta el ancho según tus necesidades */
    border-radius: 8px;
    

}


.box1 {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-image: url('/src/assets/img/Logo-Tomy.png');
  background-size: 200px; /* Ajusta el tamaño de la imagen */
  background-repeat: no-repeat; /* Evita que la imagen se repita */
  background-position: center; /* Mueve el logo hacia abajo */
}

.box {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  
}

.box p {
  color: black;
  margin: 5px 0;
}

.button {
  background-color: #C51922;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s;
}

.button:hover {
  background-color: #fbeb0f;
}
  
.logo {
    max-width: 100px;
    max-height: 100px;
  }
  
  .logout-button {
    padding: 10px 15px;
    font-size: 16px;
    background-color: #c91717;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  .logout-button:hover {
    background-color: rgba(237, 172, 172, 0.863);
  }
  
  .nav-link {
    padding: 10px 40px;
    color: white;
    border-radius: 10px;
    text-decoration: none;
    background-color: #c91717;
    
  }
  .nav-link a{
    text-decoration: none;
  }
  
  .nav-link:hover {
    background-color: white;
    color: red;
  }


  .input-container {
  display: flex;
  justify-content: space-between; /* Distribuye columnas a los extremos */
  gap: 40px; /* Espacio entre columnas */
  margin-left: 400px; /* Desplaza el contenedor completo a la derecha */
}

.left-column,
.right-column {
  display: flex;
  flex-direction: column;
  gap: 10px; /* Espacio entre textareas */
  width: 38%; /* Cada columna ocupa casi la mitad del contenedor */
  
  
}


textarea {
  padding: 15px; /* Espacio interno para aumentar el tamaño */
  font-size: 18px; /* Tamaño de la fuente más grande */
  height: 150px; /* Altura específica para agrandar el campo */
  border: 2px solid #000000;
  border-radius: 8px; /* Bordes más redondeados */
  resize: vertical; /* Permite redimensionar verticalmente */
  box-sizing: border-box; /* Incluye el padding en el tamaño total */
  background-color: #f4f1f1c7;
  
}

.right-section {
  display: flex;
  flex-direction: column;
  gap: 20px;
  max-width: 400px;
  margin-left: 30px;
  transform: translateY(35px); /* Baja la sección 20px */
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
  display: flex;                /* Usamos Flexbox */
  justify-content: flex-end;     /* Alinea el contenido (botón) a la derecha */
  padding: 10px;                /* Espaciado interno si lo necesitas */
  gap: 10px;                    /* Espacio entre elementos dentro del contenedor */
  width: 90%;                  /* Asegura que el contenedor ocupe todo el ancho disponible */
}


.enviar-btn {
  width: 100px;
  height: 40px;
  text-align: center;
  margin-left: auto; /* Esto mueve el botón hacia la derecha */
  background-color: #a2e7b2; /* Puedes cambiar el color aquí si lo deseas */
  color: rgb(213, 123, 123);
  border-radius: 4px;
  margin-left: auto;
}  
.enviar-btn:hover {
  background-color: #fbeb0f; /* Verde más oscuro */
  color: white;
}
.button-group  {
  display: flex;
  justify-content: space-between;
  gap: 10px; /* Añade espacio uniforme entre botones */
}

.disabled-btn {
  background-color: #C51922;;
  color: #ffffff;
}


.btn {
  padding: 8px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-weight: bold;
  font-size: 10px; /* Reduce el tamaño del texto */
}

.limpiar-btn {
  background-color: #d4af37; /* Color dorado */
  color: rgb(255, 255, 255);
}

.ingresar-btn {
  background-color: #e63946; /* Color rojo */
  color: rgb(255, 255, 255);
}


  /* */
  </style>