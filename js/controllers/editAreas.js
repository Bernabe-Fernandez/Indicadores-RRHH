let nombreArea = $("#nombreArea");
let estatusArea = $("#estatusArea");
let idArea;
$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  idArea = parametros.get("id");
  cargarDatos(idArea);
  $("#formulario-editAreas").submit(function (event) {
    event.preventDefault();
    let formData = $(this).serialize();
    formData += "&idArea=" + encodeURIComponent(idArea);
    formData += "&usuarioModifi=" + encodeURIComponent(nombreUsuario);
    if (estatusArea.val() === null) {
      datos = { icono: "error", mensaje: "El campo Estatus es requerido" };
      alerta(datos);
    } else {
      //ejecutar codigo de insercion
    //   console.log(formData);
        $.ajax({
          type: "POST",
          url: "includes/models/editArea.php",
          data: formData,
          success: function (response) {
            // console.log(response);
              alerta(response, function() {
                  window.location.href = "areasView.php";
              });
          },
          error: function (xhr, status, error) {
              console.log(xhr.responseText);
          },
        });
    }
  });
});

function cargarDatos(id) {
  $.ajax({
    type: "GET",
    url: "includes/models/getAreas.php",
    dataType: "json",
    data: { idArea: id, key: "1" },
    success: function (response) {
    //   console.log(response);
      nombreArea.val(response.NombreArea);
      estatusArea.val(response.estatus);
    },
    error: function (xhr, status, error) {
      alerta({ icono: "error", mensaje: error });
    },
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
