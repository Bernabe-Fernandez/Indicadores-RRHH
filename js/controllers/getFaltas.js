$(document).ready(function () {
  obtenerDatos()
    .done(function (faltas) {
      if (faltas.mensaje) {
        console.log(faltas.mensaje);
        faltas = [];
      }
      // console.log(faltas);
      $("#tablaAusentismo").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: faltas, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
          { data: "Fecha", className: "text-center" },
          { data: "NombreMotivo", className: "text-center" },
          { data: "Observaciones", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                      <button class="boton btn-ver boton-edit" data-id="${row.idAusentismo}">Ver</button>
                    `;
            },
          },
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });

  $("#tablaAusentismo").on("click", ".btn-ver", function () {
    alertaCarga("Cargando Archivo");
    let buttonId = $(this).attr("data-id");
    obtenerComprobante(buttonId);
  });
});

//función para consultar el pdf que vamos a mostrar en ausencias
function obtenerComprobante(idAusencia) {
  $.ajax({
    url: "includes/models/getAllFaltas.php",
    type: "GET",
    dataType: "json",
    data: { pagina: "comprobante", ausentismo: idAusencia },
    success: function (response) {
      // console.log(response);
      visualizarPdf(response);
    },
    error: function (xhr, status, error) {
      console.log("Error al obtener el nombre del PDF:", xhr);
    },
  });
}

function visualizarPdf(data) {
  let namePdf = data.Comprobante;

  //petion ajax para poder evaluar si el pdf existe y se puede abrir
  $.ajax({
    url: "includes/models/archivos/verificarPdf.php",
    type: "GET",
    dataType: "json",
    data: { archivo: namePdf },
    success: function (response) {
      // Cerrar la alerta de carga después de 2 segundos
      setTimeout(() => {
        Swal.close();
        if (response.existe) {
          // Abrir el PDF en una nueva ventana/pestaña
          window.open(response.ruta, "_blank");
        } else {
          // Mostrar alerta si el archivo no se encuentra
          alertaEstatica(response);
        }
      }, 500); 
    },
    error: function (xhr, status, error) {
      setTimeout(() => {
        Swal.close();
        alertaEstatica(xhr.responseJSON);
      }, 500); 
    },
  });
}

function obtenerDatos() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getAllFaltas.php",
    type: "GET",
    dataType: "json",
    data: { pagina: "faltas" },
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

function alertaCarga(mensaje) {
  Swal.fire({
    title: mensaje,
    text: "Por favor espera...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });
}
