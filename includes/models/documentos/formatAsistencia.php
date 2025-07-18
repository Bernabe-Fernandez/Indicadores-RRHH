<?php
//creación del archivo pdf para evaluación de desempeño
require_once '../../../vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_GET)) {
      $datos = array(
            'icono' => 'error',
            'mensaje' => 'No se enviaron datos'
      );
      header('Content-Type: application/json');
      echo json_encode($datos);
      exit;
} else {
      $data = json_decode($_GET['informacion'], true);
}


$response = $data[0];


ob_start();
?>

<!DOCTYPE html>
<html lang="es" id="ReporteD">

<head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Asistencia Interna</title>
      <style>
            body {
                  font-family: 'DejaVu Sans',
                        Arial,
                        sans-serif;
            }

            .cuerpo {
                  width: 725px;
                  height: 950px;
                  margin: 0;
                  padding: 0;
                  border: 1px solid black;
            }

            .titulo table {
                  width: auto;
                  height: auto;
            }

            .titulo table tbody tr td h1 {
                  font-size: 21px;
                  padding: 15px
            }

            .titulo table tbody tr td img {
                  width: 250px;
                  height: auto;
                  margin-left: 50px;
            }

            table {
                  border-collapse: collapse;
                  /* Colapsar los bordes para evitar doble línea */
            }

            .description {
                  margin: 0 10px;
            }

            .description table {
                  width: 100%;
            }

            .description table tbody tr td {
                  font-size: 14px;
                  border: 1px solid black;
                  width: 125px;
                  height: 20px;
                  padding: 10px;
            }

            .description table tbody tr td.titulo{
                text-align: center;
                background-color: gray;
                color: white;
                font-weight: bold;
            }
      </style>
</head>

<body>
      <div class="cuerpo">
            <div class="titulo">
                  <table>
                        <tbody>
                              <tr>
                                    <td>
                                          <h1>Asistencia Interna OBS</h1>
                                    </td>
                                    <td>
                                          <img src="http://localhost:8080/rrhhmorgall/img/logo.png" alt="icono" />
                                    </td>
                              </tr>
                        </tbody>
                  </table>
            </div>

            <div class="description">
                  <table>
                        <tbody>
                              <tr>
                                    <td class="titulo">ORGANIZADOR</td>
                                    <td colspan="3"><?php echo $response['nombreGerente'] ?></td>
                              </tr>
                              <tr>
                                    <td class="titulo">AREA</td>
                                    <td><?php echo $response['nombreArea'] ?></td>
                                    <td class="titulo">PERIODO</td>
                                    <td><?php echo $response['nombrePeriodo'] ?></td>
                              </tr>
                              <tr>
                                    <td class="titulo">FECHA</td>
                                    <td ><?php echo $response['fecha'] ?></td>
                                    <td class="titulo">HORA</td>
                                    <td><?php echo $response['hora'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="4" class="titulo">ASISTENTES</td>
                              </tr>
                              <tr>
                                    <td colspan="4"><?php echo $response['asistentes'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="4" class="titulo">TEMAS</td>
                              </tr>
                              <tr>
                                    <td colspan="4"><?php echo $response['temas'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="4" class="titulo">OBSERVACIONES/COMENTARIOS</td>
                              </tr>
                              <tr>
                                    <td colspan="4"><?php echo $response['notas'] ?></td>
                              </tr>
                              
                        </tbody>
                  </table>
            </div>
      </div>
</body>

</html>

<?php
// creación del pdf
$contenidoReporte = ob_get_clean();
$dompdf = new Dompdf();

// echo $contenidoReporte;
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($contenidoReporte);
// $dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('Carta');
$dompdf->render();
$pdf_content = $dompdf->output();

header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="reporte_empleado.pdf"');
header('Content-Length: ' . strlen($pdf_content));
echo $pdf_content;

?>