$(document).ready(function () {
  obtenerDatos()
    .done(function (empleados) {
        if(empleados.mensaje){
          console.log(empleados.mensaje);
          empleados=[];
        }else{
          empleados.forEach(empleado => {
            if(empleado['Estatus'] === '1'){
                empleado['Estatus'] = 'Activo';
            }else{
                empleado['Estatus'] = 'Inactivo';
            }
            if(empleado['Egreso'] === null){
                empleado['Egreso'] = '---';
            }
            if(empleado['Ingreso'] === null){
              empleado['Ingreso'] = 'N/A';
          }
          });
        }
        $("#empleados").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: empleados, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
          { data: "Ingreso", className: "text-center" },
          { data: "Egreso", className: "text-center" },
          { data: "Estatus", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                <div class="contenedor-botones">
                  <a class="boton boton-ver" data-id="${row.idEmpleado}">Ver</a>  
                  <a class="boton boton-edit" href = "empleadosEdit.php?id=${row.idEmpleado}">Editar</a>
                  <a class="boton boton-baja" href = "empleadosBaja.php?id=${row.idEmpleado}">Baja</a>
                </div>
              `;
            }
          }
        ],
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });

    $("#empleados").on("click", ".boton-ver", function () {
      alertaCargar("Generando PDF");
      const id = $(this).data("id");
      // console.log(id);
      consultarReporteEmpleado(id);
    });

});

function obtenerDatos() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
  });
}

function consultarReporteEmpleado(idEmpleado) {
  $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
    data: { key: '6', id: idEmpleado},
    success: function (empleado) {
      // console.log(empleado);
      crearReporteEmpleado(empleado);
    },
    error: function (xhr, status, error) {
      console.error("Error al consultar los datos:", xhr);
    },
  });
}


function crearReporteEmpleado(datosEmp) {
  // console.log(datosEmp);
  // console.log(evaluacionD);
  //mandar la informacion para generar el reporte
  $.ajax({
    url: "includes/reportes/viewEmpleados.php",
    type: "GET",
    contentType: "application/json",
    data: { informacion: JSON.stringify(datosEmp) },
    xhrFields: {
      responseType: "blob", // Para recibir una respuesta tipo Blob (archivo binario)
    },
    success: function (blob) {
      // console.log(blob)
      Swal.close();
      // Crear una URL del blob para el PDF generado
      let url = window.URL || window.webkitURL;
      let link = url.createObjectURL(blob);
      // const link = URL.createObjectURL(blob);
        window.open(link, "_blank");
    },
    error: function (xhr, status, error) {
      console.error("Error al generar el PDF:", error);
      alert("Ocurrió un error al generar el PDF.");
    },
  });
}


function alertaCargar(mensaje) {
  Swal.fire({
    title: mensaje,
    text: "Por favor espera...",
    allowOutsideClick: false,
    didOpen: () => {
      Swal.showLoading();
    },
  });
}
