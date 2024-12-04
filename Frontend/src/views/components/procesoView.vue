<template>
  <div class="form-page">
    <!-- Botón de Ir Atrás -->
    <div class="back-button-container">
      <button @click="goBack" class="back-btn">← Ir Atrás</button>
    </div>
    <div class="form-container">
      <div class="form-card">
        <div class="card-header">
          <h3>Formulario de Inscripción de Proceso</h3>
        </div>
        <form @submit.prevent="registerProcess">
          <div class="input-group">
            <label for="process-name">Nombre del Proceso</label>
            <input 
              v-model="processName" 
              type="text" 
              id="process-name" 
              required 
              placeholder="Ingresa el nombre del proceso" 
            />
          </div>
          <div class="input-group">
            <label for="description">Descripción</label>
            <textarea 
              v-model="description" 
              id="description" 
              rows="5" 
              required 
              placeholder="Ingresa una descripción del proceso"
            ></textarea>
          </div>
          <button type="submit" class="submit-btn">Registrar Proceso</button>
        </form>
        <div v-if="message" :class="{'success-message': isSuccess, 'error-message': !isSuccess}">
          {{ message }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      processName: "",
      description: "",
      message: null, // Mensaje para éxito o error
      isSuccess: false, // Determina si el mensaje es de éxito o error
    };
  },
  methods: {
    async registerProcess() {
      try {
        // Validaciones básicas
        if (!this.processName || !this.description) {
          this.message = "Por favor completa todos los campos.";
          this.isSuccess = false;
          return;
        }

        // Datos a enviar al backend
        const data = {
          name: this.processName,
          description: this.description,
        };

        // Realiza la solicitud POST al backend de Laravel
        const response = await axios.post("http://localhost:8000/api/processes", data);

        // Si la solicitud es exitosa
        if (response.status === 201) {
          this.message = "El proceso fue registrado exitosamente.";
          this.isSuccess = true;
          // Limpiar los campos del formulario
          this.processName = "";
          this.description = "";
        }
      } catch (error) {
        console.error("Error al registrar el proceso:", error);
        this.message = error.response?.data?.message || "Ocurrió un error al registrar el proceso.";
        this.isSuccess = false;
      }
    },
    goBack() {
      this.$router.go(-1); // Navega a la página anterior
    },
  },
};
</script>

<style scoped>
/* Fondo y diseño general */
.form-page {
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  background-image: url('/src/assets/img/Fondo2.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

/* Contenedor del formulario */
.form-container {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 50%;
  max-width: 600px;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.8);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Tarjeta del formulario */
.form-card {
  width: 100%;
  position: relative; /* Posiciona elementos relativos dentro de la tarjeta */
}

.back-button-container {
  position: absolute;
  top: 10px; /* Ajusta la distancia desde el borde superior */
  left: 60px; /* Ajusta la distancia desde el borde izquierdo */
  z-index: 100;
}

.back-btn {
  padding: 8px 15px;
  background-color: #f4ef86ed;
  color: #000;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 14px;
  font-weight: bold;
}

.back-btn:hover {
  background-color: #acccee;
}

/* Encabezado */
.card-header {
  margin-bottom: 20px;
  text-align: center;
  font-family: 'Lucida Sans', 'Arial', sans-serif;
}

/* Mensajes de éxito y error */
.success-message {
  color: green;
  margin-top: 10px;
  text-align: center;
}

.error-message {
  color: red;
  margin-top: 10px;
  text-align: center;
}

/* Estilo de los campos */
.input-group {
  margin-bottom: 15px;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.input-group input,
.input-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px;
}

/* Botón de enviar */
.submit-btn {
  width: 100%;
  padding: 10px;
  background-color: #f4ef86ed;
  color: #000;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  font-size: 16px;
}

.submit-btn:hover {
  background-color: #acccee;
}

/* Diseño responsivo */
@media (max-width: 768px) {
  .form-container {
    width: 90%;
  }
}
</style>
