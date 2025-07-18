$(document).ready(function () {
  consultarAllReportes();

  $("#verReporte").click(function (e) {
    e.preventDefault();
    let verificar = verificarRequeridos();
    if (verificar) {
      //funcion para poder consultar los datos
      abrirReporte($("#reporteAsis").val());
    }
  });

  $("#dowReporte").click(function (e) { 
    e.preventDefault();
    let verificar = verificarRequeridos();
    if (verificar) {
        descargarReporte($("#reporteAsis").val());
    }
  });

  $("#form-filtros").submit(function (e) {
    e.preventDefault();
    let validar = validarFiltros();
    if (validar) {
      let formDatos = $(this).serialize();
      // console.log(formDatos);
      getReportesFiltros(formDatos);
    }
  });

  $("#btn-limpiar").click(function (e) {
    e.preventDefault();
    limpiarForm();
    consultarAllReportes();
  });
});

// funciones principales
function consultarAllReportes() {
  $.ajax({
    type: "GET",
    url: "includes/models/getReporteAsistencia.php",
    data: {key: '1'},
    dataType: "json",
    success: function (documentos) {
      generarSelector(documentos);
    },
    error: function (xhr, status, error) {
      alertaEstatica({ icono: "error", mensaje: 'Error al cargar los archivos' });
      console.log(xhr.responseText);
    },
  });
}

function getReportesFiltros(formData) {
  //   console.log(formData);
  $.ajax({
    type: "POST",
    url: "includes/models/asistencia/getReportesFiltro.php",
    data: formData,
    dataType: "json",
    success: function (response) {
      // console.log(response);
      generarSelector(response);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
      console.log(error);
    },
  });
}

function consultarReportes(tipoReporte) {
  // console.log(tipoReporte);
  $.ajax({
    type: "POST",
    url: "includes/models/getReporteAsistencia.php",
    data: { tipoReporte: tipoReporte },
    dataType: "json",
    success: function (documentos) {
      generarSelector(documentos);
    },
    error: function (xhr, status, error) {
      alertaEstatica({ icono: "error", mensaje: xhr.responseText });
    },
  });
}

function abrirReporte(nameReporte) {
  $.ajax({
    type: "POST",
    url: "includes/models/asistencia/viewReporte.php",
    data: { reporte: nameReporte},
    dataType: "json",
    success: function (response) {
      // console.log(response);
      if (response.mensaje) {
        alertaEstatica(response);
      } else {
        window.open(response, "_blank");
      }
    },
    error: function (xhr, status, error) {
      alertaEstatica({ icono: "error", mensaje: xhr.responseText });
    },
  });
}

function descargarReporte(nameReporte){
  $.ajax({
    type: "POST",
    url: "includes/models/asistencia/viewReporte.php",
    data: { reporte: nameReporte},
    dataType: "json",
    success: function (response) {
      // console.log(response);
      if (response.mensaje) {
        alertaEstatica(response);
      } else {
        let url = response; // La URL que devuelve el servidor

        // Crear un enlace temporal y hacer clic para iniciar la descarga
        var link = document.createElement("a");
        link.href = url;
        link.download = nameReporte; // Nombre sugerido para el archivo descargado
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }
    },
    error: function (xhr, status, error) {
      alertaEstatica({icono: 'error', mensaje: 'Error al cargar '})
      console.log(xhr);
    },
  });
}

// funciones auxiliares
function generarSelector(documentos) {
  let $select = $("#reporteAsis");
    // console.log(documentos);
  if (documentos.length <= 0) {
    alertaEstatica({ icono: "error", mensaje: "No se encontraron archivos" });
    $select.empty();
    $select.attr("disabled", true);
    $select.append(
      $("<option disabled selected></option>")
        .val("0")
        .text("Seleccione una opción")
    );
  } else {   
    alertaEstatica({icono: 'success', mensaje: 'Archivos cargados correctamente'});
    $select.removeAttr("disabled");
    $select.empty(); // Limpia el select antes de agregar nuevas opciones
    $select.append(
      $("<option disabled selected></option>")
        .val("0")
        .text("Seleccione una opción")
    );
    $.each(documentos, function (key, value) {
      $select.append($("<option></option>").val(value).text(value));
    });
  }
}

function verificarRequeridos() {
  if ($("#tipoReporte").val() === null) {
    alertaEstatica({
      icono: "error",
      mensaje: "Debe seleccionar un tipo de reporte",
    });
  } else if ($("#reporteAsis").val() === null) {
    alertaEstatica({ icono: "error", mensaje: "Debe seleccionar un reporte" });
  } else {
    return true;
  }
}

function validarFiltros() {
  if (
    $("#mesReporte").val() === "0" &&
    $("#anioReporte").val() === "0" &&
    $("#tReporte").val() === "0"
  ) {
    alertaEstatica({
      icono: "error",
      mensaje: "Debe seleccionar al menos un filtro para aplicar",
    });
  } else {
    return true;
  }
}

function limpiarForm(){
  $("#mesReporte").val(0);
  $("#anioReporte").val(0);
  $("#tReporte").val(0);
}

//alerta estatita
function alertaEstatica(datos, callback) {
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
