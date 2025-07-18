const mesesNombre = [
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
let faltasMes = [0,0,0,0,0,0,0,0,0,0,0,0];
let areasFaltas = [];
let puestosFaltas = [];
let empleadosFaltas = [];
let motivosFaltas = [];

let chartFaltas;

$(document).ready(function () {
  const botonFaltas = $("#filtroFaltas");
  //cargamos las faltas

  getFaltas(anio);
  getAreasFaltas();
  getPuestosFaltas();
  getEmpleadosFaltas();
  getMotivosFaltas();


  $("#anioInforme").change(function (e) { 
    e.preventDefault();
    anio = $("#anioInforme").val();
    getFaltas(anio);
  });

  botonFaltas.click(function () {
    faltasMes=[0,0,0,0,0,0,0,0,0,0,0,0];
    let filtroArea = $("#areasFaltas").val();
    let filtroPuesto = $("#puestosFaltas").val();
    let filtroEmpleado = $("#empleadoFaltas").val();
    let filtroMotivos = $("#motivosFaltas").val();
    if (filtroArea != 0) {
      getFaltasFiltro(filtroArea, "areasmrg.idArea", anio);
    }else if(filtroPuesto != 0){
      getFaltasFiltro(filtroPuesto, "puestos.idPuesto", anio);
    }else if(filtroEmpleado != 0){
      getFaltasFiltro(filtroEmpleado, "empleados.idEmpleado", anio);
    }else if(filtroMotivos !=0){
      getFaltasFiltro(filtroMotivos, "motivosfalta.idMotivoFalta", anio);
    }else{
      getFaltas(anio);
    }
  });
});

function getFaltas(anio) {
  $.ajax({
    url: "includes/models/getAllFaltas.php",
    type: "GET",
    data: { pagina: "dashboard", filtro: null, anio: anio},
    success: function (faltas) {
      if(faltas.mensaje){
        faltasMes = [0,0,0,0,0,0,0,0,0,0,0,0];
      }else{
        faltas.forEach((falta) => {
          let mes = falta.Mes - 1;
          faltasMes[mes] = falta.TotalFaltas;
        });
      }
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      crearGraficoFaltas("faltas", faltasMes, colores, tipo, mesesNombre);
    },
    error: function (xhr, status, error) {
      alerta(error);
    },
  });
}

function getFaltasFiltro(filtro, clausula) {
  $.ajax({
    url: "includes/models/getAllFaltas.php",
    type: "GET",
    data: { pagina: "dashboard", filtro: filtro, clausula: clausula, anio: anio },
    success: function (faltas) {
      if (faltas.icono) {
        faltasMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      } else {
        faltas.forEach((falta) => {
          let mes = falta.Mes - 1;
          faltasMes[mes] = falta.TotalFaltas;
        });
      }      
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      console.log(faltasMes);
      crearGraficoFaltas("faltas", faltasMes, colores, tipo, mesesNombre);
    },
    error: function (xhr, status, error) {
      alerta(error);
    },
  });
}

function crearGraficoFaltas(grafico, datos, colores, tipo, etiquetas) {
  if (chartFaltas) {
    chartFaltas.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartFaltas = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: "Ausencias Totales",
          data: datos,
          backgroundColor: colores,
        },
      ],
    },
  });
}

//obtener datos de los selectores
function getAreasFaltas() {
  $.ajax({
    url: "includes/models/getFiltroAreas.php",
    type: "GET",
    dataType: "json",
    success: function (areas) {
      areas.forEach((area) => {
        areasFaltas.push({ nombre: area.NombreArea, id: area.idArea });
      });
      crearSelectorFiltro("#areasFaltas", areasFaltas);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getPuestosFaltas() {
  $.ajax({
    url: "includes/models/getFiltroPuestos.php",
    type: "GET",
    dataType: "json",
    success: function (puestos) {
      puestos.forEach((puesto) => {
        puestosFaltas.push({
          nombre: puesto.NombrePuesto,
          id: puesto.idPuesto,
        });
      });
      //crear el select
      crearSelectorFiltro("#puestosFaltas", puestosFaltas);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getEmpleadosFaltas() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  $.ajax({
    url: "includes/models/getEmpleados.php",
    type: "GET",
    dataType: "json",
    data: {key: "2"},
    success: function (empleados) {
      empleados.forEach((empleado) => {
        empleadosFaltas.push({
          nombre: empleado.Nombre,
          id: empleado.idEmpleado,
        });
      });
      crearSelectorFiltro("#empleadoFaltas", empleadosFaltas);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}

function getMotivosFaltas() {
  $.ajax({
    url: "includes/models/getMotivos.php",
    type: "GET",
    dataType: "json",
    success: function (motivos) {
      motivos.forEach((motivo) => {
        motivosFaltas.push({
          nombre: motivo.NombreMotivo,
          id: motivo.idMotivoFalta,
        });
      });
      crearSelectorFiltro("#motivosFaltas", motivosFaltas);
    },
    error: function (xhr, status, error) {
      console.log(error);
    },
  });
}
