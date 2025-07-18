  
  let chartPromocionL;
  
  $(document).ready(function () {
    //cargamos los eventos
    getPromocionesL(anio);


    $("#anioInforme").change(function (e) { 
      e.preventDefault();
      anio = $("#anioInforme").val();
      getPromocionesL(anio);
    });

  });
  
  function getPromocionesL(anio) {
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
      let promocionlMes = [0,0,0,0,0,0,0,0,0,0,0,0];
    $.ajax({
      url: "includes/models/getPromociones.php",
      type: "GET",
      data: { key: "3", anio: anio},
      success: function (promociones) {
        // console.log(promociones);
        if(promociones.mensaje){
          // console.log(promociones.mensaje);
          promocionlMes = [0,0,0,0,0,0,0,0,0,0,0,0];
        }else{
          // console.log(promociones);
          promociones.forEach((promocion) => {
            let mes = promocion.Mes - 1;
            promocionlMes[mes] = promocion.TotalProm;
          });

        }
        let colores = ["rgb(0, 0, 0)"];
        let tipo = "line";
        crearGraficoPromocionL("promocionesL", promocionlMes, colores, tipo, meses);
      },
      error: function (xhr, status, error) {
        console.log(xhr);
      },
    });
  }
  
  function crearGraficoPromocionL(grafico, datos, colores, tipo, etiquetas) {
    if (chartPromocionL) {
        chartPromocionL.destroy();
    }
    let label = etiquetas;
    let idGrafico = grafico;
    let ctx = document.getElementById(idGrafico).getContext("2d");
    chartPromocionL = new Chart(ctx, {
      type: tipo,
      data: {
        labels: label,
        datasets: [
          {
            label: "Promociones Laborales",
            data: datos,
            backgroundColor: colores,
          },
        ],
      },
    });
  }
  
  