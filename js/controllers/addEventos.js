let nombreEvento = $("#nombreEvento");
let fechaEvento = $("#fechaEvento");

$(document).ready(function () {
  $("#formulario-addEventos").submit(function (event) {
    event.preventDefault();
    if (nombreEvento.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El Nombre del Evento es requerido" };
      alerta(infoAlerta);
    } else if (fechaEvento.val() === "") {
      infoAlerta = { icono: "error", mensaje: "La Fecha del Evento es requerido" };
      alerta(infoAlerta);
    } else {
      let formData = $(this).serialize();
      formData += "&creacion=" + encodeURIComponent(fechaActual);
      formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
    //   console.log(formData);
      $.ajax({
          type: "POST",
          url: "includes/models/createEvento.php",
          data: formData,
          success: function (response) {
            // console.log(response);
              alerta(response, function() {
                  window.location.href = "eventosView.php";
              });
          },
          error: function (xhr, status, error) {
              alerta(error);
          },
        });
    }
  });
});

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
