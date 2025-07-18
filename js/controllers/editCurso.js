let fechaCurso = $("#fechaCurso");
let nombreCurso = $("#Nombrecurso");
let id;
$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  id = parametros.get("id");
  cargarDatos(id);
  $("#formulario-editCurso").submit(function (event) {
    event.preventDefault();
    let formData = $(this).serialize();
    formData += '&idCurso=' + encodeURIComponent(id);
    formData += "&modificacion=" + encodeURIComponent(fechaActual);
    formData += "&usuarioModifi=" + encodeURIComponent(nombreUsuario);
    if(nombreCurso.val() === ""){
      datos = {icono: 'error',mensaje: 'El campo Nombre es requerido'};
      alerta(datos);
    }else if (fechaCurso.val() === "") {
      datos = {icono: 'error',mensaje: 'El campo Fecha es requerido'};
      alerta(datos);
    }
    else {     
      //ejecutar codigo de insercion
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/editCurso.php",
        data: formData,
        success: function (response) {
          // console.log(response);
            alerta(response, function() {
                window.location.href = "cursoView.php";
            });
        },
        error: function (xhr, status, error) {
            alerta({icono: 'error', mensaje: 'error al cargar los datos'});
            console.log(xhr);
        },
      });
    }
  });
});

function cargarDatos(id) {
  $.ajax({
    type: "GET",
    url: "includes/models/getCursos.php",
    dataType: "json",
    data: { idCurso: id, key: "1" },
    success: function (response) {
    //   console.log(response);
    nombreCurso.val(response.Nombre);
    fechaCurso.val(response.Fecha);
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
