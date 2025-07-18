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
// var_dump($response);
ob_start();

?>

<!DOCTYPE html>
<html lang="es" id="ReporteD">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Autoevaluacion de Desempeño</title>
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
            margin-right: 150px;
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
            font-size: 12px;
            border: 1px solid black;
            width: 170px;
            height: 20px;
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

        .preguntas-abiertas,
        .evaluacion {
            width: auto;
            height: auto;
            margin: 0 10px;
        }

        .preguntas-abiertas table,
        .evaluacion table {
            width: 100%;
        }

        .preguntas-abiertas table thead,
        .evaluacion table thead {
            font-size: 12px;
            text-align: center;
        }

        .preguntas-abiertas table thead tr th {
            width: 50%;
            border: 1px solid black;
        }

        .evaluacion table thead tr th {
            padding: 4px;
            min-width: 100px;
            border: 1px solid black;
        }

        .preguntas-abiertas table tbody,
        .evaluacion table tbody {
            font-size: 11px;
        }

        .preguntas-abiertas table tbody tr td {
            border: 1px solid black;
            height: 50px;
            text-align: center;
        }

        .evaluacion table tbody tr td {
            border: 1px solid black;
            text-align: center;
        }

        .evaluacion table tbody tr td.not-center {
            text-align: left;
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
                            <h1>ENCUESTA DE SALIDA</h1>
                        </td>
                        <td>
                            <img src="http://localhost:8080/rrhhmorgall/img/logo.png" alt="icono" />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="caracteristicas">
            <h3>DATOS PERSONALES</h3>
        </div>
        <div class="description">
            <table>
                <tbody>
                    <tr>
                        <td>NOMBRE DEL EMPLEADO</td>
                        <td><?php echo $response['Nombre'] ?></td>
                    </tr>
                    <tr>
                        <td>FECHA INGRESO</td>
                        <td><?php echo $response['Ingreso'] ?></td>
                    </tr>
                    <tr>
                        <td>FECHA EGRESO</td>
                        <td><?php echo $response['egreso'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="caracteristicas">
            <h3>Cuestionario</h3>
        </div>
        <div class="preguntas-abiertas">
            <table>
                <thead>
                    <tr>
                        <th>PREGUNTAS</th>
                        <th>RESPUESTA</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>¿Cuál es el motivo de tu salida?</td>
                        <td><?php echo $response['motivo'] ?></td>
                    </tr>
                    <tr>
                        <td>Especifique:</td>
                        <td><?php echo $response['especifique'] ?></td>
                    </tr>
                    <tr>
                        <td>¿Cómo consideras que fue la relación con tu jefe inmediato?</td>
                        <td><?php echo $response['relacionJ'] ?></td>
                    </tr>
                    <tr>
                        <td>¿Con cuánto calificas el trato de tu jefe hacia tí?</td>
                        <td><?php echo $response['trato'] ?></td>
                    </tr>
                    <tr>
                        <td>¿Cómo consideras que fue la relación con tus compañeros de trabajo?</td>
                        <td><?php echo $response['relacionC'] ?></td>
                    </tr>
                    <tr>
                        <td>¿Qué es lo que más te gustaba de la empresa?</td>
                        <td><?php echo $response['gusto'] ?></td>
                    </tr>
                    <tr>
                        <td>¿Qué es lo que menos te gustaba de la empresa?</td>
                        <td><?php echo $response['disgusto'] ?></td>
                    </tr>
                    <tr>
                        <td>¿En qué crees que podemos mejorar?</td>
                        <td><?php echo $response['mejora'] ?></td>
                    </tr>
                    <tr>
                        <td>¿Recomendarías a alguien más para trabajar en Morgall?</td>
                        <td><?php echo $response['recomendacion'] ?></td>
                    </tr>
                    <tr>
                        <td>Comentario</td>
                        <td><?php echo $response['comentario'] ?></td>
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