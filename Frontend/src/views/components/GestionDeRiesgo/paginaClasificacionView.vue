<template>
    <div class="pagina">
      <!-- Encabezado de la página -->
      <EncabezadoView />

      <!-- Barra de navegación -->
      <nav class="navigation">
        <ul class="main-nav">
          <div class="main-nav__item">
            <router-link to="/dofa" class="nav-link">DOFA</router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/clasificacion" class="nav-link">Clasificación</router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/controles" class="nav-link">Controles</router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/accion" class="nav-link">Acción</router-link>
          </div>
          <div class="main-nav__item">
            <router-link to="/seguimiento" class="nav-link">Seguimiento</router-link>
          </div>
        </ul>
      </nav>

      <!-- Contenido principal -->
      <main class="main-content">
        <div class="container">
          <!-- Sección izquierda -->
          <div class="panel">
            <div class="panel-section">
              <h3>Oportunidad</h3>
              <div class="list-container">
                <ul>
                  <li>Oportunidad 1</li>
                  <li>Oportunidad 2</li>
                  <li>Oportunidad 3</li>
                  <li>Oportunidad 4</li>
                </ul>
              </div>
            </div>
            <div class="panel-section">
              <h3>Riesgo</h3>
              <div class="list-container">
                <ul>
                  <li>Riesgo 1</li>
                  <li>Riesgo 2</li>
                  <li>Riesgo 3</li>
                  <li>Riesgo 4</li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Sección derecha -->
          <div class="inputs">
            <div class="input-group">
              <label for="causas">Causas Potenciales</label>
              <textarea id="causas"></textarea>
            </div>
            <div class="input-group">
              <label for="efecto">Efecto Potencial</label>
              <textarea id="efecto"></textarea>
            </div>
            <div class="input-group">
              <div class="inline-input">
                <label for="probabilidad1">Probabilidad</label>
                <input id="probabilidad1" type="number" value="5" />
              </div>
              <div class="inline-input">
                <label for="probabilidad2">Probabilidad</label>
                <input id="probabilidad2" type="number" value="5" />
              </div>
            </div>
            <div class="input-group">
              <label for="valoracion">Valoración</label>
              <input id="valoracion" type="text" />
            </div>
            <div class="buttons">
              <button class="btn limpiar">Limpiar</button>
              <button class="btn ingresar">Ingresar</button>
            </div>
          </div>
        </div>
      </main>
    </div>
</template>

<script>
import EncabezadoView from "../EncabezadoView.vue";

export default {
  name: "MainPage",
  components: {
    EncabezadoView,
  },
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

.main-content {
  grid-column: 5 / 17;
  grid-row: 3;
  background-color: #ffffff;
  padding: 20px;
  padding-top: 0;
  box-shadow: 0px 4px 8px rgba(87, 85, 85, 0.8);
}

.container {
  display: flex;
  justify-content: space-between;
}

.panel {
  flex: 1;
  margin-right: 20px;
}

.panel-section {
  margin-bottom: 20px;
}

h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.list-container {
  border: 1px solid #000;
  padding: 10px;
  height: 150px;
  overflow-y: auto;
}

.inputs {
  flex: 1;
  display: flex;
  flex-direction: column;
}

.input-group {
  margin-bottom: 20px;
}

textarea {
  width: 100%;
  height: 50px;
  resize: none;
}

.inline-input {
  display: flex;
  align-items: center;
  margin-right: 10px;
}

.inline-input input {
  margin-left: 10px;
  width: 60px;
}

.buttons {
  display: flex;
  justify-content: space-between;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.limpiar {
  background-color: gold;
  color: black;
}

.ingresar {
  background-color: red;
  color: white;
}
</style>
