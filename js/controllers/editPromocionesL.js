$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  idCapacitacion = parametros.get("id");
  cargarPromociones(idCapacitacion);
  $("#formulario-editPromocionesL").submit(function (event) {
    event.preventDefault();
    if ($("#comentario").val() === "") {
      datos = {icono: 'error',mensaje: 'El campo Comentario es requerido'};
      alerta(datos);
    }else if($("#fechaM").val() == ""){
        datos = {icono: 'error',mensaje: 'El campo Fecha es requerido'};
      alerta(datos);
    }
    else {     
        let formData = $(this).serialize();
        formData += '&idPromocion=' + encodeURIComponent(idCapacitacion);
        formData += "&usuarioModifi=" + encodeURIComponent(nombreUsuario);
      //ejecutar codigo de insercion
    //   console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/editPromocionL.php",
        data: formData,
        success: function (response) {
        //   console.log(response);
            alerta(response, function() {
                window.location.href = "desarrolloView.php";
            });
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseText);
        },
      });
    }
  });
});

function cargarPromociones(id) {
  $.ajax({
    type: "GET",
    url: "includes/models/getPromociones.php",
    dataType: "json",
    data: { key: "2", idPromocion: id},
    success: function (response) {
        console.log(response);
        $("#nombreEmpleado").val(response.Nombre);
        $("#areaAnterior").val(response.areaAnt);
        $("#puestoAnterior").val(response.puestoAnt);
        $("#areaActual").val(response.areaActual);
        $("#puestoActual").val(response.puestoActual);
        $("#comentario").val(response.comentario);
        $("#fechaM").val(response.fechaProm)
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
