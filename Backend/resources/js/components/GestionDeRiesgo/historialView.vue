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
        const response = await fetch("http://127.0.0.1:8000/api/buscar");
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

      // Definir los encabezados con colores
      const encabezados = [
        ["DOFA", "", "", "", "", "Clasificación", "", "", "", "", "", "Controles", "", "", "Acciones", "", "", "", "", "", "", "Seguimiento", "", "", "", "", "", "", "", "", "", "", ""],
        [
          "Id", "Código DOFA", "Usuario", "Proceso", "Fecha Creación",
          "Tipo", "Causa", "Efecto", "Probabilidad", "Impacto", "Valoración",
          "Descripción", "Probabilidad Control", "Impacto Control",
          "Información", "Acción", "Responsable", "Acciones", "Proceso", "Fecha Seguimiento", "Fecha Cierre",
          "Control Actual", "Pregunta 1", "Pregunta 2", "Pregunta 3", "Pregunta 4", "Probabilidad Final",
          "Fecha", "Impacto Final", "Valoración Riesgo", "Valoración Control", "Valoración Total", "Justificación"
        ]
      ];

      // Convertir encabezados a hoja de cálculo
      const ws = XLSX.utils.aoa_to_sheet(encabezados);

      // Agregar los datos asegurando que los nombres coincidan con la API
      const datos = this.historial.map(evento => ([
        evento.dofa_id, evento.dofa_codigo, evento.dofa_usuario, evento.dofa_proceso, evento.dofa_created_at,
        evento.clasificacion_tipo, evento.clasificacion_causa, evento.clasificacion_efecto, evento.clasificacion_probabilidad, evento.clasificacion_impacto, evento.clasificacion_valoracion,
        evento.control_descripcion, evento.control_probabilidad, evento.control_impacto,
        evento.accion_informacion, evento.accion_detalle, evento.accion_responsable, evento.accion_acciones, evento.accion_proceso, evento.accion_fecha_seguimiento, evento.accion_fecha_cierre,
        evento.seguimiento_control_actual, evento.seguimiento_p1, evento.seguimiento_p2, evento.seguimiento_p3, evento.seguimiento_p4, evento.seguimiento_probabilidad,
        evento.seguimiento_fecha, evento.seguimiento_impacto, evento.seguimiento_valoracion_riesgo, evento.seguimiento_valoracion_control, evento.seguimiento_valoracion_total, evento.seguimiento_justificacion
      ]));

      // Agregar los datos debajo de los encabezados
      XLSX.utils.sheet_add_aoa(ws, datos, { origin: -1 });

      // Aplicar estilos de color a los encabezados (solo funciona en Excel con formato XLSX)
      const range = XLSX.utils.decode_range(ws["!ref"]);
      for (let C = range.s.c; C <= range.e.c; C++) {
        const cell = ws[XLSX.utils.encode_cell({ r: 1, c: C })]; // Fila 1 (Encabezados)
        if (cell) {
          cell.s = {
            fill: { fgColor: { rgb: "FFFF00" } }, // Amarillo
            font: { bold: true }
          };
        }
      }

      // Agregar la hoja al libro
      XLSX.utils.book_append_sheet(wb, ws, "Historial");

      // Convertir a Blob y descargar
      const excelBuffer = XLSX.write(wb, { bookType: "xlsx", type: "array" });
      const data = new Blob([excelBuffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8" });

      // Generar nombre con la fecha actual
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
