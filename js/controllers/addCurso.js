let nombreCurso = $("#Nombrecurso");
let fechaCurso = $("#fechaCurso");

$(document).ready(function () {
  $("#formulario-addCurso").submit(function (event) {
    event.preventDefault();
    if (nombreCurso.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Nombre es requerido" };
      alerta(infoAlerta);
    } else if (fechaCurso.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Fecha es requerido" };
      alerta(infoAlerta);
    } else {
      let formData = $(this).serialize();
      formData += "&creacion=" + encodeURIComponent(fechaActual);
      formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
      //   console.log(formData);
      $.ajax({
          type: "POST",
          url: "includes/models/createCurso.php",
          data: formData,
          success: function (response) {
            console.log(response);
              alerta(response, function() {
                  window.location.href = "capacitacionView.php";
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
