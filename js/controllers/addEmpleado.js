let puestosEmpleado = [];
let areasEmpleado = [];
$(document).ready(function () {
  let selectArea = $("#areaEmpleado");
  let selectPuesto = $("#puestoEmpleado");
  let nombre = $("#nombreEmpleado");
  let ingreso = $("#fechaIngreso");
  cargarAreas();

  selectArea.change(function () {
    area = selectArea.val();
    if (area != 0 || area != null || area != "") {
      selectPuesto.removeAttr("disabled");
      // console.log(selectPuesto);
      cargarPuestos(area);
    }
  });

  $("#formulario-addEmpleados").submit(function (event) {
    event.preventDefault();
    let validarForm = validarDatos();
    if (validarForm) {
      //ejecutar codigo de insercion
      let formData = $(this).serialize();
      formData += "&creacion=" + encodeURIComponent(fechaActual);
      formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/createEmpleado.php",
        data: formData,
        success: function (response) {
          // console.log(response);
            alerta(response, function() {
                window.location.href = "empleadosView.php";
            });
        },
        error: function (xhr, status, error) {
            alerta(error);
        },
      });
    }
  });
});

function cargarAreas() {
  areasEmpleado = [];
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      //crear el select
      areas.forEach(area => {
        areasEmpleado.push({nombre: area.NombreArea , id: area.idArea});
      });
      crearSelectorEmpleado("#areaEmpleado", areas, true);
    },
  });
}

function cargarPuestos(area) {
  $.ajax({
    url: "includes/models/getPuestos.php",
    type: "GET",
    dataType: "json",
    data: { area: area, key: "1"},
    success: function (puestos) {
      //crear el select
      puestos.forEach(puesto => {
        puestosEmpleado.push({nombre: puesto.NombrePuesto , id: puesto.idPuesto});
      });
      crearSelectorEmpleado("#puestoEmpleado", puestos);
    },
  });
}

function crearSelectorEmpleado(nombre, datos, opcion = false) {
  // Obtener el elemento select
  let select = $(nombre);
  select.empty();
  select.append(
    $("<option>", {
      value: 0,
      text: "Seleccione una opción",
      selected: true,
      disabled: true
    })
  );
  if (opcion) {
    // Llenar el select con las opciones
    datos.forEach(function (dato) {
      select.append(
        $("<option>", {
          value: dato.idArea,
          text: dato.NombreArea,
        })
      );
    });
  } else {
    // Llenar el select con las opciones
    datos.forEach(function (dato) {
      select.append(
        $("<option>", {
          value: dato.idPuesto,
          text: dato.NombrePuesto,
        })
      );
    });
  }
}

function validarDatos(){
    if ($("#nombreEmpleado").val() === "") {
      alerta({icono: 'error',mensaje: 'El campo Nombre es requerido'});
      return false;
    }else if($("#curpEmpleado").val() === ""){
      alerta({icono: 'error',mensaje: 'La CURP es obligatorio'});
      return false;
    }else if($("#curpEmpleado").val().length != 18 ){
      alerta({icono: 'error',mensaje: 'La CURP debe contener unicamente 18 caracteres'});
      return false;
    }else if($("#rfcEmpleado").val() === ""){
      alerta({icono: 'error',mensaje: 'El RFC es obligatorio'});
      return false;
    }else if($("#rfcEmpleado").val().length != 13){
      alerta({icono: 'error',mensaje: 'El RFC debe contener unicamente 13 caracteres'});
      return false;
    }else if($("#nssEmpleado").val() === ""){
      alerta({icono: 'error',mensaje: 'El NSS es obligatorio'});
      return false;
    }else if($("#nssEmpleado").val().length != 11){
      alerta({icono: 'error',mensaje: 'El NSS debe contener unicamente 11 caracteres'});
      return false;
    }else if($("#domicilioEmpleado").val() === ""){
      alerta({icono: 'error',mensaje: 'El Domicilio es obligatorio'});
      return false;
    }else if($("#contactoEmpleado").val() === ""){
      alerta({icono: 'error',mensaje: 'El Contacto de emergencia es obligatorio'});
      return false;
    }else if($("#celularEmpleado").val() === ""){
      alerta({icono: 'error',mensaje: 'El numero de celular es obligatorio'});
      return false;
    }else if ($("#areaEmpleado").val() === null) {
      alerta({icono: 'error',mensaje: 'El campo Area es requerido'});
      return false;
    } else if ($("#puestoEmpleado").val() === null) {
      alerta({icono: 'error',mensaje: 'El campo Puesto es requerido'});
      return false;
    }else if($("#observaciones").val() === ""){
      alerta({icono: 'error',mensaje: 'El campo Comentario es requerido'});
      return false;
    }else if ($("#fechaIngreso").val() === "") {
      alerta({icono: 'error',mensaje: 'El campo Ingreso es requerido'});
      return false;
    }else{
      return true;
    }
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
