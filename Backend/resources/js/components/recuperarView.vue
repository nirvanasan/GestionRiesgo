<template>
  <div class="reset-password-page">
    <div class="grid-container">
      <div class="logo">
        <img src="" class="logo-img" />
      </div>
      <!-- Columna izquierda con la imagen -->
      <div class="left-side">
        <img src="" class="reset-img" />
      </div>

      <!-- Columna derecha con el formulario -->
      <div class="right-side">
        <div class="reset-card">
          <div class="card-section">
            <h2>Recupera tu contraseña</h2>
          </div>
          <form @submit.prevent="handleSubmit">
            <!-- Campo de correo -->
            <div v-if="step === 1" class="input-group">
              <label for="email">Correo electrónico</label>
              <input
                v-model="email"
                type="email"
                id="email"
                required
                placeholder="Ingresa tu correo"
              />
              <button type="submit" class="submit-btn1">Enviar</button>
            </div>

            <!-- Campo de token -->
            <div v-if="step === 2" class="input-group">
              <label for="token">Código de verificación</label>
              <input
                v-model="token"
                type="text"
                id="token"
                required
                placeholder="Ingresa el código recibido"
              />
              <button type="submit" class="submit-btn1">Verificar</button>
            </div>

            <!-- Campos de nueva contraseña -->
            <div v-if="step === 3">
              <div class="input-group">
                <label for="new-password">Nueva contraseña</label>
                <input
                  v-model="newPassword"
                  type="password"
                  id="new-password"
                  required
                  placeholder="Ingresa tu nueva contraseña"
                />
              </div>
              <div class="input-group">
                <label for="confirm-password">Confirmar contraseña</label>
                <input
                  v-model="confirmPassword"
                  type="password"
                  id="confirm-password"
                  required
                  placeholder="Confirma tu nueva contraseña"
                />
              </div>
              <button type="submit" class="submit-btn">Restablecer</button>
            </div>
          </form>
          <div class="links">
            <router-link to="/login" class="back-login">Volver al login</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      step: 1, // Controla la etapa del formulario
      email: '',
      token: '',
      newPassword: '',
      confirmPassword: '',
    };
  },
  methods: {
    handleSubmit() {
      if (this.step === 1) {
        console.log('Enviando correo a:', this.email);
        // Aquí iría la lógica para enviar el token al correo
        this.step = 2;
      } else if (this.step === 2) {
        console.log('Verificando token:', this.token);
        // Aquí se verificaría el token con el backend
        this.step = 3;
      } else if (this.step === 3) {
        if (this.newPassword !== this.confirmPassword) {
          alert('Las contraseñas no coinciden');
          return;
        }
        console.log('Restableciendo contraseña...');
        // Aquí iría la lógica para cambiar la contraseña en el backend
        alert('Contraseña restablecida con éxito');
      }
    },
  },
};
</script>

<style scoped>
.reset-password-page {
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url('img/Fondo1.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.grid-container {
  display: grid;
  grid-template-columns: repeat(10, 1fr);
  grid-template-rows: repeat(10, 1fr);
  width: 80%;
  max-width: 1200px;
  height: 100%;
}

.left-side {
  display: flex;
  justify-content: center;
  align-items: center;
  grid-column: 3/6;
  grid-row: 3/10;
  border-radius: 10px;
  background: rgba(245, 225, 164, 0.9) url('img/galletita.svg') no-repeat center;
  background-size: 90% 90%;
  background-position: center;
}

.right-side {
  background-color: rgb(211, 12, 12);
  display: flex;
  justify-content: center;
  align-items: center;
  grid-column: 6/10;
  grid-row: 3/10;
  border-radius: 10px;
  font-family: 'Lucida Sans', sans-serif;
}

.reset-card {
  width: 300px;
  padding: 20px;
  margin: 20px auto;
  border-radius: 10px;
  background-color: transparent;
}

.card-section {
  margin-bottom: 20px;
  text-align: center;
}

.input-group {
  margin-bottom: 15px;
  font-size: 12px;
  padding-bottom: 20px !important;
}

.input-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.input-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #f9f3f3;
  border-radius: 4px;
  
}

.submit-btn {
  width: 50%;
  padding: 10px;
  background-color: #f4ef86ed;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin: 0 auto;
  display: block;
}
.submit-btn1 {
  margin-top: 20px !important;
  width: 50%;
  padding: 10px;
  background-color: #f4ef86ed;
  color: rgb(0, 0, 0);
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin: 0 auto;
  display: block;
}

.submit-btn:hover {
  background-color: #acccee;
}

.links {
  display: flex;
  justify-content: center;
  margin-top: 10px;
  text-align: center;
}

.links a {
  display: block;
  color: #000000;
  text-decoration: none;
  margin-bottom: 5px;
}

.links a:hover {
  text-decoration: underline;
}

.logo {
  grid-column: 1/4;
  grid-row: 1/4;
  background-image: url('img/Logo-Tomy.png');
  background-size: cover;
  background-position: 3px;
  background-repeat: no-repeat;
  display: flex;
  width: 200px;
  height: 100px;
}

@media (max-width: 768px) {
  .grid-container {
    grid-template-columns: 1fr;
    width: 90%;
  }

  .reset-img {
    max-width: 200px;
  }
}
</style>
