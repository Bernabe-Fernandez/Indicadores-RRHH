let nombrePuesto = $("#nombrePuesto");
let areaPuesto = $("#selectPuestoArea");
let estatusPuesto = $("#selectPuestoEstatus");
let idPuesto;
$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  idPuesto = parametros.get("id");
  cargarSelector();
  cargarDatos(idPuesto);
  $("#formulario-editPuesto").submit(function (event) {
    event.preventDefault();
    if (nombrePuesto.val() === "") {
      datos = { icono: "error", mensaje: "El campo Nombre es requerido" };
      alerta(datos);
    } else {
      let formData = $(this).serialize();
      formData += "&idPuesto=" + encodeURIComponent(idPuesto);
      formData += "&usuarioModifi=" + encodeURIComponent(nombreUsuario);
        //ejecutar codigo de insercion
        // console.log(formData);
        $.ajax({
          type: "POST",
          url: "includes/models/updatePuestos.php",
          data: formData,
          success: function (response) {
            // console.log(response);
              alerta(response, function() {
                  window.location.href = "puestosView.php";
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
    url: "includes/models/getPuestos.php",
    dataType: "json",
    data: { idPuesto: id, key: "3" },
    success: function (response) {
    //   console.log(response);
      nombrePuesto.val(response.puesto);
      areaPuesto.val(response.Area);
      estatusPuesto.val(response.estatus);
    },
    error: function (xhr, status, error) {
      console.log({ icono: "error", mensaje: error });
    },
  });
}

function cargarSelector() {
  let areasVacantes = [];
  $.ajax({
    type: "GET",
    url: "includes/models/getFiltroAreas.php",
    dataType: "json",
    success: function (response) {
    //   console.log(response);
      //crear el select
      response.forEach((area) => {
        areasVacantes.push({ nombre: area.NombreArea, id: area.idArea });
      });
      crearSelector("#selectPuestoArea", areasVacantes);
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
