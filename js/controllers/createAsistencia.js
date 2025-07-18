let asistencias;
let fechas;
let periodo;
$(document).ready(function () {
  $("#form-registroReporte").submit(function (e) {
    e.preventDefault();
    //generar formData para envio del archivo
    if (validarRequeridos()) {
      alertaCarga("Cargando reporte al sistema");
      let formData = new FormData();
      let file = $("#reporteAsis")[0].files[0];
      formData.append("excelFile", file);
      setFormData(formData);
    }
  });

  $("#NewReporte").click(function (e) {
    e.preventDefault();
    ocultarEstructura("#formatoTabla");
    mostrarEstructura("#createReporte");
  });

  $("#genReporte").click(function (e) {
    e.preventDefault();
    seleccionarDatos();
  });
});

// funciones principales
function setFormData(formData) {
  // console.log(formData);
  $.ajax({
    type: "POST",
    url: "includes/models/createRAsistencia.php",
    data: formData,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (response) {
      //si es exito, generamos el reporte visual, hacemos el cambio de vistas
      // console.log(response);
      generarTabla(response);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function generarTabla(datosReporte) {
  $("#tablaReporte tbody").empty();
  $("#tablaReporte thead").empty();
  asistencias = datosReporte[0];
  fechas = datosReporte[1];
  periodo = datosReporte[2];

  let trTitulo = `<tr><th class='titulo-tabla' colspan='${
    fechas.length + 4
  }'>Periodo ${periodo}</th></tr>`;
  let trTituloSub = `<tr class='titulos-esp'>
                            <th rowspan='2'>Usuario</th>
                            <th colspan='${fechas.length}'>Fecha</th>
                            <th rowspan='2'>Retardos</th>
                            <th rowspan='2'>Faltas</th>
                            <th rowspan='2'>Incluir</th>
                        </tr>`;
  let trFechas = $(`<tr class="titulos-esp"></tr>`);
  fechas.forEach((fecha) => {
    thfechas = `<th>${fecha}</th>`;
    trFechas.append(thfechas);
  });

  $("#headReporte").append(trTitulo, trTituloSub, trFechas);

  //codigo para generar el contenido de la tabla
  asistencias.forEach((asistencia) => {
    // console.log(asistencia);
    let trBody = $(`<tr class="contenido-esp"></tr>`);
    trBody.append(`<td>${asistencia.nombre}</td>`);
    //aqui recorremos el horario para poder imprimir los datos
    for (i = 0; i < fechas.length; i++) {
      if (asistencia.horario[i] === null) {
        asistencia.horario[i] = "";
      }
      trBody.append(`<td contenteditable="true">${asistencia.horario[i]}</td>`);
    }
    trBody.append(`<td contenteditable="true"></td>`);
    trBody.append(`<td contenteditable="true"></td>`);
    trBody.append(`<td><input type="checkbox" class="checkbox"></td>`);

    $("#bodyReporte").append(trBody);

    setTimeout(function () {
      Swal.close();
      mostrarEstructura("#formatoTabla");
      ocultarEstructura("#createReporte");
    }, 1700);
  });
}

function seleccionarDatos() {
  let infoReporte = [];
  let tamañoTabla = $("#formatoTabla tbody tr:first-child").children(
    "td"
  ).length;

  // Recorre cada fila que tiene un checkbox marcado
  $("#formatoTabla tbody tr").each(function () {
    let nombre = "";
    let faltas = "";
    let retardos = "";
    let horario = [];
    let registro;
    let checkbox = $(this).find(".checkbox");
    if (checkbox.is(":checked")) {
      $(this)
        .find("td")
        .each(function (index) {
          // console.log(index);
          if (index === 0) {
            nombre = $(this).text();
          } else if (index === tamañoTabla - 2) {
            faltas = $(this).text();
          } else if (index === tamañoTabla - 3) {
            retardos = $(this).text();
          } else {
            horario.push($(this).text());
          }
        });
      registro = {
        nombre: nombre,
        horario: horario,
        retardos: retardos,
        faltas: faltas,
      };

      infoReporte.push(registro);
    }
  });

  if (infoReporte.length === 0) {
    alerta({
      icono: "error",
      mensaje: "Debe seleccionar el contenido del reporte",
    });
  } else {
    enviarReporte(infoReporte);
  }
  infoReporte = [];
}

function enviarReporte(infoReporte) {
  //aqui se generara una alerta para generar el reporte semanal o quincenal
  alertaQuestion(infoReporte);
}

function generarReporte(infoReporte, tipoReporte) {
  $.ajax({
    type: "POST",
    url: "includes/reportes/reporteAsistencia.php",
    data: { infoReporte: infoReporte, fechas: fechas, periodo: periodo, tipoReporte: tipoReporte},
    dataType: "json",
    success: function (response) {
      // console.log(response);
      alerta(response, function () {
        window.location.href = 'reporteCreate.php';
      });
      ruta = `assets/reportes/${response.ruta}`; 
      window.open(ruta, '_blank');
    },
    error: function (xhr, status, error) {
      console.error("Error al generar el PDF:", error);
      alert("Ocurrió un error al generar el PDF.");
    },
  });
}


//funciones auxiliares
function validarRequeridos() {
  // console.log($("#reporteAsis").val());
  if ($("#reporteAsis").val() === "") {
    alerta({
      icono: "error",
      mensaje: "Debe subir un archivo para generar el reporte",
    });
  } else {
    return true;
  }
}

function mostrarEstructura(elemento) {
  $(elemento).removeClass("hidden");
  $(elemento).addClass("view");
}

function ocultarEstructura(elemento) {
  $(elemento).removeClass("view");
  $(elemento).addClass("hidden");
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

function alertaCarga(mensaje) {
  Swal.fire({
    title: mensaje,
    text: "Por favor espera...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });
}

function alertaQuestion(infoReporte) {
  Swal.fire({
    title: "¿Qué tipo de reporte quiere generar?",
    text: "Seleccione una opción, tome en cuenta que la elección seleccionada es permanente.",
    icon: "question",
    showCancelButton: true,
    cancelButtonColor: "#FA2323",
    cancelButtonText: "Cancelar",
    showConfirmButton: false,  // Ocultamos el botón estándar de confirmación
    html: `
      <button id="btn-semanal" class="swal2-confirm swal2-styled" style="background-color: #304AFA;">Semanal</button>
      <button id="btn-quincenal" class="swal2-confirm swal2-styled" style="background-color: #42FA31;">Quincenal</button>
      <button id="btn-venta" class="swal2-confirm swal2-styled" style="background-color: #F4C724;">Ventas</button>
    `,
    didOpen: () => {
      document.getElementById('btn-semanal').addEventListener('click', () => {
        generarReporte(infoReporte, 'semanal');
        Swal.close(); // Cerrar la alerta sin disparar la notificación de cancelación
      });
      document.getElementById('btn-quincenal').addEventListener('click', () => {
        generarReporte(infoReporte, 'quincenal');
        Swal.close(); // Cerrar la alerta sin disparar la notificación de cancelación
      });
      document.getElementById('btn-venta').addEventListener('click', () => {
        generarReporte(infoReporte, 'ventas');
        Swal.close(); // Cerrar la alerta sin disparar la notificación de cancelación
      });
    }
  }).then((result) => {
    // Solo muestra el mensaje si realmente fue cancelado manualmente
    if (result.dismiss === Swal.DismissReason.cancel) {
      Swal.fire("Cancelado", "Has cancelado la acción.", "info");
    }
  });
  // Swal.fire({
  //   title: "¿Qué tipo de reporte quiere generar?",
  //   text: "Seleccione una opción, tome en cuenta que la elección seleccionada es permanente.",
  //   icon: "question",
  //   showDenyButton: true,
  //   showCancelButton: true,
  //   confirmButtonColor: "#304AFA",
  //   denyButtonColor: "#42FA31",
  //   cancelButtonColor: "#FA2323",
  //   confirmButtonText: "Semanal",
  //   denyButtonText: "Quincenal",
  //   cancelButtonText: "Cancelar",
  // }).then((result) => {
  //   if (result.isConfirmed) {
  //     generarReporte(infoReporte, "semanal");
  //   } else if (result.isDenied) {
  //     generarReporte(infoReporte, "quincenal");
  //   } else if (result.isDismissed) {
  //     Swal.fire("Cancelado", "Has cancelado la acción.", "info");
  //   }
  // });
}
