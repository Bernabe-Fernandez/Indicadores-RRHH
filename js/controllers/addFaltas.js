let selectEmpleado = $("#empleado");
let puesto = $("#puestoEmpleado");
let area = $("#areaEmpleado");
let fecha = $("#fechaFalta");
let selectMotivo = $("#motivo");
let observacion = $("#observaciones");
let idEmpleado;
let empleado;
let nombreEmpleados = [];
let motivosFaltas = [];

$(document).ready(function () {
  //cargarDatos de empleado
  cargarEmpleados();
  cargarMotivos();
  selectEmpleado.change(function () {
    empleado = selectEmpleado.val();
    if (empleado != 0 || empleado != null || empleado != "") {
      //cargar Info de empleado seleccionado
      cargarEmpleado(empleado)
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
    // Crear FormData y añadir datos
    // let formData = new FormData(this);
    // formData.append('creacion', fechaActual);
    // formData.append('Usuario', nombreUsuario);
    // formData.append('idEmpleado', datos.idEmpleado);
    let formData = new FormData($("#formulario-addFaltas")[0]);
    formData.append("creacion", fechaActual);
    formData.append("Usuario", nombreUsuario);
    formData.append("idEmpleado", datos.idEmpleado);
    if (fecha.val() === "") {
      infoAlerta = { icono: "error", mensaje: "El campo Fecha es requerido" };
      alerta(infoAlerta);
    } else if (selectMotivo.val() === null) {
      infoAlerta = { icono: "error", mensaje: "El campo Motivo es requerido" };
      alerta(infoAlerta);
    } else if (observacion.val() === "") {
      infoAlerta = {
        icono: "error",
        mensaje: "El campo Observaciones es requerido",
      };
      alerta(infoAlerta);
    } else {
      // console.log(formData);
      // Enviar el formulario con AJAX
      $.ajax({
        type: "POST",
        url: "includes/models/createFaltas.php",
        data: formData,
        contentType: false, // Necesario para enviar archivos
        processData: false, // Necesario para enviar archivos
        success: function (response) {
          // console.log(response);
          alerta(response, function() {
              window.location.href = "ausentismoView.php";
          });
        },
        error: function (xhr, status, error) {
          console.log(xhr);
        },
      });
    }
  });
});

function cargarEmpleados() {
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
      crearSelector("#empleado", nombreEmpleados);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function cargarEmpleado(nombre) {
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

function cargarMotivos() {
  $.ajax({
    url: "includes/models/getMotivos.php",
    type: "GET",
    dataType: "json",
    success: function (motivos) {
      motivos.forEach((motivo) => {
        motivosFaltas.push({
          nombre: motivo.NombreMotivo,
          id: motivo.idMotivoFalta,
        });
      });
      crearSelector("#motivo", motivosFaltas);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}
