let chartRelacionJ, chartRelacionD, chartRelacionG, chartApoyo, chartApoyar, chartComodo, chartClimaL, chartEsfuerzoF, chartAccidente, chartPeligros, chartTextra, chartTrabajarsp, chartTrabajarAc, chartConcentrado, chartMemorizar, chartVasuntos, chartAcosoL, chartSucesoL;
$(document).ready(function () {
  let anio = $("#anioClima").val();

  aRelacionJ = [0, 0, 0, 0];
  aRelacionD = [0, 0, 0, 0];
  aRelacionG = [0, 0, 0, 0];
  aApoyo = [0, 0, 0, 0];
  aApoyar = [0, 0, 0, 0];
  aComodo = [0, 0];
  aClimaL = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
  aGustoC = [];
  aDisgustoC = [];
  aMejora = [];
  aEsfuerzo = [0,0,0,0];
  aAccidente = [0,0,0,0];
  aActPeligrosa = [0,0,0,0];
  aTiempoExt = [0,0,0,0];
  aTrabajarSp = [0,0,0,0];
  aTrabajarAc = [0,0,0,0];
  aConcentrado = [0,0,0,0];
  aMemorizarInf = [0,0,0,0];
  aVariosAsu = [0,0,0,0];
  aAcosoL = [0,0];
  aAcosoEsp = [];
  aSucesoLab = [0,0];
  aSucesoEsp = [];
  
  crearClimaL(anio);

  $("#anioClima").change(function (e) { 
    e.preventDefault();
    let anio = $("#anioClima").val();
    aRelacionJ = [0, 0, 0, 0];
    aRelacionD = [0, 0, 0, 0];
    aRelacionG = [0, 0, 0, 0];
    aApoyo = [0, 0, 0, 0];
    aApoyar = [0, 0, 0, 0];
    aComodo = [0, 0];
    aClimaL = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    aGustoC = [];
    aDisgustoC = [];
    aMejora = [];
    aEsfuerzo = [0,0,0,0];
    aAccidente = [0,0,0,0];
    aActPeligrosa = [0,0,0,0];
    aTiempoExt = [0,0,0,0];
    aTrabajarSp = [0,0,0,0];
    aTrabajarAc = [0,0,0,0];
    aConcentrado = [0,0,0,0];
    aMemorizarInf = [0,0,0,0];
    aVariosAsu = [0,0,0,0];
    aAcosoL = [0,0];
    aAcosoEsp = [];
    aSucesoLab = [0,0];
    aSucesoEsp = [];
    crearClimaL(anio);
  });

});


function crearClimaL(anio){    
  let total = 0;
  obtenerClimaL(anio)
    .done(function (climaL) {
      if (climaL.mensaje) {
        // console.log(climaL.mensaje);
        climaL = [];
      }
      // console.log(climaL);
      climaL.forEach((respuesta) => {
        //creación de los arreglos para mostrar las graficas
        if (respuesta.relacionJ) {
          posicion = respuesta.relacionJ - 1;
          // console.log(posicion);
          aRelacionJ[posicion] = aRelacionJ[posicion] + 1;
        }
        if (respuesta.relacionD) {
          posicion = respuesta.relacionD - 1;
          // console.log(posicion);
          aRelacionD[posicion] = aRelacionD[posicion] + 1;
        }
        if (respuesta.relacionG) {
          posicion = respuesta.relacionG - 1;
          // console.log(posicion);
          aRelacionG[posicion] = aRelacionG[posicion] + 1;
        }
        if (respuesta.apoyo) {
          posicion = respuesta.apoyo - 1;
          // console.log(posicion);
          aApoyo[posicion] = aApoyo[posicion] + 1;
        }
        if (respuesta.apoyar) {
          posicion = respuesta.apoyar - 1;
          // console.log(posicion);
          aApoyar[posicion] = aApoyar[posicion] + 1;
        }
        if (respuesta.comodo) {
          posicion = respuesta.comodo - 1;
          // console.log(posicion);
          aComodo[posicion] = aComodo[posicion] + 1;
        }
        if (respuesta.climaL) {
          posicion = respuesta.climaL - 1;
          // console.log(posicion);
          aClimaL[posicion] = aClimaL[posicion] + 1;
        }
        if(respuesta.esfuerzoF){
          posicion = respuesta.esfuerzoF - 1;
          // console.log(posicion);
          aEsfuerzo[posicion] = aEsfuerzo[posicion] + 1;
        }
        if(respuesta.accidenteT){
          posicion = respuesta.accidenteT - 1;
          // console.log(posicion);
          aAccidente[posicion] = aAccidente[posicion] + 1;
        }
        if(respuesta.actPeligrosas){
          posicion = respuesta.actPeligrosas - 1;
          // console.log(posicion);
          aActPeligrosa[posicion] = aActPeligrosa[posicion] + 1;
        }
        if(respuesta.tiempoEx){
          posicion = respuesta.tiempoEx - 1;
          // console.log(posicion);
          aTiempoExt[posicion] = aTiempoExt[posicion] + 1;
        }
        if(respuesta.trabajarSp){
          posicion = respuesta.trabajarSp - 1;
          // console.log(posicion);
          aTrabajarSp[posicion] = aTrabajarSp[posicion] + 1;
        }
        if(respuesta.trabajoAc){
          posicion = respuesta.trabajoAc - 1;
          // console.log(posicion);
          aTrabajarAc[posicion] = aTrabajarAc[posicion] + 1;
        }
        if(respuesta.concentrado){
          posicion = respuesta.concentrado - 1;
          // console.log(posicion);
          aConcentrado[posicion] = aConcentrado[posicion] + 1;
        }
        if(respuesta.memorizarInf){
          posicion = respuesta.memorizarInf - 1;
          // console.log(posicion);
          aMemorizarInf[posicion] = aMemorizarInf[posicion] + 1;
        }
        if(respuesta.variosAsu){
          posicion = respuesta.variosAsu - 1;
          // console.log(posicion);
          aVariosAsu[posicion] = aVariosAsu[posicion] + 1;
        }
        if(respuesta.acosoL){
          posicion = respuesta.acosoL - 1;
          // console.log(posicion);
          aAcosoL[posicion] = aAcosoL[posicion] + 1;
        }
        if(respuesta.sucesoLab){
          posicion = respuesta.sucesoLab - 1;
          // console.log(posicion);
          aSucesoLab[posicion] = aSucesoLab[posicion] + 1;
        }
        if(respuesta.gustoC){
          aGustoC.push(respuesta.gustoC);
        }
        if(respuesta.disgustoC){
          aDisgustoC.push(respuesta.disgustoC);
        }
        if(respuesta.mejoras){
          aMejora.push(respuesta.mejoras);
        }
        if(respuesta.acosoEsp){
          aAcosoEsp.push(respuesta.acosoEsp);
        }
        if(respuesta.sucesoEsp){
          aSucesoEsp.push(respuesta.sucesoEsp);
        }
        total = total + 1;
      });
      crearTablaRespuestas("#mejorar", aMejora);      
      crearTablaRespuestas("#gustoC", aGustoC);      
      crearTablaRespuestas("#disgustoC", aDisgustoC);      
      crearTablaRespuestas("#acosoEsp", aAcosoEsp);      
      crearTablaRespuestas("#sucesoEsp", aSucesoEsp);      
      crearGraficoRjefe("relacionJ", aRelacionJ, total);      
      crearGraficoRdepa("relacionD", aRelacionD, total);      
      crearGraficoRgral("relacionG", aRelacionG, total);
      crearGraficoApoyo("apoyo", aApoyo, total);
      crearGraficoApoyar("apoyar", aApoyar, total);
      crearGraficoComodo("comodo", aComodo, total);
      crearGraficoClimaL("climaL", aClimaL, total);
      crearGraficoEsfuerzoF("esfuerzo", aEsfuerzo, total);
      crearGraficoAccidente("accidente", aAccidente, total);
      crearGraficoPeligros("actividad", aActPeligrosa, total);
      crearGraficoTextra("tiempoExt", aTiempoExt, total);
      crearGraficoTrabajoSp("trabajarSp", aTiempoExt, total);
      crearGraficoTrabajoAc("trabajarAc", aTrabajarAc, total);
      crearGraficoConcentrado("concentrado", aTrabajarAc, total);
      crearGraficoMemorizar("memorizarinfo", aMemorizarInf, total);
      crearGraficoVariosAsu("variosAsu", aVariosAsu, total);
      crearGraficoAcosoL("acosoL", aAcosoL, total);
      crearGraficoSucesoL("sucesoLab", aSucesoLab, total);
      // console.log(total);
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
}

function obtenerClimaL(anio) {

  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getClimaLabo.php",
    type: "GET",
    data: {anio: anio},
    dataType: "json",
  });
}


//funciones para crear graficas
function crearGraficoRjefe(grafico, datos, total) {
  if (chartRelacionJ) {
    chartRelacionJ.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartRelacionJ = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["Mala", "Indiferente", "Regular", "Buena"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}


function crearGraficoRdepa(grafico, datos, total) {
  if (chartRelacionD) {
    chartRelacionD.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartRelacionD = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["Mala", "Indiferente", "Regular", "Buena"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoRgral(grafico, datos, total) {
  if (chartRelacionG) {
    chartRelacionG.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartRelacionG = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["Mala", "Indiferente", "Regular", "Buena"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoApoyo(grafico, datos, total) {
  if (chartApoyo) {
    chartApoyo.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartApoyo = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "En ocasiones", "A veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoApoyar(grafico, datos, total) {
  if (chartApoyar) {
    chartApoyar.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartApoyar = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Depende", "A veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoComodo(grafico, datos, total) {
  if (chartComodo) {
    chartComodo.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartComodo = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoClimaL(grafico, datos, total) {
  if (chartClimaL) {
    chartClimaL.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartClimaL = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["1","2","3","4","5","6","7","8","9","10",],
      datasets: [
        {
          label: "Clima Laboral",
          data: datos,
          backgroundColor: [
            "rgb(63, 60, 252)"
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "end",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoEsfuerzoF(grafico, datos, total) {
  if (chartEsfuerzoF) {
    chartEsfuerzoF.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartEsfuerzoF = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoAccidente(grafico, datos, total) {
  if (chartAccidente) {
    chartAccidente.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartAccidente = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoPeligros(grafico, datos, total) {
  if (chartPeligros) {
    chartPeligros.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartPeligros = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value + "%";
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoTextra(grafico, datos, total) {
  if (chartTextra) {
    chartTextra.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartTextra = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              if(value === 0){
                return "";
              }else{              
                value = ((value * 100) / total).toFixed(2);
                return value + "%";
              }
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoTrabajoSp(grafico, datos, total) {
  if (chartTrabajarsp) {
    chartTrabajarsp.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartTrabajarsp = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              if(value === 0){
                return "";
              }else{              
                value = ((value * 100) / total).toFixed(2);
                return value + "%";
              }
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoTrabajoAc(grafico, datos, total) {
  if (chartTrabajarAc) {
    chartTrabajarAc.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartTrabajarAc = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              if(value === 0){
                return "";
              }else{              
                value = ((value * 100) / total).toFixed(2);
                return value + "%";
              }
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoConcentrado(grafico, datos, total) {
  if (chartConcentrado) {
    chartConcentrado.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartConcentrado = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value;
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoMemorizar(grafico, datos, total) {
  if (chartMemorizar) {
    chartMemorizar.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartMemorizar = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              if(value === 0){
                return "";
              }else{              
                value = ((value * 100) / total).toFixed(2);
                return value + "%";
              }
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoVariosAsu(grafico, datos, total) {
  if (chartVasuntos) {
    chartVasuntos.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartVasuntos = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No", "Casi Nunca", "La mayoria de veces", "Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(252, 249, 60)",
            "rgb(86, 252, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              value = ((value * 100) / total).toFixed(2);
              return value;
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoAcosoL(grafico, datos, total) {
  if (chartAcosoL) {
    chartAcosoL.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartAcosoL = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No","Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              if(value === 0){
                return "";
              }else{              
                value = ((value * 100) / total).toFixed(2);
                return value + "%";
              }
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearGraficoSucesoL(grafico, datos, total) {
  if (chartSucesoL) {
    chartSucesoL.destroy();
  }
  let idGrafico = grafico;
  let ctx = document.getElementById(idGrafico).getContext("2d");
  chartSucesoL = new Chart(ctx, {
    type: "pie",
    data: {
      labels: ["No","Si"],
      datasets: [
        {
          data: datos,
          backgroundColor: [
            "rgb(252, 60, 60)",
            "rgb(63, 60, 252)",
          ],
        },
      ],
    },
    options: {
      plugins: {
        datalabels: {
          color: "#000",
          anchor: "end",
          align: "start",
          formatter: (value, context) => {
            if(value === 0){
              return "";
            }else{              
              if(value === 0){
                return "";
              }else{              
                value = ((value * 100) / total).toFixed(2);
                return value + "%";
              }
            }
          },
        },
      },
    },
    plugins: [ChartDataLabels],
  });
}

function crearTablaRespuestas(tabla, datos){
  $(tabla).find('tbody').empty();
  if (datos.length === 0) {
    var tbody = $('<tbody></tbody>');
    tbody.append('<tr><td>' + "No hay datos" + '</td></tr>');
    $(tabla).append(tbody);
  } else {
    // Si hay datos, recorre el array y agrega las filas a la tabla
    datos.forEach(respuesta => {
      var tbody = $('<tbody></tbody>');
      tbody.append('<tr><td>' + respuesta + '</td></tr>');  // Asegúrate de usar <tr> para cada fila
      $(tabla).append(tbody);
    });
  }
}