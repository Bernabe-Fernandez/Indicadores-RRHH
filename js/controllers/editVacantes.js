let nombreArea = $("#nombreArea");
let numVacantes = $("#numVacantes");
let idVacantes;

$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  idArea = parametros.get("id");
  obtenerVacantes(idArea)
    .done(function (vacantes) {
      // console.log(vacantes);
      nombreArea.val(vacantes.area);
      numVacantes.val(vacantes.Vacantes);
      idVacantes = vacantes.idVacante;
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });

  $("#formulario-editVacantes").submit(function (event) {
    event.preventDefault();
    if (numVacantes.val() < 0) {
      infoAlerta = {
        icono: "error",
        mensaje: "Las vacantes no pueden ser menor a 0",
      };
      alerta(infoAlerta);
    } else {
      let formData = $(this).serialize();
      formData += "&idVacante=" + encodeURIComponent(idVacantes);
      formData += "&usuario=" + encodeURIComponent(nombreUsuario);
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/updateVacantes.php",
        data: formData,
        success: function (response) {
          // console.log(response);
          alerta(response, function () {
            window.location.href = "vacantesView.php";
          });
        },
        error: function (xhr, status, error) {
          alerta(error);
        },
      });
    }
  });
});

function obtenerVacantes(idArea) {
  return $.ajax({
    type: "GET",
    url: "includes/models/getVacantesAutorizadas.php",
    dataType: "json",
    data: { area: idArea },
    // success: function (response) {
    //   console.log(response);
    //   // asignarDatos(response);
    // },
    // error: function (xhr, status, error) {
    //   console.log({ icono: "error", mensaje: xhr });
    // },
  });
}

function alerta(datos, callback) {
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
