$(document).ready(function () {
    obtenerDatos()
      .done(function (areas) {
        if(areas.mensaje){
          console.log(areas.mensaje);
          areas = [];
        }else{
          areas.forEach(area => {
            if(area.estatus === '1'){
              area.estatus = "Activo";
            }else{
              area.estatus = "Inactivo";
            }
          });
        }
        $("#tablaAreas").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
            emptyTable: "Sin datos para mostrar",
          },
          order: [],
          data: areas, // Usar la variable global para los datos
          columns: [
            { data: "NombreArea", className: "text-center" },
            { data: "estatus", className: "text-center" },
            {
                data: null,
                className: "text-center",
                orderable: false,
                render: function (data, type, row) {
                  return `
                    <a class="boton boton-edit" href = "areasEdit.php?id=${row.idArea}">Editar</a>
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
      url: "includes/models/getAreas.php",
      type: "GET",
      dataType: "json",
      data: {key:'2'},
    });
  }
  