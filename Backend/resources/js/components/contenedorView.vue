

<template>
  <main class="main-content">
    <div class="left-panel">
      <div class="section">
        <h3>OPORTUNIDAD</h3>
        <select multiple>
          <option v-for="op in oportunidades" :key="op">{{ op }}</option>
        </select>
      </div>
      <div class="section">
        <h3>RIESGO</h3>
        <select multiple>
          <option v-for="riesgo in riesgos" :key="riesgo">{{ riesgo }}</option>
        </select>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: "LeftPanel",
  props: {
    oportunidades: {
      type: Array,
      default: () => ["Oportunidad 1", "Oportunidad 2", "Oportunidad 3", "Oportunidad 4"]
    },
    riesgos: {
      type: Array,
      default: () => ["Riesgo 1", "Riesgo 2", "Riesgo 3", "Riesgo 4"]
    }
  }
};
</script>

<style scoped>
.left-panel {
  border: 1px solid #000;
  padding: 16px;
  width: 250px;
}

.section {
  margin-bottom: 16px;
}

h3 {
  font-size: 18px;
  margin-bottom: 8px;
}

select {
  width: 100%;
  height: 80px;
}

.main-content {
  grid-column: 4 / 18;
  grid-row: 3;
  background-color: #ffffff96;
  padding: 10px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);
  height: 450px;
  width: 105%;
  border-radius: 8px;
}
</style>






<!-- <template>

  

</main>

</template>

<script setup>

</script>


<style scoped>






</style> -->