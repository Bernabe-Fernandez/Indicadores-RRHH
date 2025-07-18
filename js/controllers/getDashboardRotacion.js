let areasRotacion = [];
let totalRotacion = [];
let totalAltas = [];
let areasAltas = [];
let totalBajas = [];
let areasBajas = [];

let chartRotacion;
let chartAltas;
let chartBajas;

$(document).ready(function () {
  const botonRotacion = $("#filtroRotacion");
  getAreasRotacion();
  getRotaciones(ejecutarCallback, anio);
  getAltas(anio);
  getBajas(anio);

  
  $("#anioInforme").change(function (e) { 
    e.preventDefault();
    anio = $("#anioInforme").val();
    faltasMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    getRotaciones(ejecutarCallback, anio);
    getAltas(anio);
    getBajas(anio);
  });

  botonRotacion.click(function () {
    faltasMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    let filtroArea = $("#areasRotacion").val();
    if (filtroArea != 0) {
      // console.log(filtroArea);
      getRotacionFiltro(filtroArea, ejecutarCallback, anio);
      // getFaltasFiltro(filtroArea, "areasmrg.idArea");
    } else {
      getRotaciones(ejecutarCallback, anio);
    }
  });
});

function getRotaciones(callback, anio) {
  totalRotacion = [];
  // Primera petición AJAX
  let peticionBajas = $.ajax({
    url: "includes/models/getRotacion.php",
    method: "GET",
    dataType: "json",
    data: { opcion: "dashboardBajas", anio: anio },
  });

  // Segunda petición AJAX
  let peticionAltas = $.ajax({
    url: "includes/models/getRotacion.php",
    method: "GET",
    dataType: "json",
    data: { opcion: "dashboardAltas", anio: anio },
  });
  // Usar $.when para manejar ambas peticiones
  $.when(peticionBajas, peticionAltas)
    .done(function (bajas, altas) {
      let totalBajas = bajas[0].TotalBajas;
      let totalAltas = altas[0].TotalAltas;

      totalRotacion.push(totalAltas);
      totalRotacion.push(totalBajas);

      if (callback) callback();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      // Manejo de errores
      console.error("Error en la petición:", textStatus, errorThrown);
    });
}

function getAreasRotacion() {
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      areas.forEach((area) => {
        areasRotacion.push({ nombre: area.NombreArea, id: area.idArea });
      });
      crearSelectorFiltro("#areasRotacion", areasRotacion);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getRotacionFiltro(area, callback, anio) {
  totalRotacion = [];
  // Primera petición AJAX
  var peticionBajas = $.ajax({
    url: "includes/models/getRotacion.php",
    method: "GET",
    dataType: "json",
    data: { opcion: "filtroBajas", area: area, anio: anio},
  });

  // Segunda petición AJAX
  var peticionAltas = $.ajax({
    url: "includes/models/getRotacion.php",
    method: "GET",
    dataType: "json",
    data: { opcion: "filtroAltas", area: area, anio: anio },
  });

  // Usar $.when para manejar ambas peticiones
  $.when(peticionBajas, peticionAltas)
    .done(function (bajas, altas) {
      
      let totalBajas = bajas[0].TotalBajas;
      let totalAltas = altas[0].TotalAltas;

      totalRotacion.push(totalAltas);
      totalRotacion.push(totalBajas);

      // console.log(totalRotacion);

      if (callback) callback();
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
      // Manejo de errores
      console.error("Error en la petición:", textStatus, errorThrown);
    });
}

function ejecutarCallback() {
  let colores = ["rgb( 42, 68, 255 )", "rgb( 255, 42, 42 )"];
  let tipo = "bar";
  let etiquetas = ["Altas", "Bajas"];
  crearGraficoRotacion("rotacion", totalRotacion, colores, tipo, etiquetas);
}

function getAltas(anio){
  totalAltas = [];
  areasAltas = [];
  $.ajax({
    type: "GET",
    url: "includes/models/getRotacion.php",
    dataType: "json",
    data: { opcion: "graficaAltas", anio: anio },
    success: function (response) {
      // console.log(response);
      response.forEach(dato => {
        totalAltas.push(dato.total_altas);
        areasAltas.push(dato.AREA);
      });
      tipo = "bar";
      crearGraficoAltas("altas", totalAltas, tipo, areasAltas);
    },
    error: function (xhr, status, error) {
        console.log(xhr);
    },
  });
}

function getBajas(anio){
  totalBajas = [];
  areasBajas = [];
  $.ajax({
    url: "includes/models/getRotacion.php",
    method: "GET",
    dataType: "json",
    data: { opcion: "graficaBajas", anio: anio },
    success: function (response) {
      // console.log(response);
      response.forEach(dato => {
        totalBajas.push(dato.total_bajas);
        areasBajas.push(dato.AREA);
      });
      tipo = "bar";
      crearGraficoBajas("bajas", totalBajas, tipo, areasBajas);
    },
    error: function (xhr, status, error) {
        console.log(xhr);
    },
  });
}

//crear graficos
function crearGraficoRotacion(grafico, datos, colores, tipo, etiquetas) {
  if (chartRotacion) {
    chartRotacion.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartRotacion = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: ["Totales"],
          data: datos,
          backgroundColor: ["rgb( 42, 68, 255 )", "rgb( 255, 42, 42 )"],
        },
      ],
    },
  });
}

function crearGraficoAltas(grafico, datos, tipo, etiquetas) {
  if (chartAltas) {
    chartAltas.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartAltas = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: ["Totales"],
          data: datos,
          backgroundColor: ["rgb( 42, 68, 255 )"],
        },
      ],
    },
  });
}

function crearGraficoBajas(grafico, datos, tipo, etiquetas) {
  // console.log(datos);
  if (chartBajas) {
    chartBajas.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartBajas = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: ["Totales"],
          data: datos,
          backgroundColor: ["rgb( 255, 42, 42 )"],
        },
      ],
    },
  });
}