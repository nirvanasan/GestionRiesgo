<template>
    <div class="historial-container">
      <h2>Historial de Eventos</h2>
      <div class="historial-box">
        <table>
          <thead>
            <tr>
              <th>Id</th>
              <th>Dofa</th>
              <th>Usuario</th>
              <th>Proceso</th>
              <th>Clasificado</th>
              <th>Fecha Creación</th>
              <th>Fecha Actualización</th>
             
              <th>Tipo</th>
              <th>Causa</th>
              <th>Efecto</th>
              <th>Probabilidad</th>
              <th>Impacto</th>
              <th>Valoración</th>
              <th>Control</th>
             
              <th>Descripción</th>
              <th>Acciones</th>
              <th>Información</th>
              <th>Acción</th>
              <th>Responsable</th>
              <th>Proceso</th>
              <th>Fecha Seguimiento</th>
              <th>Fecha Cierre</th>
              <th>Control Actual</th>
              <th>P1</th>
              <th>P2</th>
              <th>P3</th>
              <th>P4</th>
           
              <th>Fecha</th>
              <th>Valoración Riesgo</th>
              <th>Valoración Control</th>
              <th>Valoración Total</th>
              <th>Justificación</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="evento in historial" :key="evento.id">
              <td>{{ evento.id }}</td>
              <td>{{ evento.Codigo }}</td>
              <td>{{ evento.id_usuario }}</td>
              <td>{{ evento.id_proceso }}</td>
              <td>{{ evento.clasificacion }}</td>
              <td>{{ evento.created_at }}</td>
              <td>{{ evento.updated_at }}</td>
           
              <td>{{ evento.tipo }}</td>
              <td>{{ evento.causa }}</td>
              <td>{{ evento.efecto }}</td>
              <td>{{ evento.probabilidad }}</td>
              <td>{{ evento.impacto }}</td>
              <td>{{ evento.valoracion }}</td>
              <td>{{ evento.control }}</td>
             
              <td>{{ evento.descripcion }}</td>
              <td>{{ evento.acciones }}</td>
              <td>{{ evento.informacion }}</td>
              <td>{{ evento.accion }}</td>
              <td>{{ evento.responsable }}</td>
              <td>{{ evento.proceso }}</td>
              <td>{{ evento.fecha_seguimiento }}</td>
              <td>{{ evento.fecha_cierre }}</td>
              <td>{{ evento.control_actual }}</td>
              <td>{{ evento.p1 }}</td>
              <td>{{ evento.p2 }}</td>
              <td>{{ evento.p3 }}</td>
              <td>{{ evento.p4 }}</td>
         
              <td>{{ evento.fecha }}</td>
              <td>{{ evento.valoracion_riesgo }}</td>
              <td>{{ evento.valoracion_control }}</td>
              <td>{{ evento.valoracion_total }}</td>
              <td>{{ evento.justificacion }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        historial: [],
      };
    },
    async mounted() {
      await this.cargarInfo();
    },
    methods: {
      async cargarInfo() {
        try {
          const response = await fetch("http://127.0.0.1:8000/api/buscar"); // Reemplaza con tu URL real
          if (!response.ok) throw new Error("Error al cargar datos");
          this.historial = await response.json();
        } catch (error) {
          console.error("Error:", error);
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .historial-container {
    width: 100%;
    max-width: 100%;
    margin: auto;
    text-align: center;
  }
  
  .historial-box {
    height: 400px;
    overflow-x: auto;
    border: 1px solid #ccc;
    padding: 10px;
    background: #f9f9f9;
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px; /* Para ajustar muchas columnas */
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 6px;
    text-align: left;
    white-space: nowrap;
  }
  
  th {
    background-color: #f4f4f4;
  }
  </style>
  