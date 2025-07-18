$(document).ready(function () {
    obtenerDatos()
      .done(function (puestos) {
        // console.log(puestos);
        if(puestos.mensaje){
          console.log(cursos.mensaje);
          puestos = [];
        }
        puestos.forEach(puesto => {
            if(puesto.Estatus === '1'){
                puesto.Estatus = 'Activo';
            }else{
                puesto.Estatus = 'Inactivo';
            }
        });
        $("#tablaPuestos").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
            emptyTable: "Sin datos para mostrar",
          },
          order: [],
          data: puestos, // Usar la variable global para los datos
          columns: [
            { data: "puesto", className: "text-center" },          
            { data: "AREA", className: "text-center" },
            { data: "Estatus", className: "text-center" },
            {
                data: null,
                className: "text-center",
                orderable: false,
                render: function (data, type, row) {
                  return `
                    <a class="boton boton-edit" href = "puestosEdit.php?id=${row.idPuesto}">Editar</a>
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
      url: "includes/models/getPuestos.php",
      type: "GET",
      dataType: "json",
      data: {key:'2'},
    });
  }
  