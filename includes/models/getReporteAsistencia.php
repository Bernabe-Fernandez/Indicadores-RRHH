<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $semanal = 'C:/laragon/www/rrhhmorgall/assets/reportes/semanal';
    $quincenal = 'C:/laragon/www/rrhhmorgall/assets/reportes/quincenal';
    $ventas = 'C:/laragon/www/rrhhmorgall/assets/reportes/ventas';

    // Obtiene una lista de todos los archivos y carpetas dentro del directorio
    $archSemanal = scandir($semanal);
    $archQuincenal = scandir($quincenal);
    $archVentas = scandir($ventas);

    // Filtra los archivos y carpetas especiales "." y ".."
    $archSemanal = array_diff($archSemanal, array('.', '..'));
    $archQuincenal = array_diff($archQuincenal, array('.', '..'));
    $archVentas = array_diff($archVentas, array('.', '..'));

    if($_GET['key'] == '1'){
        $allArchivos = array_merge($archSemanal, $archQuincenal, $archVentas);
    }

    echo json_encode($allArchivos);
}

// header('Content-Type: application/json');


// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     if (empty($_POST)) {
//         $datos = array(
//             'icono' => 'error',
//             'mensaje' => 'Debe seleccionar un tipo de reporte'
//         );
//     } else {
//         $tipoReporte = $_POST['tipoReporte'];
//         // Directorio donde están los archivos
//         $directorio = __DIR__ . '/../../assets/reportes/' . $tipoReporte;

//         // Obtener todos los archivos en el directorio
//         $datos = array_diff(scandir($directorio), array('..', '.'));
//     }


//     // Preparar la respuesta JSON
//     echo json_encode($datos);
// }
