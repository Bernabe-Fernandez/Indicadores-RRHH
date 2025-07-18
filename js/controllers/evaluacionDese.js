$(document).ready(function () {
  const hoy = new Date();
  const fechaActual = formatDate(hoy);
  empleado = $("#empleado");
  consultarEmpleados();
  empleado.change(function () {
    datosEmpleado(empleado.val(), fechaActual);
  });
  $("#formulario-eDesempeno").submit(function (event) {
    event.preventDefault();
    if (empleado.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe Seleccionar un empleado" };
      alerta(infoAlerta);
    } else if (
      $("#potencialD").val() === null ||
      $("#calidadD").val() === null ||
      $("#consistenciaD").val() === null ||
      $("#comuniD").val() === null ||
      $("#trabajoInD").val() === null ||
      $("#iniciativaD").val() === null ||
      $("#equipoD").val() === null ||
      $("#producD").val() === null ||
      $("#creatiD").val() === null ||
      $("#honestoD").val() === null ||
      $("#integriD").val() === null ||
      $("#relacionD").val() === null ||
      $("#clientesD").val() === null ||
      $("#habilidadesD").val() === null ||
      $("#fiabilidadD").val() === null ||
      $("#puntualD").val() === null ||
      $("#asistenciaD").val() === null ||
      $("#interesD").val() === null ||
      $("#compromisoD").val() === null ||
      $("#resultadoD").val() === null
    ) {
      infoAlerta = {
        icono: "error",
        mensaje: "Todos los campos son requeridos",
      };
      alerta(infoAlerta);
    } else {
      //envio del form
      $("#jefeD").removeAttr("disabled", false);
      $("#fechaD").removeAttr("disabled", false);
      $("#antigD").removeAttr("disabled", false);
      let formData = $(this).serialize();
      formData += "&usuario=" + encodeURIComponent(nombreUsuario);
      formData += "&pagina=" + encodeURIComponent("desempeno");

      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/createEncuestas.php",
        data: formData,
        success: function (response) {
          // console.log(response);
          alerta(response, function () {
            window.location.href = "eDesempeno.php";
          });
        },
        error: function (xhr, status, error) {
          console.log(xhr);
        },
      });
    }
  });
});

async function consultarEmpleados() {
  let empleadosA = [];
  let datos = localStorage.getItem("datosUsuario");
  let usuario = JSON.parse(datos);
  idUsuario = usuario.idEmpleado;
  // console.log(idUsuario);
  //consultar area del usuario logueado
  try {
    //consultar area del usuario
    let areaRequest = await $.ajax({
      type: "GET",
      url: "includes/models/getEmpleados.php",
      data: { key: "4", idEmpleado: idUsuario },
    });

    let empleadosArea = await $.ajax({
      type: "GET",
      url: "includes/models/getEmpleados.php",
      data: {
        key: "5",
        area: areaRequest.Area,
        idEmpleado: areaRequest.idEmpleado,
      },
    });
    empleadosArea.forEach((empleados) => {
      empleadosA.push({ nombre: empleados.Nombre, id: empleados.idEmpleado });
    });
    crearSelector("#empleado", empleadosA);
  } catch (error) {
    console.log(error);
  }
}

function datosEmpleado(empleado, fechaActual) {
  $.ajax({
    type: "GET",
    url: "includes/models/getEmpleados.php",
    data: { key: "3", id: empleado },
    success: function (response) {
      // console.log(response);
      $("#areaD").val(response.NombreArea);
      $("#puestoD").val(response.NombrePuesto);
      $("#jefeD").val(nombreUsuario);
      $("#fechaD").val(fechaActual);
      $("#antigD").val(response.antiguedad);
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

//formatear fecha
function formatDate(date) {
  const year = date.getFullYear();
  const month = (date.getMonth() + 1).toString().padStart(2, "0"); // Añade 1 porque los meses van de 0 a 11
  const day = date.getDate().toString().padStart(2, "0");

  return `${year}-${month}-${day}`;
}
