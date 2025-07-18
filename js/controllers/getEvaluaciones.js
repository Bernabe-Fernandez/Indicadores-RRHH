$(document).ready(function () {
  getAllEvaluacionesD();
  getAllAutoevaluacionD();
  getAllPromocionesLab();

  //ejecutamos sobre los botenes de la tabla de evaluaciones
  $("#evaluacionesD").on("click", ".boton-edit", function () {
    alertaCargar("Generando PDF");
    const id = $(this).data("id");
    consultarED(id, "visualizar");
  });

  $("#evaluacionesD").on("click", ".boton-baja", function () {
    alertaCargar("Generando PDF");
    const id = $(this).data("id");
    consultarED(id, "descargar");
  });

  //ejecutamos sobre los botones de la tabla de auevaluaciones
  $("#autoevaluacionD").on("click", ".boton-edit", function () {
    alertaCargar("Generando PDF");
    const id = $(this).data("id");
    consultarAED(id, "visualizar");
  });

  $("#autoevaluacionD").on("click", ".boton-baja", function () {
    alertaCargar("Generando PDF");
    const id = $(this).data("id");
    consultarAED(id, "descargar");
  });

  $("#promocionL").on("click", ".boton-edit", function () {
    const id = $(this).data("id");
    // Redirigir a la página de edición con el ID del registro como parámetro
    window.location.href = "promocionesEdit.php?id=" + id;
  });
});

function getAllEvaluacionesD() {
  obtenerDatos("1")
    .done(function (evaluacionesD) {
      if (evaluacionesD.mensaje) {
        console.log(evaluacionesD.mensaje);
        evaluacionesD = [];
      }
      // console.log(evaluacionesD);
      $("#evaluacionesD").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: evaluacionesD, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
          { data: "fechaAp", className: "text-center" },
          { data: "jefeD", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                      <button class="boton boton-edit" data-id="${row.idEvaluacionD}">Ver</button>
                      <button class="boton boton-baja" data-id="${row.idEvaluacionD}">Descargar</button>
                    `;
            },
          },
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
}

function getAllAutoevaluacionD() {
  obtenerDatos("2")
    .done(function (autoEvaluacionD) {
      if (autoEvaluacionD.mensaje) {
        console.log(autoEvaluacionD.mensaje);
        autoEvaluacionD = [];
      }
      // console.log(evaluacionesD);
      $("#autoevaluacionD").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: autoEvaluacionD, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
          { data: "fechaAp", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                          <button class="boton boton-edit" data-id="${row.idAutoEva}">Ver</button>
                          <button class="boton boton-baja" data-id="${row.idAutoEva}">Descargar</button>
                        `;
            },
          },
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
}

function getAllPromocionesLab() {
  consultarPromocionesL()
    .done(function (promocionesL) {
      if (promocionesL.mensaje) {
        console.log(promocionesL.mensaje);
        promocionesL = [];
      }
      // console.log(evaluacionesD);
      $("#promocionL").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: promocionesL, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "areaAnt", className: "text-center" },
          { data: "puestoAnt", className: "text-center" },
          { data: "areaActual", className: "text-center" },
          { data: "puestoActual", className: "text-center" },
          { data: "comentario", className: "text-center" },
          { data: "fechaProm", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                        <button class="boton boton-edit" data-id="${row.idPromocion}">Editar</button>
                      `;
            },
          },
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
}

//funcion que consulta una evaluacion de desempeño y puede descargar o ver la informacion, dependiendo la accion solicitada
function consultarED(idEvaluacion, accion) {
  // console.log(idEvaluacion);
  $.ajax({
    url: "includes/models/getEvaluaciones.php",
    type: "GET",
    dataType: "json",
    data: { key: 3, idEvaluacion: idEvaluacion },
    success: function (evaluacionD) {
      // console.log(evaluacionD);
      crearED(evaluacionD, accion);
    },
    error: function (xhr, status, error) {
      console.error("Error al generar el PDF:", error);
      alert("Ocurrió un error al generar el PDF.");
    },
  });
}

function crearED(evaluacionD, accion) {
  nombreArchivo = `evaluacionD-${evaluacionD["Nombre"]}-${evaluacionD["fechaAp"]}`;
  // console.log(nombreArchivo);
  //mandar la informacion para generar el reporte
  $.ajax({
    url: "includes/reportes/encuestaDesem.php",
    type: "GET",
    contentType: "application/json",
    data: { informacion: JSON.stringify(evaluacionD) },
    xhrFields: {
      responseType: "blob", // Para recibir una respuesta tipo Blob (archivo binario)
    },
    success: function (blob) {
      Swal.close();
      // Crear una URL del blob para el PDF generado
      let url = window.URL || window.webkitURL;
      let link = url.createObjectURL(blob);
      if (accion === "descargar") {
        // Crear un enlace de descarga
        let a = document.createElement("a");
        a.href = link;
        a.download = nombreArchivo; // Nombre de archivo para descargar
        document.body.appendChild(a);
        a.click(); // Simular clic en el enlace para iniciar la descarga
        document.body.removeChild(a); // Limpiar el elemento después de la descarga
      } else if (accion === "visualizar") {
        // Abrir el PDF en una nueva pestaña del navegador
        window.open(link, "_blank");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al generar el PDF:", error);
      alert("Ocurrió un error al generar el PDF.");
    },
  });

}

//funcion para consultar la información de la autoevaluación
function consultarAED(idAutoEvaluacion, accion) {
  $.ajax({
    url: "includes/models/getEvaluaciones.php",
    type: "GET",
    dataType: "json",
    data: { key: 4, idAutoEva: idAutoEvaluacion },
    success: function (evaluacionD) {
      // console.log(evaluacionD);
      crearAED(evaluacionD, accion);
    },
    error: function (xhr, status, error) {
      console.error("Error al consultar los datos:", xhr);
    },
  });
}

function crearAED(evaluacionD, accion) {
  nombreArchivo = `AutoEvaluacion-${evaluacionD["Nombre"]}-${evaluacionD["fechaAp"]}`;
  // console.log(evaluacionD);
  //mandar la informacion para generar el reporte
  $.ajax({
    url: "includes/reportes/auevaluacionDesem.php",
    type: "GET",
    contentType: "application/json",
    data: { informacion: JSON.stringify(evaluacionD) },
    xhrFields: {
      responseType: "blob", // Para recibir una respuesta tipo Blob (archivo binario)
    },
    success: function (blob) {
      // console.log(blob)
      Swal.close();
      // Crear una URL del blob para el PDF generado
      let url = window.URL || window.webkitURL;
      let link = url.createObjectURL(blob);
      if (accion === "descargar") {
        // Crear un enlace de descarga
        let a = document.createElement("a");
        a.href = link;
        a.download = nombreArchivo; // Nombre de archivo para descargar
        document.body.appendChild(a);
        a.click(); // Simular clic en el enlace para iniciar la descarga
        document.body.removeChild(a); // Limpiar el elemento después de la descarga
      } else if (accion === "visualizar") {
        // Abrir el PDF en una nueva pestaña del navegador
        window.open(link, "_blank");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al generar el PDF:", error);
      alert("Ocurrió un error al generar el PDF.");
    },
  });
}

function consultarPromocionesL() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getPromociones.php",
    type: "GET",
    dataType: "json",
    data: {key: "1"}
  });
}

function obtenerDatos(key) {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getEvaluaciones.php",
    type: "GET",
    dataType: "json",
    data: { key: key },
  });
}

//funcion de alerta de carga
function alertaCargar(mensaje) {
  Swal.fire({
    title: mensaje,
    text: "Por favor espera...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });
}
