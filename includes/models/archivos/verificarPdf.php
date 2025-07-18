<?php

// Obtener el nombre del archivo desde el parámetro GET
$nombreArchivo = $_GET['archivo'];

if ($nombreArchivo == "" || $nombreArchivo == null) {
    // Responder con la ruta del archivo
    $datos = array(
        'icono' => "error",
        'existe' => false,
        'mensaje' => "No se ha cargado ningun archivo"
    );
    header('Content-Type: application/json');
    echo json_encode($datos);
    exit;
} else {
    // Ruta base de los archivos PDF fuera del proyecto
    $baseDir = "C:/Ausencias/";

    // Construir la ruta completa del archivo
    $rutaArchivo = $baseDir . $nombreArchivo;

    // Verificar si el archivo existe
    if (file_exists($rutaArchivo)) {
        // Responder con la ruta del archivo
        $datos = array(
            'existe' => true,
            'ruta' => 'includes/models/archivos/mostrarPdf.php?archivo=' . $nombreArchivo
            // 'ruta' => $nombreArchivo
        );
        header('Content-Type: application/json');
        echo json_encode($datos);
    } else {
        // Manejar el caso en que el archivo no existe
        http_response_code(404);
        $datos = array(
            'existe' => false,
            'icono' => "error",
            'mensaje' => 'No se encontró el documento.'
        );
        header('Content-Type: application/json');
        echo json_encode($datos);
    }
}
