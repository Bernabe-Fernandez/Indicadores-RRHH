const mesesEventos = [
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
let eventosMes = [0,0,0,0,0,0,0,0,0,0,0,0];

let chartEventos;

$(document).ready(function () {
  //cargamos los eventos
  getEventos(anio);


  $("#anioInforme").change(function (e) { 
    e.preventDefault();
    anio = $("#anioInforme").val();
    getEventos(anio);
  });
});

function getEventos() {
  $.ajax({
    url: "includes/models/getEventos.php",
    type: "GET",
    data: { pagina: "dashboard", anio: anio},
    success: function (eventos) {
      // console.log(eventos);
      if(eventos.mensaje){
        eventosMes = [0,0,0,0,0,0,0,0,0,0,0,0];
      }
      else{
        eventos.forEach((evento) => {
          let mes = evento.Mes - 1;
          eventosMes[mes] = evento.TotalEventos;
        });
      }
      let colores = ["rgb(0, 0, 0)"];
      let tipo = "line";
      crearGraficoEventos("eventos", eventosMes, colores, tipo, mesesEventos);
    },
    error: function (xhr, status, error) {
      console.log(xhr);
    },
  });
}

function crearGraficoEventos(grafico, datos, colores, tipo, etiquetas) {
  if (chartEventos) {
    chartEventos.destroy();
  }
  let label = etiquetas;
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartEventos = new Chart(ctx, {
    type: tipo,
    data: {
      labels: label,
      datasets: [
        {
          label: "Eventos Totales",
          data: datos,
          backgroundColor: colores,
        },
      ],
    },
  });
}

