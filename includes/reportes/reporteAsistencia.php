<?php
//creación del archivo pdf para evaluación de desempeño
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $asistencias = $_POST['infoReporte'];
    $fechas = $_POST['fechas'];
    $periodo = $_POST['periodo'];
    $tipoReporte = $_POST['tipoReporte'];
    
    // var_dump($asistencias);
    
    ob_start();
}else{
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Asistencia</title>

    <style>
        .contenido {
            margin-left: 250px;
            transition: margin-left 0.5s ease;
        }

        .contenido h1 {
            margin: 0;
        }

        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            word-wrap: break-word;
            border: 1px solid #ddd;
            padding: 5px;
        }

        thead{
            background-color: #474A44;
            color: #fff;
        }

        .titulo-tabla {
            font-size: 25px;
        }

        .titulos-esp th{
            font-size: 10px;
            padding: 2px;
        }

        .contenido-esp td{
            font-size: 10px;
            padding: 2px;
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <table class="tablaAsistencia">
        <thead>
            <tr>
                <!-- Título que ocupa todo el ancho de la tabla -->
                <th class="titulo-tabla" colspan="<?php echo count($fechas) + 3?>">Periodo <?php echo $periodo; ?></th>
            </tr>
            <tr class="titulos-esp">
                <!-- Segunda fila de títulos -->
                <th rowspan="2">Usuario</th>
                <th colspan="<?php echo count($fechas) ?>">Fecha</th>
                <th rowspan="2">Retardos</th>
                <th rowspan="2">Faltas</th>
            </tr>
            <tr class="titulos-esp">
                <!-- iterar en las fechas -->
                <?php foreach ($fechas as $fecha): ?>
                    <th><?php echo $fecha; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asistencias as $asistencia): ?>
                <tr class="contenido-esp">
                    <td><?php echo $asistencia['nombre'] ?></td>

                    <?php
                    for ($i = 0; $i < count($fechas); $i++) {
                        echo '<td>' . $asistencia['horario'][$i] . '</td>';
                    }
                    ?>
                    <td><?php echo $asistencia['retardos'] ?></td>
                    <td><?php echo $asistencia['faltas'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>

<?php
// // creación del pdf
$contenidoReporte = ob_get_clean();

// echo $contenidoReporte;
$dompdf = new Dompdf();


$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($contenidoReporte);
// // $dompdf->setPaper('A4', 'landscape');
// $dompdf->setPaper('Carta');
$dompdf->setPaper('Carta', 'landscape');
$dompdf->render();


// Obtiene el contenido del PDF
$pdf_output = $dompdf->output();

// Define la ruta y el nombre del archivo donde quieres guardar el PDF
$baseDir = __DIR__ . '../../../assets/reportes/' . $tipoReporte;
$archivo = $baseDir . '/reporteAsistencia_' . $tipoReporte . '_' . $periodo . '.pdf';
$nombreArchivo =$tipoReporte . '/reporteAsistencia_' . $tipoReporte . '_' . $periodo . '.pdf';

// Verifica si la carpeta existe, si no, la crea
if (!file_exists($baseDir)) {
    mkdir($baseDir, 0777, true); // true permite la creación de directorios recursivamente
}

// Guarda el PDF en la carpeta especificada
file_put_contents($archivo, $pdf_output);

// Guarda el PDF en la carpeta especificada
if (file_put_contents($archivo, $dompdf->output())) {
    echo json_encode(['icono' => 'success', 'mensaje' => 'El reporte se generó exitosamente', 'ruta' => $nombreArchivo]);
} else {
    echo json_encode(['icono' => 'error', 'mensaje' => 'Hubo un problema al generar el reporte.']);
}
?>