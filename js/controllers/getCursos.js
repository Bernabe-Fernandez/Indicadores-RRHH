$(document).ready(function () {
    obtenerDatos()
      .done(function (cursos) {
        if(cursos.mensaje){
          console.log(cursos.mensaje);
          cursos = [];
        }
        $("#tablaCursos").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
            emptyTable: "Sin datos para mostrar",
          },
          order: [],
          data: cursos, // Usar la variable global para los datos
          columns: [
            { data: "Nombre", className: "text-center" },          
            { data: "Fecha", className: "text-center" },
            {
                data: null,
                className: "text-center",
                orderable: false,
                render: function (data, type, row) {
                  return `
                    <a class="boton boton-edit" href = "cursoEdit.php?id=${row.idCapacitacion}">Editar</a>
                  `;
                }
            },
          ],
        });
      })
      .fail(function (error) {
        console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
      });
  });
  
  function obtenerDatos() {
    // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
    return $.ajax({
      url: "includes/models/getCursos.php",
      type: "GET",
      dataType: "json",
      data: {key:'0'},
    });
  }
  