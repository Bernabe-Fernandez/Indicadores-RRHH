const mesesAccidente = [
  "Enero",
  "Febrero",
  "Marzo",
  "Abril",
  "Mayo",
  "Junio",
  "Julio",
  "Agosto",
  "Septiembre",
  "Octubre",
  "Noviembre",
  "Diciembre",
];
let accidentesMes = [0,0,0,0,0,0,0,0,0,0,0,0];
let areasAccidentes = [];
let puestosAccidentes = [];
let empleadosAccidentes = [];
let motivosAccidentes = [];

let chartAccidente;

$(document).ready(function () {
  const botonAccidente = $("#filtroAccidente");

  anio = $("#anioInforme").val();
  getAccidentes(anio);
  getAreasAccidente();
  getPuestosAccidente();
  getEmpleadosAccidente();

  $("#anioInforme").change(function (e) { 
    e.preventDefault();
    accidentesMes=[0,0,0,0,0,0,0,0,0,0,0,0];
    anio = $("#anioInforme").val();
    getAccidentes(anio);
  });

  botonAccidente.click(function () {
    let filtroArea = $("#areasAccidente").val();
    if (filtroArea != 0) {
      getAccidenteFiltro(filtroArea, "areasmrg.idArea", anio);
    }else{
      getAccidentes(anio);
    }
  });
});


function getAccidentes(anio) {
  // console.log(anio)
  $.ajax({
    url: "includes/models/getAccidentes.php",
    type: "GET",
    data: { pagina: "dashboard", filtro: null, anio: anio},
    success: function (accidentes) {
      if(accidentes.mensaje){
        accidentesMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }else{
        accidentes.forEach((accidente) => {
          let mes = accidente.Mes - 1;
          accidentesMes[mes] = accidente.TotalAccidente;
        });
      }
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      crearGraficoAccidente("accidentes", accidentesMes, colores, tipo, mesesAccidente);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function getAccidenteFiltro(filtro, clausula, anio) {
  $.ajax({
    url: "includes/models/getAccidentes.php",
    type: "GET",
    data: { pagina: "dashboard", filtro: filtro, clausula: clausula, anio: anio },
    success: function (accidentes) {
      if (accidentes.mensaje) {
        accidentesMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      } else {
        accidentes.forEach((accidente) => {
          // console.log(accidente);
          let mes = accidente.Mes - 1;
          accidentesMes[mes] = accidente.TotalAccidente;
        });
      }      
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      crearGraficoAccidente("accidentes", accidentesMes, colores, tipo, mesesAccidente);
    },
    error: function (xhr, status, error) {
      console.log("Error en los accidentes" . xhr);
    },
  });
}

function crearGraficoAccidente(grafico, datos, colores, tipo, etiquetas) {
  if (chartAccidente) {
    chartAccidente.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartAccidente = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: "Accidentes Totales",
          data: datos,
          backgroundColor: colores,
        },
      ],
    },
  });
}

//obtener datos de los selectores
function getAreasAccidente() {
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      areas.forEach((area) => {
        areasAccidentes.push({ nombre: area.NombreArea, id: area.idArea });
      });
      crearSelectorFiltro("#areasAccidente", areasAccidentes);
    },
    error: function (xhr, status, error) {
      console.log(xhr );
    },
  });
}

function getPuestosAccidente() {
  $.ajax({
    url: "includes/models/getFiltroPuestos.php",
    type: "GET",
    dataType: "json",
    success: function (puestos) {
      puestos.forEach((puesto) => {
        puestosAccidentes.push({
          nombre: puesto.NombrePuesto,
          id: puesto.idPuesto,
        });
      });
      //crear el select
      crearSelectorFiltro("#puestosAccidente", puestosAccidentes);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function getEmpleadosAccidente() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
    data: {key: "2"},
    success: function (empleados) {
      empleados.forEach((empleado) => {
        empleadosAccidentes.push({
          nombre: empleado.Nombre,
          id: empleado.idEmpleado,
        });
      });
      crearSelectorFiltro("#empleadoAccidente", empleadosAccidentes);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

