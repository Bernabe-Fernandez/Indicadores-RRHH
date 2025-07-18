function obtenerDatos() {
  // Devuelve una Promesa que se resuelve cuando el AJAX termina con éxito
  return $.ajax({
    url: "includes/models/getAllDatosTrue.php",
    type: "GET",
    dataType: "json",
    data: { tabla: "logistica" }, // Parámetro que deseas enviar
  });
}
$(document).ready(function () {
  let textoDiferencia;
  obtenerDatos()
    .done(function (pedidos) {
      pedidos.forEach(pedido => {
        if(pedido['Estatus'] === '1'){
          if(pedido['MedioEnvio'] === 'LOCAL' || pedido['MedioEnvio'] === 'LOCAK'){
            pedido['Local'] = 'ENTREGADO';
            pedido['Foraneo'] = '----';
          }else{
            pedido['Local'] = '----';
            pedido['Foraneo'] = 'EMBARCADO';
          }
        } 
        //DIAS TRANSCURRIDOS
        textoDiferencia = obtenerDiferencia(pedido['FechaPedido'], pedido['FechaEmbarque']);
        pedido['DiasTransc'] = textoDiferencia;
      });
      $("#myTable").DataTable({
        language: {
          url: "https://cdn.datatables.net/plug-ins/2.0.5/i18n/es-ES.json",
        },
        order: [],
        data: pedidos, // Usar la variable global para los datos
        columns: [
          { data: "RazonSocial", className: "text-center" },
          { data: "FolioPedido", className: "text-center" },
          { data: "FechaPedido", className: "text-center" },
          { data: "FechaEmbarque", className: "text-center" },
          { data: "DiasTransc", className: "text-center" },
          { data: "Local", className: "text-center"},
          { data: "Foraneo", className: "text-center"}
        ]
      });
    })
    .fail(function (error) {
      console.error("Error al obtener los datos:", error.responseText); // Manejo de errores
    });
});


function obtenerDiferencia(fechaInicio, fechaFinal) {
  const fechaIni = new Date(fechaInicio);
  const fechaFin= new Date(fechaFinal);
  const diferenciaEnMilisegundos = Math.abs(fechaFin - fechaIni);
  // Calcular la diferencia en años, meses y días
  const fechaAux = new Date(fechaIni);
  let años = fechaFin.getFullYear() - fechaAux.getFullYear();
  fechaAux.setFullYear(fechaAux.getFullYear() + años);
  let meses = fechaFin.getMonth() - fechaAux.getMonth();
  if (meses < 0) {
    años -= 1;
    meses += 12;
  }
  fechaAux.setMonth(fechaAux.getMonth() + meses);
  const diferenciaRestante = Math.abs(fechaFin - fechaAux);
  const dias = Math.ceil(diferenciaRestante / (1000 * 60 * 60 * 24)); // Calcular días restantes
// Generar texto según los valores calculados
if (años === 0 && meses === 0 && dias === 0) {
  return "0 días";
}

let partes = [];
if (años > 0) {
  partes.push(`${años} año${años > 1 ? 's' : ''}`);
}
if (meses > 0) {
  partes.push(`${meses} mes${meses > 1 ? 'es' : ''}`);
}
if (dias > 0) {
  partes.push(`${dias} día${dias > 1 ? 's' : ''}`);
}

// Unir todas las partes con ", "
return partes.join(", ");
}