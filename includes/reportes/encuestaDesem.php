<?php
//llamar librerias de dompdf
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
// var_dump($response);
$contadorPuntos = [0, 0, 0, 0, 0];
ob_start();
?>

<!DOCTYPE html>
<html lang="es" id="ReporteD">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Evaluación de Desempeño</title>
  <style>
    body {
      font-family: 'DejaVu Sans', Arial, sans-serif;
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
      font-size: 20px;
    }

    .titulo table tbody tr td img {
      width: 250px;
      height: auto;
      margin-left: 120px;
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
      font-size: 13px;
      border: 1px solid black;
      width: 170px;
      height: 30px;
    }

    .caracteristicas {
      width: auto;
      background-color: rgb(87, 136, 251);
      border: 1px solid black;
      margin: 0 10px;
      color: #fff;
      text-align: center;
    }

    .caracteristicas h3 {
      padding: 5px;
      margin: 0;
    }

    .evaluacion {
      width: auto;
      height: auto;
      margin: 0 10px;
    }

    .evaluacion table {
      width: 100%;
    }

    .evaluacion table thead {
      font-size: 12px;
      text-align: center;
    }

    .evaluacion table thead tr th {
      padding: 4px;
      min-width: 100px;
      border: 1px solid black;
    }

    .evaluacion table tbody {
      font-size: 12px;
    }

    .evaluacion table tbody tr td {
      border: 1px solid black;
      text-align: center;
    }

    .evaluacion table tbody tr td.not-center {
      text-align: left;
    }

    .objetivos {
      margin: 0 10px;
      background-color: rgb(87, 136, 251);
    }

    .objetivos table {
      width: 100%;
    }

    .objetivos table tbody tr {
      text-align: center;
    }

    .objetivos table tbody tr td {
      border: 1px solid black;
    }

    .objetivos table tbody tr td.txt-objetivos {
      background-color: #fff;
      height: 70px;
      font-size: 12PX;
    }

    .objetivos table tbody tr td h3 {
      margin: 5px;
      color: #fff;
    }

    .pie-doc {
      margin: 0 10px;
    }

    .pie-doc table {
      width: 100%;
    }

    .pie-doc table thead tr th {
      text-align: center;
      border: 1px solid black;
      width: 80px;
    }

    .pie-doc table tbody tr td {
      border: 1px solid black;
      text-align: center;
      width: 80px;
      height: 50px;
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
              <h1>EVALUACIÓN DE DESEMPEÑO</h1>
            </td>
            <td>
              <img src="http://localhost:8080/rrhhmorgall/img/logo.png" alt="icono" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="description" id="description">
      <table>
        <tbody>
          <tr>
            <td>NOMBRE DEL EMPLEADO</td>
            <td><?php echo $response['Nombre']; ?></td>
            <td>DEPARTAMENTO</td>
            <td><?php echo $response['NombreArea']; ?></td>
          </tr>
          <tr>
            <td>PUESTO</td>
            <td><?php echo $response['NombrePuesto']; ?></td>
            <td>JEFE DIRECTO</td>
            <td><?php echo $response['jefeD']; ?></td>
          </tr>
          <tr>
            <td>FECHA DE APLICACIÓN</td>
            <td><?php echo $response['fechaAp']; ?></td>
            <td>ANTIGÜEDAD</td>
            <td><?php echo $response['antiguedad']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="caracteristicas">
      <h3>CARACTERÍSTICAS</h3>
    </div>
    <div class="evaluacion">
      <table>
        <thead>
          <tr>
            <th>ASPECTOS A EVALUAR</th>
            <th>INSATISFACTORIO</th>
            <th>SATISFACTORIO</th>
            <th>BIEN</th>
            <th>EXCELENTE</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="not-center">Trabaja a todo su potencial</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['potencial']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Calidad del trabajo</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['calidad']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Consistencia en el trabajo</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['consistencia']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Comunicación</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['comunicacion']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Trabajo Independiente</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['independiente']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Toma la iniciativa</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['iniciativa']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Trabajo en equipo</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['equipo']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Productividad</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['producti']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Creatividad</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['creatividad']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Honestidad</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['honestidad']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Integridad</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['integridad']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Relaciones con los compañeros de trabajo</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['relacionInt']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Relaciones con los clientes</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['relacionExt']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Habilidades Técnicas</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['habilidadT']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Fiabilidad</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['fiabilidad']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Puntualidad</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['puntualidad']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Asistencia</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['asistencia']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Interes en su trabajo</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['interes']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Compromiso</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['compromiso']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Resultado general de su trabajo</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              if ($i == $response['resultado']) {
                $puntuacion = '&#10003;';
                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
              } else {
                $puntuacion = '';
              }
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
          <tr>
            <td class="not-center">Total</td>
            <?php
            for ($i = 1; $i <= 4; $i++) :
              $puntuacion = $contadorPuntos[$i];
            ?>
              <td><?php echo $puntuacion ?></td>
            <?php endfor; ?>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="objetivos">
      <table>
        <tbody>
          <tr>
            <td>
              <h3>OBSERVACIONES</h3>
            </td>
          </tr>
          <tr>
            <td class="txt-objetivos"><?php echo $response['comentarios']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="pie-doc">
      <table>
        <thead>
          <tr>
            <th>FIRMA RH</th>
            <th>FIRMA DIRECCIÓN</th>
            <th>FIRMA JEFE DIRECTO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
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

// Configurar cabeceras para indicar que es un PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="nombre_archivo.pdf"');
header('Content-Length: ' . strlen($pdf_content));

// Enviar el contenido del PDF como respuesta Ajax
echo $pdf_content;

?>