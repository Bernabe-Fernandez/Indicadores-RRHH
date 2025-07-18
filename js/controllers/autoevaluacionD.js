$(document).ready(function () {
  let autoDesempeno = getCookie("AutoevaluacionDesem");
  if (autoDesempeno) {
    $("#mensajeForm").show();
    $("#head-encuesta").hide();
    $("#body-encuesta").hide();
  }
  empleado = $("#empleadoAu");
  consultarEmpleados();
  empleado.change(function () {
    // console.log(empleado.val());
    datosEmpleado(empleado.val());
  });
  $("#fomularioAutoDesempeno").submit(function (event) {
    event.preventDefault();
    if (empleado.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe Seleccionar un empleado" };
      alerta(infoAlerta);
    } else if (
      $("#misionAu").val() === "" ||
      $("#visionAu").val() === "" ||
      $("#objetivosAu").val() === "" ||
      $("#misionAu").val() === null ||
      $("#visionAu").val() === null ||
      $("#objetivosAu").val() === null ||
      $("#supervisionAu").val() === null ||
      $("#independienteAu").val() === null ||
      $("#ayudaAu").val() === null ||
      $("#aportacionAu").val() === null ||
      $("#innovadorAu").val() === null ||
      $("#influenciaAu").val() === null ||
      $("#lograrAu").val() === null ||
      $("#imprevistosAu").val() === null ||
      $("#comunicacionAu").val() === null ||
      $("#cooperasAu").val() === null ||
      $("#compromisoAu").val() === null ||
      $("#horarioAu").val() === null ||
      $("#puntualidadAu").val() === null ||
      $("#identificarAu").val() === null ||
      $("#iniciativaAu").val() === null ||
      $("#trabajoEquiAu").val() === null ||
      $("#futuroAu").val() === null ||
      $("#estrategiasAu").val() === null ||
      $("#confianzaAu").val() === null ||
      $("#efectivoAu").val() === null ||
      $("#recursosAu").val() === null ||
      $("#ordenesAu").val() === null ||
      $("#capacidadAu").val() === null ||
      $("#potencialAu").val() === null ||
      $("#resultadosAu").val() === null ||
      $("#destrezaAu").val() === null ||
      $("#trabajoAu").val() === null ||
      $("#desempenoAu").val() === null
    ) {
      infoAlerta = {
        icono: "error",
        mensaje: "Todos los campos son requeridos.",
      };
      alerta(infoAlerta);
    } else {
      let formData = $(this).serialize();
      formData += "&pagina=" + encodeURIComponent("autoDesem");
      // console.log(formData);
      $.ajax({
              type: "POST",
              url: "includes/models/createEncuestas.php",
              data: formData,
              success: function (response) {
                // console.log(response);
                alerta(response, function () {
                  window.location.href = "encuestaDesempeno.html";
                });
              },
              error: function (xhr, status, error) {
                console.log(xhr);
              },
      });
    }
  });

});

function consultarEmpleados() {
  empleados = [];
  $.ajax({
    type: "GET",
    url: "includes/models/getEmpleados.php",
    data: { key: "2" },
    success: function (response) {
      // console.log(response);
      response.forEach((empleado) => {
        empleados.push({ id: empleado.idEmpleado, nombre: empleado.Nombre });
      });
      crearSelector("#empleadoAu", empleados);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function datosEmpleado(empleado) {
  $.ajax({
    type: "GET",
    url: "includes/models/getEmpleados.php",
    data: { key: "3", id: empleado },
    success: function (response) {
      // console.log(response);
      $("#areaAu").val(response.NombreArea);
      $("#puestoAu").val(response.NombrePuesto);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
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

function crearSelector(nombre, datos) {
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
  // Llenar el select con las opciones
  datos.forEach(function (dato) {
    select.append(
      $("<option>", {
        text: dato.nombre,
        value: dato.id,
      })
    );
  });
}

function getCookie(name) {
  let value = "; " + document.cookie;
  let parts = value.split("; " + name + "=");
  if (parts.length === 2) return parts.pop().split(";").shift();
}
