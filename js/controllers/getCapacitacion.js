$(document).ready(function () {
  obtenerDatos()
    .done(function (capacitaciones) {
      console.log(capacitaciones);
      if (capacitaciones.mensaje) {
        capacitaciones = [];
      }
      $("#capacitacion").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: capacitaciones, // Usar la variable global para los datos
        columns: [
          { data: "Nombre", className: "text-center" },
          { data: "Empleado", className: "text-center" },
          { data: "Fecha", className: "text-center" },
          { data: "NombrePuesto", className: "text-center" },
          { data: "NombreArea", className: "text-center" },
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
    url: "includes/models/getCapacitaciones.php",
    type: "GET",
    dataType: "json",
    data: { pagina: "capacitacion" },
  });
}
