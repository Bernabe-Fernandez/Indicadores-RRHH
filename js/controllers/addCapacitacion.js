let selectCursoEmpleado = $("#empleadoCurso");
let selectCursos = $("#cursoSelector");
let puesto = $("#puestoCurso");
let area = $("#areaCurso");
let fecha = $("#fechaCurso");
let idEmpleado;
let empleado;
let nombreEmpleados = [];
let cursosLista = [];

$(document).ready(function () {
  //cargarDatos de empleado
  cargarEmpleados();
  cargarCursos();
  selectCursos.change(function () {
    idCurso = selectCursos.val();
    if (idCurso != 0 || idCurso != null || idCurso != "") {
      //cargamos la fecha del curso
      cargarCurso(idCurso)
        .done(function (curso) {
          fecha.val(curso.Fecha);
        })
        .fail(function (error) {
          console.log("Error al obtener los datos:", error.responseText);
        });
    }
  });
  selectCursoEmpleado.change(function () {
    empleado = selectCursoEmpleado.val();
    if (empleado != 0 || empleado != null || empleado != "") {
      // console.log(empleado);
      //cargar Info de empleado seleccionado
      cargarEmpleado(empleado)
        .done(function (informacion) {
          // console.log(informacion);
          puesto.val(informacion.NombrePuesto);
          area.val(informacion.NombreArea);
        })
        .fail(function (error) {
          console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
        });
    }
  });
  $("#formulario-addCapacitacion").submit(function (event) {
    event.preventDefault();
    if (selectCursos.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe seleccionar un Curso" };
      alerta(infoAlerta);
    } else if (selectCursoEmpleado.val() === null) {
      infoAlerta = { icono: "error", mensaje: "Debe seleccionar un Empleado" };
      alerta(infoAlerta);
    } else {
      let formData = $(this).serialize();
      formData += "&creacion=" + encodeURIComponent(fechaActual);
      formData += "&usuarioCreacion=" + encodeURIComponent(nombreUsuario);
      // console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/createCapacitacion.php",
        data: formData,
        success: function (response) {
          // console.log(response);
          alerta(response, function () {
            window.location.href = "capacitacionView.php";
          });
        },
        error: function (xhr, status, error) {
          console.log(error);
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
        nombreEmpleados.push({
          nombre: empleado.Nombre,
          id: empleado.idEmpleado,
        });
      });
      crearSelector("#empleadoCurso", nombreEmpleados);
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

function cargarCurso(idCurso) {
  //consultar la fecha del curso
  return $.ajax({
    url: "includes/models/getCursos.php",
    type: "GET",
    dataType: "json",
    data: { key: "1", idCurso: idCurso },
  });
}

function cargarCursos() {
  $.ajax({
    url: "includes/models/getCursos.php",
    type: "GET",
    dataType: "json",
    data: { key: "0" },
    success: function (listaCursos) {
      listaCursos.forEach((listaCurso) => {
        cursosLista.push({ nombre: listaCurso.Nombre, id: listaCurso.idCapacitacion });
      });
      // console.log(cursosLista);
      crearSelector("#cursoSelector", cursosLista);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}
