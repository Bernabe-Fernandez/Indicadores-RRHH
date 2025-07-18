$(document).ready(function () {
  let empleadosAll;
  let vacantesAll;
  let pendientes;
  let area;
  let total;
  let datos = [];
  obtenerDatos()
    .done(function (vacantes) {
      // console.log(vacantes);
      if (vacantes.mensaje) {
        console.log(vacantes.mensaje);
        vacantes = [];
      }
      vacantesAll = vacantes.allVacantes;
      empleadosAll = vacantes.allEmpleados;
      vacantesAll.forEach((vacante) => {
        datos.push({
          idArea: vacante.idArea,
          area: vacante.NombreArea,
          vacantes: vacante.PAutorizada,
          vacantesActuales: 0,
          vacantesPend: vacante.PAutorizada,
        });
      });
      for (i = 0; i < datos.length; i++) {
        for (j = 0; j < empleadosAll.length; j++) {
          if (datos[i].idArea === empleadosAll[j].Area) {
            datos[i].vacantesActuales = empleadosAll[j].Total;
            datos[i].vacantesPend = datos[i].vacantes - empleadosAll[j].Total;
          }
        }
      }
      //  console.log(datos);
      $("#tablaVacantes").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
          emptyTable: "Sin datos para mostrar",
        },
        order: [],
        data: datos, // Usar la variable global para los datos
        columns: [
          { data: "area", className: "text-center" },
          { data: "vacantes", className: "text-center" },
          { data: "vacantesActuales", className: "text-center" },
          { data: "vacantesPend", className: "text-center" },
          {
            data: null,
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `
                <a class="boton boton-edit" href = "vacantesEdit.php?id=${row.idArea}">Editar</a>
              `;
            },
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
    url: "includes/models/getAllVacantes.php",
    type: "GET",
    dataType: "json",
    data: {pagina:'vacantes'},
  });
}
