let nombrePuesto = $("#nombrePuesto");
let puestoArea = $("#PuestoAreas");

$(document).ready(function () {
  cargarAreas();
  $("#formulario-createPuesto").submit(function (event) {
    event.preventDefault();
    if (nombrePuesto.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Nombre del Puesto es requerido" };
      alerta(infoAlerta);
    }
    else if(puestoArea.val() === null){
      // console.log(puestoArea.val());
      infoAlerta = { icono: "error", mensaje: "Debe seleccionar un Área es requerido" };
      alerta(infoAlerta);
    }else {
      let formData = $(this).serialize();
      formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
      // console.log(formData);
      $.ajax({
          type: "POST",
          url: "includes/models/createPuestos.php",
          data: formData,
          success: function (response) {
            // console.log(response);
              alerta(response, function() {
                  window.location.href = "puestosView.php";
              });
          },
          error: function (xhr, status, error) {
             console.log(xhr);
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

function cargarAreas(){
  areasPuesto = [];
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      //crear el select
      areas.forEach(area => {
        areasPuesto.push({nombre: area.NombreArea , id: area.idArea});
      });
      // console.log(areasPuesto);
      crearSelector("#PuestoAreas", areasPuesto, true);
    },
  });
}
