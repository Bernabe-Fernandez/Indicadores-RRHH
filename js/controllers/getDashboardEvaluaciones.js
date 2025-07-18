  
  let chartEdesempeno;
  
  $(document).ready(function () {
    //cargamos los eventos
    getEvaluacionD(anio);


    $("#anioInforme").change(function (e) { 
      e.preventDefault();
      anio = $("#anioInforme").val();
      getEvaluacionD(anio);
    });


  });
  
  function getEvaluacionD(anio) {
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
      let eDesempenoMes = [0,0,0,0,0,0,0,0,0,0,0,0];
    $.ajax({
      url: "includes/models/getEvaluaciones.php",
      type: "GET",
      data: { key: "5", anio: anio},
      success: function (evaluaciones) {
        // console.log(evaluaciones);
        if(evaluaciones.mensaje){
          // console.log(evaluaciones.mensaje);
          eDesempenoMes = [0,0,0,0,0,0,0,0,0,0,0,0];
        }else{
          evaluaciones.forEach((evaluacion) => {
            let mes = evaluacion.Mes - 1;
            eDesempenoMes[mes] = evaluacion.TotalEva;
          });
        }
        let colores = ["rgb(63, 60, 252)"];
        let tipo = "line";
        crearGraficoEvaluacionD("eDesempeno", eDesempenoMes, colores, tipo, meses);
      },
      error: function (xhr, status, error) {
        console.log(xhr);
      },
    });
  }
  
  function crearGraficoEvaluacionD(grafico, datos, colores, tipo, etiquetas) {
    if (chartEdesempeno) {
        chartEdesempeno.destroy();
    }
    let label = etiquetas;
    let idGrafico = grafico;
    let ctx = document.getElementById(idGrafico).getContext("2d");
    chartEdesempeno = new Chart(ctx, {
      type: tipo,
      data: {
        labels: label,
        datasets: [
          {
            label: "Evaluacion de Desempeño",
            data: datos,
            backgroundColor: colores,
          },
        ],
      },
    });
  }
  
  