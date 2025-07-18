$(document).ready(function () {
  obtenerDatosBajas()
    .done(function (empleadosBajas) {
      if (empleadosBajas.mensaje) {
        console.log(empleadosBajas.mensaje);
        empleadosBajas = [];
      }
      $("#empleados-baja").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        searching: false,
        lengthChange: false,
        order: [],
        data: empleadosBajas, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "Egreso", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
          { data: "MotivoBaja", className: "text-center" },
          { data: "Observacion", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                            <button class="boton boton-edit" data-id="${row.idEmpleado}">Ver</button>
                          `;
            },
          },
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
  obtenerDatosAltas()
    .done(function (empleadosAltas) {
      if (empleadosAltas.mensaje) {
        console.log(empleadosAltas.mensaje);
        empleadosAltas = [];
      }
      $("#empleados-alta").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        searching: false,
        lengthChange: false,
        order: [],
        data: empleadosAltas, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "Ingreso", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
  $("#empleados-baja").on("click", ".boton-edit", function () {
    alertaCargar("Generando PDF");
    const idEmpleado = $(this).data("id");
    // Redirigir a la página de edición con el ID del registro como parámetro
    // console.log(id);
    consultarESalida(idEmpleado, "");
  });
});

function obtenerDatosAltas() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getRotacion.php",
    type: "GET",
    dataType: "json",
  });
}

function obtenerDatosBajas() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getRotacion.php",
    type: "GET",
    dataType: "json",
    data: { opcion: "baja" },
  });
}

//funcion para consultar la información de la encuesta salida
function consultarESalida(idEmpleado, accion) {
  $.ajax({
    url: "includes/models/getEsalida.php",
    type: "GET",
    dataType: "json",
    data: { key: "1", idEmpleado: idEmpleado },
    success: function (encuestaS) {
      // console.log(encuestaS);
      if (encuestaS.mensaje) {
        setTimeout(() => {
          Swal.close();
          alertaEstatica(encuestaS);
        }, 500);
      } else {
        crearESalida(encuestaS, accion);
      }
    },
    error: function (xhr, status, error) {
      console.error("Error al consultar los datos:", xhr);
    },
  });
}

function crearESalida(encuestaS, accion) {
  $.ajax({
    url: "includes/reportes/cuestionarioSalida.php",
    type: "GET",
    contentType: "application/json",
    data: { informacion: JSON.stringify(encuestaS) },
    xhrFields: {
      responseType: "blob", // Para recibir una respuesta tipo Blob (archivo binario)
    },
    success: function (blob) {
      // console.log(blob)
      Swal.close();
      // Crear una URL del blob para el PDF generado
      let url = window.URL || window.webkitURL;
      let link = url.createObjectURL(blob);
      // Abrir el PDF en una nueva pestaña del navegador
      window.open(link, "_blank");
    },
    error: function (xhr, status, error) {
      console.error("Error al generar el PDF:", error);
      alert("Ocurrió un error al generar el PDF.");
    },
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

//alerta estatita
function alertaEstatica(datos, callback) {
  return Swal.fire({
    title: datos.mensaje,
    icon: datos.icono,
  }).then((result) => {
    // Ejecutar la función de callback si se proporciona y el resultado es 'Ok'
    if (callback && result.isConfirmed) {
      callback();
    }
  });
}
