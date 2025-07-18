<?php
require '../../vendor/autoload.php';  // Asegúrate de que PhpSpreadsheet esté instalado

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;


if (isset($_FILES['excelFile']['tmp_name'])) {
    $file = $_FILES['excelFile']['tmp_name'];

    // Cargar el archivo Excel
    $spreadsheet = IOFactory::load($file);

    // Obtener la hoja activa
    $sheet = $spreadsheet->getActiveSheet();


    //detectar la ultima fila activa
    $highestRow = $sheet->getHighestRow();


    // Definir el rango de columnas
    $startColumn = 'A';
    $endColumn = 'AE';

    // Convertir las letras de las columnas a índices numéricos
    $startColumnIndex = Coordinate::columnIndexFromString($startColumn);
    $endColumnIndex = Coordinate::columnIndexFromString($endColumn);


    // Iterar en el nombre de los horarios
    for ($row = 5; $row <= $highestRow; $row += 2) {

        // Obtener el valor de la columna B en la fila actual (puedes cambiar la columna)
        $usuarios[] = $sheet->getCell('K' . $row)->getValue();
    }

    //iterar en los horarios
    for ($row = 6; $row <= $highestRow; $row += 2) {
        $horario = [];
        //en este for iteramos sobre la fila completa, perro debemos iterar dentro de las columnas de la fila
        for ($col = $startColumnIndex; $col <= $endColumnIndex; $col++) {
            $columnLetter = Coordinate::stringFromColumnIndex($col);
            $horario[] = $sheet->getCell($columnLetter . $row)->getValue();
        }
        $horarios[] = $horario;
    }

    //iterar en los dias
    for ($col = $startColumnIndex; $col <= $endColumnIndex; $col++) {
        $columnLetter = Coordinate::stringFromColumnIndex($col);
        $fechasArr[] = $sheet->getCell($columnLetter . 4)->getValue();
    }

    $periodo = $sheet->getCell('C' . 3)->getValue();


    // var_dump($fechasArr);

    foreach ($fechasArr as $fecha) {
        if ($fecha != null) {
            $fechas[] = $fecha;
        }
    }

    // print_r($horarios);

    for ($i = 0; $i < count($usuarios); $i++) {
        $asistencias[] = [
            'nombre' => $usuarios[$i],
            'horario' => $horarios[$i],
        ];
    }

    $datos = [$asistencias, $fechas, $periodo];

    echo json_encode($datos);
}
