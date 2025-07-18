$(document).ready(function () {
  let encuestaSalida = getCookie("encuestaSalida");
  if (encuestaSalida) {
    $("#mensajeForm").show();
    $("#head-encuesta").hide();
    $("#body-encuesta").hide();
  }
  let colaborador = $("#colaborador");
  let puestoC = $("#puestoC");
  let areaC = $("#areaC");
  let ingresoC = $("#ingresoC");
  let egresoC = $("#egresoC");
  let motivoE = $("#motivoE");
  //cargarDatos de empleado
  cargarEmpleados();
  crearPuntuacion();
  verificarCheckbox();
  colaborador.change(function (e) {
    idEmpleado = colaborador.val();
    if (idEmpleado != 0 || idEmpleado != null || idEmpleado != "") {
      //   console.log(idEmpleado);
      //llamar los datos del empleado
      cargarEmpleado(idEmpleado)
        .done(function (informacion) {
          //   console.log(informacion);
          puestoC.val(informacion.NombrePuesto);
          areaC.val(informacion.NombreArea);
          ingresoC.val(informacion.Ingreso);
          if (informacion.Egreso != null) {
            egresoC.val(informacion.Egreso);
            egresoC.attr("disabled", true);
          } else {
            egresoC.val("");
            egresoC.attr("disabled", false);
          }
        })
        .fail(function (error) {
          console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
        });
    }
  });
  motivoE.change(function (e) {
    e.preventDefault();
    // console.log(motivoE.val());
    if (motivoE.val() === "Otro") {
      $("#Otro").show();
    } else {
      $("#Otro").hide();
    }
  });
  //acciones con el formulario
  $("#fomularioSalida").submit(function (event) {
    event.preventDefault();
    calificacionJ = $('input[type="checkbox"]:checked').val();
    // console.log(calificacionJ);
    if (colaborador.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe seleccionar su Nombre" };
      alerta(infoAlerta);
    } else if (egresoC === null) {
      infoAlerta = { icono: "error", mensaje: "Debe colocar una Fecha" };
      alerta(infoAlerta);
    } else if (motivoE.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe seleccionar un motivo" };
      alerta(infoAlerta);
    } else if (!$("#otroM").is(":hidden") && $("#otroM").val() === "") {
      infoAlerta = { icono: "error", mensaje: "Debe especificar otro motivo" };
      alerta(infoAlerta);
    } else if ($("#relacionJ").val() === null) {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe calificar la relación con su Jefe Inmediato",
      };
      alerta(infoAlerta);
    } else if (calificacionJ === undefined) {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe colocar una calificación",
      };
      alerta(infoAlerta);
    } else if ($("#relacionC").val() === null) {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe calificar la relación con sus compañeros",
      };
      alerta(infoAlerta);
    } else if ($("#gusto").val() === "") {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe llenar todos los campos",
      };
      alerta(infoAlerta);
    } else if ($("#disgusto").val() === "") {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe llenar todos los campos",
      };
      alerta(infoAlerta);
    } else if ($("#mejora").val() === "") {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe llenar todos los campos",
      };
      alerta(infoAlerta);
    } else if ($("#recomendacion").val() === null) {
      infoAlerta = {
        icono: "error",
        mensaje: "Debe llenar todos los campos",
      };
      alerta(infoAlerta);
    } else {
      egresoC.attr("disabled", false);
      let formData = $(this).serialize();
      formData += "&pagina=" + encodeURIComponent("salida");

      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/createEncuestas.php",
        data: formData,
        success: function (response) {
          console.log(response);
          alerta(response, function () {
            window.location.href = "encuestaSalida.html";
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
  let nombreEmpleados = [];
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
    success: function (empleados) {
      empleados.forEach((empleado) => {
        nombreEmpleados.push({
          nombre: empleado.Nombre,
          id: empleado.idEmpleado,
        });
      });
      crearSelector("#colaborador", nombreEmpleados);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function cargarEmpleado(idEmpleado) {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    data: { id: idEmpleado, key: "3" },
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

function crearPuntuacion() {
  puntos = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
  $.each(puntos, function (index, punto) {
    // console.log(punto);
    var $checkbox = $("<input>", {
      type: "checkbox",
      name: "calificacionJ",
      id: "calificacionJ" + punto,
      value: punto,
    });
    var $label = $("<label>", {
      text: punto,
    });

    // Agregar el checkbox dentro del label y luego al contenedor
    $label.prepend($checkbox); // Agrega el checkbox antes del texto del label
    $("#contenedorNumeros").append($label);
  });
}

function verificarCheckbox() {
  $('input[type="checkbox"]').change(function () {
    // Desmarcar todos los checkboxes excepto el que se acaba de seleccionar
    $('input[type="checkbox"]').not(this).prop("checked", false);
  });
}

function getCookie(name) {
  let value = "; " + document.cookie;
  let parts = value.split("; " + name + "=");
  if (parts.length === 2) return parts.pop().split(";").shift();
}
