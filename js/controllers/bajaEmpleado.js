let selectArea = $("#areaEmpleado");
let selectPuesto = $("#puestoEmpleado");
let selectMotivos = $("#motivoEgreso");
let nombre = $("#nombreEmpleado");
let ingreso = $("#fechaIngreso");
let egreso = $("#fechaEgreso");
let observaciones = $("#ComEgreso");
let id;
let datos = [];
$(document).ready(function () {
  // Obtener la cadena de consulta de la URL
  let url = window.location.search;
  // Convertir la cadena de consulta en un objeto de parámetros
  let parametros = new URLSearchParams(url);
  // Obtener el valor del parámetro 'editar'
  id = parametros.get("id");
  cargarDatos(id);
  $("#formulario-bajaEmpleados").submit(function (event) {
    datos = [];
    selectPuesto.removeAttr("disabled");
    selectArea.removeAttr("disabled");
    nombre.removeAttr("disabled");
    ingreso.removeAttr("disabled");
    event.preventDefault();
    let formData = $(this).serialize();
    formData += "&idEmpleado=" + encodeURIComponent(id);
    formData += "&Estatus=" + encodeURIComponent("0");
    formData += "&modificacion=" + encodeURIComponent(fechaActual);
    formData += "&usuarioModifi=" + encodeURIComponent(nombreUsuario);
    formData += "&key=" + encodeURIComponent("0");
    if (egreso.val() === "") {
      datos = { icono: "error", mensaje: "El campo Egreso es requerido" };
      alerta(datos);
    } else if(selectMotivos.val() === null){
      datos = { icono: "error", mensaje: "El campo Motivos es requerido" };
      alerta(datos);
    }else if(observaciones.val() === ""){
      datos = { icono: "error", mensaje: "El campo Comentario Egreso es requerido" };
      alerta(datos);
    }else{
      //ejecutar codigo de insercion
      console.log(formData);
      $.ajax({
        type: "POST",
        url: "includes/models/editEmpleado.php",
        data: formData,
        success: function (response) {
          // console.log(response);
          alerta(response, function () {
            window.location.href = "rotacion.php";
          });
        },
        error: function (xhr, status, error) {
          console.log(error);
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
  let area;
  nombre.val(datos.Nombre);
  ingreso.val(datos.Ingreso);

  // Cargar áreas antes de asignar el valor del área seleccionada
  cargarAreas().then(() => {
    selectArea.val(datos.idArea);
    area = selectArea.val();
    if (area != 0 && area != null && area != "") {
      cargarPuestos(area).then(() => {
        selectPuesto.val(datos.idPuesto);
      });
    }
  });
  cargarMotivosEgreso();
}

function cargarAreas() {
  listArea=[];
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "includes/models/getFiltroAreas.php",
      type: "GET",
      dataType: "json",
      success: function (areas) {
        // console.log(areas);
        areas.forEach((area) => {
          listArea.push({ id: area.idArea, nombre: area.NombreArea });
        });
        crearSelectorBaja("#areaEmpleado", listArea);
        resolve();
      },
      error: function (xhr, status, error) {
        reject(xhr);
      },
    });
  });
}

function cargarPuestos(area) {
  listPuesto = [];
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "includes/models/getPuestos.php",
      type: "GET",
      dataType: "json",
      data: { area: area, key: "1" },
      success: function (puestos) {
        // console.log(puestos);
        puestos.forEach((puesto) => {
          listPuesto.push({ id: puesto.idPuesto, nombre: puesto.NombrePuesto });
        });
        crearSelectorBaja("#puestoEmpleado", listPuesto);
        resolve();
      },
      error: function (xhr, status, error) {
        reject(xhr);
      },
    });
  });
}

function crearSelectorBaja(nombre, datos) {
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
        value: dato.id,
        text: dato.nombre,
      })
    );
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

function cargarMotivosEgreso() {
  listMotivos = [];
  $.ajax({
    url: "includes/models/getMotivosEgreso.php",
    type: "GET",
    dataType: "json",
    success: function (motivos) {
      motivos.forEach((motivo) => {
        listMotivos.push({ id: motivo.idMotivosBaja, nombre: motivo.MotivoBaja });
      });
      crearSelectorBaja("#motivoEgreso", listMotivos);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}
