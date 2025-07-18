$(document).ready(function () {
    getAllJuntas();

    $(document).on("click", "#eliminarJunta", function (e) {
      e.preventDefault();
      const idJunta = $(this).data("id");  // Obtener el ID desde el atributo data-id
      alertQuestion(idJunta);
    });


    $(document).on("click", "#verJunta", function(e) {
      e.preventDefault();
      const idJunta = $(this).data("id");
      //alerta para cargar documento
      // console.log('desde alerta carga')
      alertaCarga();
      // //consultar la informacion de la junta
      getInfoJunta(idJunta);
    })
});


// funcion para consultar todas las juntas

function getAllJuntas() {
    $.ajax({
        url: "includes/models/juntas/getJuntas.php",
        type: "GET",
        dataType: "json",
        data: { key: "1"},
        success: function (juntas) {
            // console.log(juntas)
            if(juntas.mensaje){
                alerta(juntas);
            }
            else{
                //crear la tabla de juntas
                createTablaJuntas(juntas);
            }
        },
        error: function (xhr, status, error) {
          alerta({ icono: "error", mensaje: error });
        },
      });
}


function createTablaJuntas(juntas) {
  // console.log(juntas)
    $("#tablaJuntas").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        lengthChange: false,
        data: juntas, // Usar la variable global para los datos
        columns: [
            { data: "nombreArea", className: "text-center" },
            { data: "nombreGerente", className: "text-center" },
            { data: "nombrePeriodo", className: "text-center" },
            { data: "fecha", className: "text-center" },
            { data: "hora", className: "text-center" },            
            { data: "temas",
              render: function (data, type, row) {
                // Reemplazar comas con saltos de línea
                return data.replace(/\r\n/g, "<br>");
              },
              className: "text-center text-wrap"},
            { data: "asistentes", 
              render: function (data, type, row) {
                // Reemplazar comas con saltos de línea
                return data.replace(/,/g, "<br>");
              },
              className: "text-center text-wrap" },
            {
                data: null,
                className: "text-center",
                orderable: false,
                render: function (data, type, row) {
                  if (data.IdGerente === idEmpleado) {
                    // Mostrar botones específicos para el gerente
                      return `
                          <div class="contenedor-boton">
                              <button class="boton boton-baja" id="eliminarJunta" data-id="${row.idJunta}">Eliminar</button>
                              <button class="boton boton-edit" id="verJunta" data-id="${row.idJunta}">Ver</button>
                          </div>
                      `;
                  } else {
                      // Mostrar otros botones si no es el gerente específico
                      return `
                          <div class="contenedor-boton">
                              <button class="boton boton-edit" id="verJunta" data-id="${row.idJunta}">Ver</button>
                          </div>
                      `;
                  }
                }
            },
        ],
      });
}


function eliminarRegistro(idJunta) {
  $.ajax({
    type: "POST",
    url: "includes/models/juntas/deleteJuntas.php",
    data: {idJunta: idJunta},
    dataType: "json",
    success: function (response) {
      alerta(response, function () {
        window.location.href = "juntasView.php";
      })
    },
    error: function (xhr, status, error) {
      alerta({ icono: "error", mensaje: error });
    },
  });
}


function alerta(datos, callback) {
    return Swal.fire({
      title: datos.mensaje,
      icon: datos.icono,
    }).then((result) => {
      if (callback && result.isConfirmed) {
        callback();
      }
    });
  }


function getInfoJunta(idJunta) {
  $.ajax({
    url: "includes/models/juntas/getJuntas.php",
    type: "GET",
    dataType: "json",
    data: { key: "2", idJunta: idJunta},
    success: function (junta) {
        // console.log(juntas)
        if(junta.mensaje){
            alerta(junta);
            return;
        }
        else{
            junta.forEach(data => {
              data.temas = data.temas.replace(/\r\n/g, "<br>");
              data.notas = data.notas.replace(/\r\n/g, "<br>");
              data.asistentes = data.asistentes.replace(/,/g, "<br>");
            });
            // console.log(junta)
            createReporteJunta(junta);
        }
    },
    error: function (xhr, status, error) {
      alerta({ icono: "error", mensaje: error });
    },
  });
}


function createReporteJunta(junta) {
  // console.log(junta)

  $.ajax({
    url: "includes/models/documentos/formatAsistencia.php",
    type: "GET",
    contentType: "application/json",
    data: { informacion: JSON.stringify(junta) },
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

function alertQuestion(idJunta) {
  return Swal.fire({
      title: '¿Realmente desea eliminar el registro?',
      text: '¡No podrás revertir esta acción!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
  }).then((result) => {
      if (result.isConfirmed) {
          // Llamar a la función para eliminar el registro
          eliminarRegistro(idJunta);  // Asegúrate de definir esta función
      }
  });
}

//alerta de carga
function alertaCarga() {
  Swal.fire({
    title: 'Cargando...',
    text: 'Por favor, espera mientras se genera el PDF.',
    allowOutsideClick: false,
    allowEscapeKey: false,
    didOpen: () => {
      Swal.showLoading();
    }
  });
}

