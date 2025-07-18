let chartVacantes;
let areasVacantes= [];

$(document).ready(function () {
  const botonVacantes = $("#filtroVacantes");
  //cargamos las vacantes totales
  getVacantes();
  getFiltroArea();

  botonVacantes.click(function(){
    let filtroArea = $("#areasVacantes");
    // Obtener el valor seleccionado
    let filtro = filtroArea.val();
    if (filtro === "0") {
      getVacantes();
    } else {
      getVacantesArea(filtro);
    }
  });
});

function getVacantes() {
  $.ajax({
    url: "includes/models/getAllVacantes.php",
    type: "GET",
    data: {pagina:"dashboard"},
    success: function (vacantes) {
      let colores = ["rgb(66, 134, 244)", "rgb(74, 135, 72)"];
      let etiquetas = ["Disponibles", "Ocupadas"];
      let tipo = "bar";
      crearGraficoVacantes("vacantes", vacantes, colores, tipo, etiquetas);
    },
  });
}

function getVacantesArea(filtro) {
  $.ajax({
    url: "includes/models/getVacantesArea.php",
    type: "GET",
    dataType: "json",
    data: { area: filtro },
    success: function (vacantes) {
      let chart = 0;
      let colores = ["rgb(66, 134, 244)", "rgb(74, 135, 72)"];
      let etiquetas = ["Disponibles", "Ocupadas"];
      let tipo = "bar";
      crearGraficoVacantes("vacantes", vacantes, colores, tipo, etiquetas);
    },
  });
}

function getFiltroArea() {
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      //crear el select
      areas.forEach((area) => {
        areasVacantes.push({ nombre: area.NombreArea, id: area.idArea });
      });
      crearSelectorFiltro("#areasVacantes", areasVacantes);
    },
  });
}

function crearGraficoVacantes(grafico, datos, colores, tipo, etiquetas) {
  if (chartVacantes) {
    chartVacantes.destroy();
  }
  let label = etiquetas;
  let disponibles = datos["disponibles"];
  let ocupados = datos["ocupados"];
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartVacantes = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: ["Total"],
          data: [disponibles, ocupados],
          backgroundColor: colores
        },
      ],
    },
  });
}


