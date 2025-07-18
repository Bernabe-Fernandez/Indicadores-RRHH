let selectArea = $("#areaEmpleado");
let selectPuesto = $("#puestoEmpleado");
let nombre = $("#nombreEmpleado");
let ingreso = $("#fechaIngreso");
let id;
$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  id = parametros.get("id");
  cargarDatos(id);
  selectArea.change(function () {
    area = selectArea.val();
    if (area != 0 || area != null || area != "") {
      selectPuesto.removeAttr("disabled");
      cargarPuestos(area);
    }
  });
  $("#formulario-editEmpleados").submit(function (event) {
    event.preventDefault();

    let validarForm = validarDatos();
    if (validarForm) {
      let formData = $(this).serialize();
      formData += "&idEmpleado=" + encodeURIComponent(id);
      formData += "&modificacion=" + encodeURIComponent(fechaActual);
      formData += "&usuarioModifi=" + encodeURIComponent(nombreUsuario);
      formData += "&key=" + encodeURIComponent("1");
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/editEmpleado.php",
        data: formData,
        success: function (response) {
          // console.log(response);
          alerta(response, function () {
            window.location.href = "empleadosview.php";
          });
        },
        error: function (xhr, status, error) {
          alerta(error);
        },
      });
    }
  });
});

function cargarDatos(id) {
  $.ajax({
    type: "GET",
    url: "includes/models/getEmpleados.php",
    dataType: "json",
    data: { id: id, key: "3" },
    success: function (response) {
      // console.log(response);
      asignarDatos(response);
    },
    error: function (xhr, status, error) {
      alerta({ icono: "error", mensaje: error });
    },
  });
}

function asignarDatos(datos) {
  // console.log(datos);
  let area;
  nombre.val(datos.Nombre);
  ingreso.val(datos.Ingreso);
  $("#curpEmpleado").val(datos.CURP);
  $("#rfcEmpleado").val(datos.RFC);
  $("#nssEmpleado").val(datos.NSS);
  $("#domicilioEmpleado").val(datos.domicilio);
  $("#contactoEmpleado").val(datos.contacto);
  $("#celularEmpleado").val(datos.celular);
  $("#observaciones").val(datos.Observacion);

  // Cargar áreas antes de asignar el valor del área seleccionada
  cargarAreas().then(() => {
    selectArea.val(datos.idArea);
    area = selectArea.val();
    if (area != 0 && area != null && area != "") {
      selectPuesto.removeAttr("disabled");
      cargarPuestos(area).then(() => {
        selectPuesto.val(datos.idPuesto);
      });
    }
  });
}

function cargarAreas() {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "includes/models/getFiltroAreas.php",
      type: "GET",
      dataType: "json",
      success: function (areas) {
        crearSelectorEmpleado("#areaEmpleado", areas, true);
        resolve();
      },
      error: function (xhr, status, error) {
        reject(error);
      },
    });
  });
}

function cargarPuestos(area) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "includes/models/getPuestos.php",
      type: "GET",
      dataType: "json",
      data: { area: area, key: "1" },
      success: function (puestos) {
        crearSelectorEmpleado("#puestoEmpleado", puestos);
        resolve();
      },
      error: function (xhr, status, error) {
        reject(error);
      },
    });
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
      disabled: true,
      selected: true,
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

function validarDatos() {
  if ($("#nombreEmpleado").val() === "") {
    alerta({ icono: "error", mensaje: "El campo Nombre es requerido" });
    return false;
  } else if ($("#curpEmpleado").val() === "") {
    alerta({ icono: "error", mensaje: "La CURP es obligatorio" });
    return false;
  } else if ($("#curpEmpleado").val().length != 18) {
    alerta({
      icono: "error",
      mensaje: "La CURP debe contener unicamente 18 caracteres",
    });
    return false;
  } else if ($("#rfcEmpleado").val() === "") {
    alerta({ icono: "error", mensaje: "El RFC es obligatorio" });
    return false;
  } else if ($("#rfcEmpleado").val().length != 13) {
    alerta({
      icono: "error",
      mensaje: "El RFC debe contener unicamente 13 caracteres",
    });
    return false;
  } else if ($("#nssEmpleado").val() === "") {
    alerta({ icono: "error", mensaje: "El NSS es obligatorio" });
    return false;
  } else if ($("#nssEmpleado").val().length != 11) {
    alerta({
      icono: "error",
      mensaje: "El NSS debe contener unicamente 11 caracteres",
    });
    return false;
  } else if ($("#domicilioEmpleado").val() === "") {
    alerta({ icono: "error", mensaje: "El Domicilio es obligatorio" });
    return false;
  } else if ($("#contactoEmpleado").val() === "") {
    alerta({
      icono: "error",
      mensaje: "El Contacto de emergencia es obligatorio",
    });
    return false;
  } else if ($("#celularEmpleado").val() === "") {
    alerta({ icono: "error", mensaje: "El numero de celular es obligatorio" });
    return false;
  } else if ($("#areaEmpleado").val() === null) {
    alerta({ icono: "error", mensaje: "El campo Area es requerido" });
    return false;
  } else if ($("#puestoEmpleado").val() === null) {
    alerta({ icono: "error", mensaje: "El campo Puesto es requerido" });
    return false;
  } 
  else if($("#observaciones").val() === ""){
    alerta({ icono: "error", mensaje: "El campo Comentario es requerido" });
    return false;
  }else if ($("#fechaIngreso").val() === "") {
    alerta({ icono: "error", mensaje: "El campo Ingreso es requerido" });
    return false;
  } else {
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
