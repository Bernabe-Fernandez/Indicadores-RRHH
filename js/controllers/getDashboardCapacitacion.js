const mesesCapacitacion = [
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
let capacitacionMes = [0,0,0,0,0,0,0,0,0,0,0,0];
let areasCapacitacion = [];
let puestosCapacitacion = [];
let empleadosCapacitacion = [];
let motivosCapacitacion = [];

let chartCapacitacion;

$(document).ready(function () {
  const botonCapacitacion = $("#filtroCapacitacion");
  //cargamos los accidentes
  getCapacitacion(anio);
  getAreasCapacitacion();
  getPuestosCapacitacion();
  getEmpleadosCapacitacion();

  $("#anioInforme").change(function (e) { 
    e.preventDefault();
    anio = $("#anioInforme").val();
    getCapacitacion(anio);
  });


  botonCapacitacion.click(function () {
    let filtroArea = $("#areasCapacitacion").val();
    let filtroPuesto = $("#puestosCapacitacion").val();
    let filtroEmpleado = $("#empleadoCapacitacion").val();
    if (filtroArea != 0) {
      getCapacitacionFiltro(filtroArea, "ar.idArea", anio);
    }else if(filtroPuesto != 0){
      getCapacitacionFiltro(filtroPuesto, "pue.idPuesto", anio);
    }else if(filtroEmpleado != 0){
      getCapacitacionFiltro(filtroEmpleado, "emp.idEmpleado", anio);
    }else{
      getCapacitacion(anio);
    }
  });
});

function getCapacitacion(anio) {
  $.ajax({
    url: "includes/models/getCapacitaciones.php",
    type: "GET",
    data: { pagina: "dashboard", filtro: null, anio: anio },
    success: function (capacitaciones) {
      // console.log(capacitaciones);
      if(capacitaciones.mensaje){
        capacitacionMes = [0,0,0,0,0,0,0,0,0,0,0,0];
      }else{
        capacitaciones.forEach((capacitacion) => {
          let mes = capacitacion.Mes - 1;
          capacitacionMes[mes] = capacitacion.TotalCapacitacion;
        });
      }
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      crearGraficoCapacitacion("capacitacion", capacitacionMes, colores, tipo, mesesCapacitacion);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function getCapacitacionFiltro(filtro, clausula, anio) {
  $.ajax({
    url: "includes/models/getCapacitaciones.php",
    type: "GET",
    data: { pagina: "dashboard", filtro: filtro, clausula: clausula, anio: anio },
    success: function (capacitaciones) {
      // console.log(capacitaciones);
      if (capacitaciones.icono) {
        capacitacionMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      } else {
        capacitaciones.forEach((capacitacion) => {
          console.log(capacitacion);
          let mes = capacitacion.Mes - 1;
          capacitacionMes[mes] = capacitacion.TotalCapacitacion;
        });
        
      }      
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      crearGraficoCapacitacion("capacitacion", capacitacionMes, colores, tipo, mesesCapacitacion);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function crearGraficoCapacitacion(grafico, datos, colores, tipo, etiquetas) {
  if (chartCapacitacion) {
    chartCapacitacion.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartCapacitacion = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: "Capacitaciones Totales",
          data: datos,
          backgroundColor: colores,
        },
      ],
    },
  });
}

//obtener datos de los selectores
function getAreasCapacitacion() {
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      areas.forEach((area) => {
        areasCapacitacion.push({ nombre: area.NombreArea, id: area.idArea });
      });
      crearSelectorFiltro("#areasCapacitacion", areasCapacitacion);
    },
    error: function (xhr, status, error) {
      console.log(xhr );
    },
  });
}

function getPuestosCapacitacion() {
  $.ajax({
    url: "includes/models/getFiltroPuestos.php",
    type: "GET",
    dataType: "json",
    success: function (puestos) {
      puestos.forEach((puesto) => {
        puestosCapacitacion.push({
          nombre: puesto.NombrePuesto,
          id: puesto.idPuesto,
        });
      });
      //crear el select
      crearSelectorFiltro("#puestosCapacitacion", puestosCapacitacion);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function getEmpleadosCapacitacion() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
    data: {key: "2"},
    success: function (empleados) {
      empleados.forEach((empleado) => {
        empleadosCapacitacion.push({
          nombre: empleado.Nombre,
          id: empleado.idEmpleado,
        });
      });
      crearSelectorFiltro("#empleadoCapacitacion", empleadosCapacitacion);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

