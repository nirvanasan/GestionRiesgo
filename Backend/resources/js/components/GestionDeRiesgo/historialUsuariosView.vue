<template>
  <div class="historial-container">
    <button @click="volver" class="btn-volver">⬅ Volver</button>
    <h2>Historial de Eventos</h2>

    <div class="historial-box">
      <button @click="descargarExcel" class="btn-descargar">📊 Descargar Excel</button>

      <table ref="tabla">
        <thead>
          <tr>
            <th colspan="5" class="header-dofa">DOFA</th>
            <th colspan="6" class="header-riesgo">Clasificacion</th>
            <th colspan="3" class="header-gestion">Controles</th>
            <th colspan="7" class="header-valoraciones">Acciones</th>
            <th colspan="12" class="header-seguimiento">Seguimiento</th>
          </tr>


          <tr>

            <!-- DOFA -->
            <th>Id</th>
            <th>Codigo Dofa</th>
            <th>Usuario</th>
            <th>Proceso</th>
            <th>Fecha Creación</th>
          
            <!-- Clasificacion -->

            <th>Tipo</th>
            <th>Causa</th>
            <th>Efecto</th>
            <th>Probabilidad</th>
            <th>Impacto</th>
            <th>Valoración</th>
       
            <!-- Controles -->
            
            <th>Descripcion</th>
            <th>Probabilidad</th>
            <th>Impacto</th>

            <!-- Acciones -->

            <th>Información</th>
            <th>Acción</th>
            <th>Responsable</th>
            <th>Acciones</th>
            <th>Proceso</th>
            <th>Fecha Seguimiento</th>
            <th>Fecha Cierre</th>
         
            <!-- Seguimiento -->

            <th>Control actual</th>
            <th>Pregunta 1</th>
            <th>Pregunta 2</th>
            <th>Pregunta 3</th>
            <th>Pregunta 4</th>
            <th>Probabilidad</th>
            <th>Fecha</th>
            <th>Impacto</th>
            <th>Valoración Riesgo</th>
            <th>Valoración Control</th>
            <th>Valoración Total</th>
            <th>Justificación</th>
          </tr>
        </thead>
        <tbody>
            <tr v-for="evento in historial" :key="evento.id">


              <!-- DOFA -->

              <td>{{ evento.dofa_id }}</td>
              <td>{{ evento.dofa_codigo }}</td>
              <td>{{ evento.dofa_usuario }}</td>
              <td>{{ evento.dofa_proceso }}</td>
              <td>{{ evento.dofa_created_at }}</td>

              <!-- Clasificacion -->

              <td>{{ evento.clasificacion_tipo }}</td>
              <td>{{ evento.clasificacion_causa }}</td>
              <td>{{ evento.clasificacion_efecto }}</td>
              <td>{{ evento.clasificacion_probabilidad }}</td>
              <td>{{ evento.clasificacion_impacto }}</td>
              <td>{{ evento.clasificacion_valoracion }}</td>

              <!-- Controles -->

              <td>{{ evento.control_descripcion }}</td>
              <td>{{ evento.control_probabilidad }}</td>
              <td>{{ evento.control_impacto }}</td>

              <!-- Acciones -->

              <td>{{ evento.accion_informacion }}</td>
              <td>{{ evento.accion_detalle }}</td>
              <td>{{ evento.accion_responsable }}</td>
              <td>{{ evento.accion_acciones }}</td>
              <td>{{ evento.accion_proceso }}</td>
              <td>{{ evento.accion_fecha_seguimiento }}</td>
              <td>{{ evento.accion_fecha_cierre }}</td>

              <!-- Seguimiento -->

              <td>{{ evento.seguimiento_control_actual }}</td>
              <td>{{ evento.seguimiento_p1 }}</td>
              <td>{{ evento.seguimiento_p2 }}</td>
              <td>{{ evento.seguimiento_p3 }}</td>
              <td>{{ evento.seguimiento_p4 }}</td>
              <td>{{ evento.seguimiento_probabilidad }}</td>
              <td>{{ evento.seguimiento_fecha }}</td>
              <td>{{ evento.seguimiento_impacto }}</td>
              <td>{{ evento.seguimiento_valoracion_riesgo }}</td>
              <td>{{ evento.seguimiento_valoracion_control }}</td>
              <td>{{ evento.seguimiento_valoracion_total }}</td>
              <td>{{ evento.seguimiento_justificacion }}</td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import * as XLSX from "xlsx";
import { saveAs } from "file-saver";

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
        const response = await fetch("http://127.0.0.1:8000/api/buscarr");
        console.log(response);
        if (!response.ok) throw new Error("Error al cargar datos");
        this.historial = await response.json();
      } catch (error) {
        console.error("Error:", error);
      }
    },
    volver() {
      this.$router.push('/seguimiento');
    },
    descargarExcel() {
      const wb = XLSX.utils.book_new();
      const ws = XLSX.utils.aoa_to_sheet([
        ["DOFA", "", "", "", "", "", "", "Análisis de Riesgo", "", "", "", "", "", "", "Gestión y Seguimiento", "", "", "", "", "", "", "", "", "", "", "", "", "Valoraciones", "", "", "", ""],
        ["Id", "Dofa", "Usuario", "Proceso", "Clasificado", "Fecha Creación", "Fecha Actualización",
        "Tipo", "Causa", "Efecto", "Probabilidad", "Impacto", "Valoración", "Control",
        "Descripción", "Acciones", "Información", "Acción", "Responsable", "Proceso", "Fecha Seguimiento", "Fecha Cierre", "Control Actual",
        "P1", "P2", "P3", "P4", "Fecha",
        "Valoración Riesgo", "Valoración Control", "Valoración Total", "Justificación"]
      ]);

      // Ajustar el merge de columnas para las secciones
      ws["!merges"] = [
        { s: { r: 0, c: 0 }, e: { r: 0, c: 6 } },  // DOFA (7 columnas)
        { s: { r: 0, c: 7 }, e: { r: 0, c: 13 } }, // Análisis de Riesgo (7 columnas)
        { s: { r: 0, c: 14 }, e: { r: 0, c: 26 } }, // Gestión y Seguimiento (13 columnas)
        { s: { r: 0, c: 27 }, e: { r: 0, c: 31 } }  // Valoraciones (5 columnas)
      ];

      // Agregar los datos
      this.historial.forEach(evento => {
        XLSX.utils.sheet_add_aoa(ws, [[
          evento.id, evento.Codigo, evento.id_usuario, evento.id_proceso, evento.clasificacion, evento.created_at, evento.updated_at,
          evento.tipo, evento.causa, evento.efecto, evento.probabilidad, evento.impacto, evento.valoracion, evento.control,
          evento.descripcion, evento.acciones, evento.informacion, evento.accion, evento.responsable, evento.proceso, evento.fecha_seguimiento, evento.fecha_cierre, evento.control_actual,
          evento.p1, evento.p2, evento.p3, evento.p4, evento.fecha,
          evento.valoracion_riesgo, evento.valoracion_control, evento.valoracion_total, evento.justificacion
        ]], { origin: -1 });
      });

      XLSX.utils.book_append_sheet(wb, ws, "Historial");
      const excelBuffer = XLSX.write(wb, { bookType: "xlsx", type: "array" });
      const data = new Blob([excelBuffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8" });

      const fechaActual = new Date().toISOString().split('T')[0];

      saveAs(data, `Historial_Eventos_${fechaActual}.xlsx`);
    }
  }
};
</script>


<style scoped>
/* Diseño General */
.historial-container {
  width: 100vw;
  height: 100vh;
  background-color: #f6e2dd;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 5px;
}

/* Botón de volver */
.btn-volver {
  position: absolute;
  top: 20px;
  left: 20px;
  padding: 8px 12px;
  background-color: #fa5235fa;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-volver:hover {
  background-color: #c9302c;
}

/* Botón de Descargar */
.btn-descargar {
  margin: 10px 0;
  padding: 8px 12px;
  background-color: #eb6a50;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-descargar:hover {
  background-color: #fac3c1;
}

/* Tabla */
.historial-box {
  width: 95%;
  max-height: 600px;
  overflow-x: auto;
  background: white;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgb(0, 0, 0);
}

/* Tabla */
table {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
  text-align: left;
}

/* Cabecera con Colspan */
th {
  padding: 10px;
  border: 1px solid #000000;
  text-align: center;
}
td {
  padding: 10px;
  border: 1px solid #000000;
  text-align: center;
}


/* Colores por sección */
.header-dofa {
  background-color: #ffcc80;
}

.header-riesgo {
  background-color: #ffab91;
}

.header-gestion {
  background-color: #81c784;
}

.header-valoraciones {
  background-color: #64b5f6;
}

.header-seguimiento {
  background-color: #f66b64;
}

/* Alternar colores de filas */
tbody tr:nth-child(odd) {
  background-color: #ddd7d7;
}

tbody tr:hover {
  background-color: #e1e1e1;
}

/* Responsive */
@media (max-width: 768px) {
  .historial-box {
    width: 100%;
    padding: 10px;
  }
  table {
    font-size: 12px;
  }
}
</style>
