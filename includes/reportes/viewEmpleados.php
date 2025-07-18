<?php
//creación del archivo pdf para evaluación de desempeño
require_once '../../vendor/autoload.php';

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
      $response = json_decode($_GET['informacion'], true);
}

if($response['Egreso'] === null){
    $response['Egreso'] = 'Vigente';
    $response['MotivoBaja'] = 'Vigente';
    $response['ComentarioEgreso'] = 'Vigente';
}

if($response['Observacion'] === null){
      $response['Observacion'] = 'Sin Observaciones';
}

ob_start();
// var_dump($response);
?>

<!DOCTYPE html>
<html lang="es" id="ReporteD">

<head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Reporte de Empleados</title>
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
                                          <h1>Información Empleados MRG</h1>
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
                                    <td class="titulo">NOMBRE DEL EMPLEADO</td>
                                    <td colspan="3"><?php echo $response['Nombre'] ?></td>
                              </tr>
                              <tr>
                                    <td class="titulo">CURP</td>
                                    <td colspan="3"><?php echo $response['CURP'] ?></td>
                              </tr>
                              <tr>
                                    <td class="titulo">RFC</td>
                                    <td ><?php echo $response['RFC'] ?></td>
                                    <td class="titulo">NSS</td>
                                    <td><?php echo $response['NSS'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="4" class="titulo">DOMICILIO</td>
                              </tr>
                              <tr>
                                    <td colspan="4"><?php echo $response['domicilio'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="2" class="titulo">Contacto de Emergencia</td>
                                    <td colspan="2" class="titulo">Numero Celular</td>
                              </tr>
                              <tr>
                                    <td colspan="2"><?php echo $response['contacto'] ?></td>
                                    <td colspan="2"><?php echo $response['celular'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="2" class="titulo">Área</td>
                                    <td colspan="2" class="titulo">Puesto</td>
                              </tr>
                              <tr>
                                    <td colspan="2" ><?php echo $response['NombreArea'] ?></td>
                                    <td colspan="2"><?php echo $response['NombrePuesto'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="4" class="titulo">Comentarios</td>
                              </tr>
                              <tr>
                                    <td colspan="4"><?php echo $response['Observacion'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="2" class="titulo">Ingreso</td>
                                    <td colspan="2" class="titulo">Antigüedad</td>
                              </tr>
                              <tr>
                                    <td colspan="2"><?php echo $response['Ingreso'] ?></td>
                                    <td colspan="2"><?php echo $response['antiguedad'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="2" class="titulo">Egreso</td>
                                    <td colspan="2" class="titulo">Motivo</td>
                              </tr>
                              <tr>
                                    <td colspan="2"><?php echo $response['Egreso'] ?></td>
                                    <td colspan="2"><?php echo $response['MotivoBaja'] ?></td>
                              </tr>
                              <tr>
                                    <td colspan="4" class="titulo">Comentario Egreso</td>
                              </tr>
                              <tr>
                                    <td colspan="4"><?php echo $response['ComentarioEgreso'] ?></td>
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