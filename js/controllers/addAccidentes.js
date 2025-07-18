let selectEmpleado = $("#empleadoAccidente");
let puesto = $("#puestoAccidente");
let area = $("#areaAccidente");
let fecha = $("#fechaAccidente");
let tipo = $("#tipoAccidente");
let incapacidad = $("#incapacidad");
let idEmpleado;
let empleado;
let nombreEmpleados = [];
let motivosFaltas = [];

$(document).ready(function () {
  //cargarDatos de empleado
  cargarEmpleadosAccidente();
  selectEmpleado.change(function () {
    empleado = selectEmpleado.val();
    if (empleado != 0 || empleado != null || empleado != "") {
      //cargar Info de empleado seleccionado
      cargarEmpleadoAccidente(empleado)
        .done(function (informacion) {
          puesto.val(informacion.NombrePuesto);
          area.val(informacion.NombreArea);
          datos = informacion;
        })
        .fail(function (error) {
          console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
        });
    }
  });
  $("#formulario-addFaltas").submit(function (event) {
    event.preventDefault();
    if (selectEmpleado.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe seleccionar un empleado" };
      alerta(infoAlerta);
    }
    let formData = $(this).serialize();
    formData += "&idEmpleado=" + encodeURIComponent(datos.idEmpleado);
    formData += "&creacion=" + encodeURIComponent(fechaActual);
    formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
    if (tipo.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Tipo es requerido" };
      alerta(infoAlerta);
    } else if (fecha.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Fecha es requerido" };
      alerta(infoAlerta);
    } else if (incapacidad.val() == null) {
      infoAlerta = {
        icono: "error",
        mensaje: "El campo Incapacidad es requerido",
      };
      alerta(infoAlerta);
    } else {
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/createAccidente.php",
        data: formData,
        success: function (response) {
            // console.log(response);
            alerta(response, function() {
                window.location.href = "accidentesView.php";
            });
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
      });
    }
  });
});

function cargarEmpleadosAccidente() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
    data: { key: "2" },
    success: function (empleados) {
      empleados.forEach((empleado) => {
        nombreEmpleados.push({ nombre: empleado.Nombre, id: empleado.Nombre });
      });
      crearSelector("#empleadoAccidente", nombreEmpleados);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function cargarEmpleadoAccidente(nombre) {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    data: { nombre: nombre, key: "1" },
    dataType: "json",
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
