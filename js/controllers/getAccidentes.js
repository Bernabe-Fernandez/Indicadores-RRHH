$(document).ready(function () {
    obtenerAccidentes()
      .done(function (accidentes) {
        if(accidentes.mensaje){
          console.log(accidentes.mensaje);
          accidentes = [];
        }else{
          accidentes.forEach(accidente => {
              if(accidente['Incapacidad'] === '1'){
                  accidente['Incapacidad'] = 'Si';
              }else{
                  accidente['Incapacidad'] = 'No';
              }
            });
          }
          $("#accidentes").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
            emptyTable: "Sin datos para mostrar",
          },
          order: [],
          lengthChange: false,
          data: accidentes, // Usar la variable global para los datos
          columns: [
            { data: "Nombre", className: "text-center" },
            { data: "NombrePuesto", className: "text-center" },
            { data: "NombreArea", className: "text-center" },
            { data: "Fecha", className: "text-center" },
            { data: "Tipo", className: "text-center" },
            { data: "Incapacidad", className: "text-center" },
          ],
        });
      })
      .fail(function (error) {
        console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
      });
  });
  
  function obtenerAccidentes() {
    // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
    return $.ajax({
      url: "includes/models/getAccidentes.php",
      type: "GET",
      dataType: "json",
      data:{pagina:"accidentes"}
    });
  }