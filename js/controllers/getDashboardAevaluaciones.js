  let chartAevaluacion;
  
  $(document).ready(function () {
    //cargamos los eventos
    getAevaluacion(anio);


    $("#anioInforme").change(function (e) { 
      e.preventDefault();
      anio = $("#anioInforme").val();
      getAevaluacion(anio);
    });

  });
  
  function getAevaluacion() {
    const meses = [
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
      let aEvaluaciones = [0,0,0,0,0,0,0,0,0,0,0,0];
    $.ajax({
      url: "includes/models/getEvaluaciones.php",
      type: "GET",
      data: { key: "6", anio: anio},
      success: function (aevaluaciones) {
        if(aevaluaciones.mensaje){          
          // console.log(aevaluaciones.mensaje);
          aEvaluaciones = [0,0,0,0,0,0,0,0,0,0,0,0];
        }else{
          aevaluaciones.forEach((aevaluacion) => {
            let mes = aevaluacion.Mes - 1;
            aEvaluaciones[mes] = aevaluacion.TotalAutoE;
          });
        }
        // console.log(eventos);
        let colores = ["rgb(0, 0, 0)"];
        let tipo = "line";
        crearGraficoAevaluacionD("autoeDesem", aEvaluaciones, colores, tipo, meses);
      },
      error: function (xhr, status, error) {
        console.log(xhr);
        
      },
    });
  }
  
  function crearGraficoAevaluacionD(grafico, datos, colores, tipo, etiquetas) {
    if (chartAevaluacion) {
        chartAevaluacion.destroy();
    }
    let label = etiquetas;
    let idGrafico = grafico;
    let ctx = document.getElementById(idGrafico).getContext("2d");
    chartAevaluacion = new Chart(ctx, {
      type: tipo,
      data: {
        labels: label,
        datasets: [
          {
            label: "Autoevaluación de desempeño",
            data: datos,
            backgroundColor: colores,
          },
        ],
      },
    });
  }
  
  