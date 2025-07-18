<?php
// Ruta base de los archivos PDF fuera del proyecto
$baseDir = "C:/Ausencias/";

// Obtener el nombre del archivo desde el parámetro GET
$nombreArchivo = $_GET['archivo'];

// Construir la ruta completa del archivo
$rutaArchivo = $baseDir . $nombreArchivo;

// Verificar si el archivo existe
if (file_exists($rutaArchivo)) {
    // Establecer los encabezados para la descarga del archivo
    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($rutaArchivo) . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($rutaArchivo));
    ob_clean();
    flush();
    readfile($rutaArchivo);
    exit;
} else {
    // Manejar el caso en que el archivo no existe
    http_response_code(404);
    echo "El archivo no existe.";
}
?>