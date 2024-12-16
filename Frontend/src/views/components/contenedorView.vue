<template>
  <div class="left-panel">
    <div class="section">
      <h3>OPORTUNIDAD</h3>
      <select v-model="localOportunidadSeleccionada" multiple>
        <option v-for="op in oportunidades" :key="op" :value="op">{{ op }}</option>
      </select>
    </div>
    <div class="section">
      <h3>RIESGO</h3>
      <select v-model="localRiesgoSeleccionado" multiple>
        <option v-for="riesgo in riesgos" :key="riesgo" :value="riesgo">{{ riesgo }}</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  name: "PanelIzquierdo",
  props: {
    oportunidades: {
      type: Array,
      required: true,
    },
    riesgos: {
      type: Array,
      required: true,
    },
    modelValueOportunidadSeleccionada: {
      type: Array,
      default: () => [],
    },
    modelValueRiesgoSeleccionado: {
      type: Array,
      default: () => [],
    },
  },
  computed: {
    localOportunidadSeleccionada: {
      get() {
        return this.modelValueOportunidadSeleccionada;
      },
      set(value) {
        this.$emit("update:modelValueOportunidadSeleccionada", value);
      },
    },
    localRiesgoSeleccionado: {
      get() {
        return this.modelValueRiesgoSeleccionado;
      },
      set(value) {
        this.$emit("update:modelValueRiesgoSeleccionado", value);
      },
    },
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
  margin-bottom: 10px;
}

.section select {
  width: 300px;
  height: 120px;
  font-size: 14px;
  background-color: rgba(240, 248, 255, 0.226);
}

h3 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 8px;
}
</style>
