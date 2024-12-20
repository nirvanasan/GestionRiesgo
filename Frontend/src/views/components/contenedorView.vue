<template>
  <div class="left-panel">
    <div class="section">
      <h3>OPORTUNIDAD</h3>
      <select v-model="oportunidadSeleccionada">
        <option v-for="op in oportunidades" :key="op" :value="op">{{ op }}</option>
      </select>
    </div>
    <div class="section">
      <h3>RIESGO</h3>
      <select v-model="riesgoSeleccionado">
        <option v-for="riesgo in riesgos" :key="riesgo" :value="riesgo">{{ riesgo }}</option>
      </select>
    </div>
    <div class="section">
      <h3>INFORMACIÓN GENERAL</h3>
      <textarea v-model="informacionGeneral" placeholder="Escribe información general..."></textarea>
    </div>
  </div>
</template>

<script>
export default {
  name: "LeftPanel",
  data() {
    return {
      oportunidades: ["Oportunidad 1", "Oportunidad 2", "Oportunidad 3", "Oportunidad 4"],
      riesgos: ["Riesgo 1", "Riesgo 2", "Riesgo 3", "Riesgo 4"],
      oportunidadSeleccionada: "",
      riesgoSeleccionado: "",
      informacionGeneral: "",
    };
  },
};
</script>

<style scoped>
.left-panel {
  padding: 20px;
  width: 270px;
  margin: 0px 55px;
}

.section {
  margin-bottom: 20px;
}

.section select {
  width: 250px;
  height: 35px;
  font-size: 14px;
  background-color: rgba(240, 248, 255, 0.226);
}

.section textarea {
  width: 250px;
  height: 100px;
  font-size: 14px;
  background-color: rgba(240, 248, 255, 0.226);
  padding: 5px;
  resize: none;
}

h3 {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 8px;
}
</style>
