$(document).ready(function () {
  let climaLaboral = getCookie("climaLaboral");
  if (climaLaboral) {
    $("#mensajeForm").show();
    $("#head-encuesta").hide();
    $("#body-encuesta").hide();
  }
  crearPuntuacion();
  verificarCheckbox();

  $("#acosoL").change(function () {
    // Obtener el valor seleccionado
    let valor = $(this).val();
    if (valor === "2") {
      //aqui hacemos el cambio para mostrar el otro input
      $("#acosoEsp").show();
    } else {
      $("#acosoEsp").hide();
    }
  });

  $("#sucesoLaboral").change(function () {
    // Obtener el valor seleccionado
    let valor = $(this).val();
    if (valor === "2") {
      //aqui hacemos el cambio para mostrar el otro input
      $("#sucesoL").show();
    } else {
      $("#sucesoL").hide();
    }
  });
  //acciones con el formulario
  $("#fomularioClima").submit(function (event) {
    event.preventDefault();
    clima = $('input[type="checkbox"]:checked').val();
    // console.log(calificacionJ);
    if (
      $("#relacionJ").val() === null ||
      $("#relacionD").val() === null ||
      $("#relacionG").val() === null ||
      $("#apoyo").val() === null ||
      $("#apoyar").val() === null ||
      $("#gustoC").val() === "" ||
      $("#disgustoC").val() === "" ||
      $("#comodo").val() === null ||
      $("#accidente").val() === null ||
      $("#peligro").val() === null ||
      $("#tAdicional").val() === null ||
      $("#Tsinparar").val() === null ||
      $("#Tacelerado").val() === null ||
      $("#concentracion").val() === null ||
      $("#memoriceInfo").val() === null ||
      $("#variosAsun").val() === null ||
      $("#acosoL").val() === null ||
      $("#sucesoLaboral").val() === null ||
      clima === undefined ||
      $("#mejoras").val() === ""
    ) {
      infoAlerta = {
        icono: "error",
        mensaje: "Todos los campos son requeridos.",
      };
      alerta(infoAlerta);
    } else {
      let formData = $(this).serialize();
      formData += "&pagina=" + encodeURIComponent("clima");
      console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/createEncuestas.php",
        data: formData,
        success: function (response) {
          // console.log(response);
          alerta(response, function () {
            window.location.href = "encuestaClimaL.html";
          });
        },
        error: function (xhr, status, error) {
          console.log(xhr);
        },
      });
    }
  });

  //     // console.log(formData);
  //     $.ajax({
  //       type: "POST",
  //       url: "includes/models/createEncuestas.php",
  //       data: formData,
  //       success: function (response) {
  //         console.log(response);
  //         alerta(response, function () {
  //           window.location.href = "encuestaSalida.html";
  //         });
  //       },
  //       error: function (xhr, status, error) {
  //         console.log(xhr);
  //       },
  //     });
  //   }
  // });
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

function crearPuntuacion() {
  puntos = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
  $.each(puntos, function (index, punto) {
    // console.log(punto);
    var $checkbox = $("<input>", {
      type: "checkbox",
      name: "climaL",
      id: "climaL" + punto,
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
