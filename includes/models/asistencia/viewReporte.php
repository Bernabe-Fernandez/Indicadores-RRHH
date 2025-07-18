<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['reporte'])) {
        $reporte = $_POST['reporte'];

        // Ruta al archivo en la carpeta rrhhmorgall
        $rutaSemanal = 'C:/laragon/www/rrhhmorgall/assets/reportes/semanal' . '/' . $reporte;
        $rutaQuincenal = 'C:/laragon/www/rrhhmorgall/assets/reportes/quincenal' . '/' . $reporte;
        $rutaVentas = 'C:/laragon/www/rrhhmorgall/assets/reportes/ventas' . '/' . $reporte;

        // Verifica si el archivo existe
        if (file_exists($rutaSemanal)) {
            // Devuelve la URL completa del archivo
            $url = 'http://servidormorgall.ddns.net:8080/rrhhmorgall/assets/reportes/semanal/' . $reporte;
            echo json_encode($url);
        } else if (file_exists($rutaQuincenal)) {
                // Devuelve la URL completa del archivo
                $url = 'http://servidormorgall.ddns.net:8080/rrhhmorgall/assets/reportes/quincenal/' . $reporte;
                echo json_encode($url);
        } else if(file_exists($rutaVentas)){
            $url = 'http://servidormorgall.ddns.net:8080/rrhhmorgall/assets/reportes/ventas/' . $reporte;
            echo json_encode($url);
        }
        else{
                // Maneja el error si el archivo no existe
                echo json_encode(['icono' => 'error', 'mensaje' => 'El archivo no se encuentra.']);
        }
        // echo json_encode($rutaReporte);
    } else {
        echo json_encode(['icono' => 'error', 'mensaje' => 'No se seleccionó ningún reporte.']);
    }
} else {
    echo json_encode(['icono' => 'error', 'mensaje' => 'Error al acceder']);
}
