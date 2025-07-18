$(document).ready(function () {
    obtenerDatos()
      .done(function (eventos) {
        if(eventos.mensaje){
          console.log(eventos.mensaje);
          eventos = [];
        }
        $("#eventos").DataTable({
          language: {
            url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
            emptyTable: "Sin datos para mostrar",
          },
          order: [],
          data: eventos, // Usar la variable global para los datos
          columns: [
            { data: "NombreEvento", className: "text-center" },          
            { data: "Fecha", className: "text-center" }
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
      url: "includes/models/getEventos.php",
      type: "GET",
      dataType: "json",
      data: {pagina : "eventos"}
    });
  }
  