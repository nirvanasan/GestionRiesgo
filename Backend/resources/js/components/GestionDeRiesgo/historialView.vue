<template>
    <div class="historial-container">
      <h2>Historial de Eventos</h2>
      <div class="historial-box">
        <ul>
          <li v-for="(evento, index) in historial" :key="index">
            {{ evento }}
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        historial: [
          "Evento 1: Se realizó una actualización",
          "Evento 2: Se agregó un nuevo usuario",
          "Evento 3: Se eliminó un registro",
          "Evento 4: Se modificó un permiso",
          "Evento 4: Se modificó un permiso",
          "Evento 3: Se eliminó un registro",
          "Evento 4: Se modificó un permiso",
          "Evento 4: Se modificó un permiso",
          
        ], // Aquí puedes cargar los datos del backend
      };
    },
  };
  </script>
  
  <style scoped>
  .historial-container {
    width: 100%;
    max-width: 900px;
    margin: auto;
    text-align: center;
  }
  
  .historial-box {
    height: 200px;
    overflow-y: auto;
    border: 1px solid #ccc;
    padding: 10px;
    background: #f9f9f9;
  }
  
  ul {
    list-style: none;
    padding: 0;
  }
  
  li {
    padding: 5px;
    border-bottom: 1px solid #ddd;
  }
  
  li:last-child {
    border-bottom: none;
  }
  </style>
  