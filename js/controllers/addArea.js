let nombreArea = $("#nombreArea");
let vacantesArea = $("#vacantesArea");

$(document).ready(function () {
  $("#formulario-addArea").submit(function (event) {
    event.preventDefault();
    if (nombreArea.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Nombre es requerido" };
      alerta(infoAlerta);
    }else if(vacantesArea.val() === "" || vacantesArea.val() <= 0){
        infoAlerta = { icono: "error", mensaje: "El numero de vacantes es requerido y no debe ser menor a 1" };
        alerta(infoAlerta);
    }else {
      let formData = $(this).serialize();
      formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
        // console.log(formData);
      $.ajax({
          type: "POST",
          url: "includes/models/createArea.php",
          data: formData,
          success: function (response) {
            // console.log(response);
              alerta(response, function() {
                  window.location.href = "areasView.php";
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
