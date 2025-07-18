<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Areas.php';

//creamos una instancia de la bd
$bd = new Database();
//nos conectamos a la bd
$conexion = $bd->getConnection();
// Verifica si la conexión se estableció correctamente
if ($conexion != null) {
    //evaluamos si la conexion nos dio error
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    } else {
        $areas = new Areas($conexion);
        if ($_GET['key'] == "0") {
            $response = $areas->getAreas();
        }else if($_GET['key'] == "1"){
            $idArea = intval($_GET['idArea']);
            $response = $areas->getAreasWhere($idArea);
        }else if($_GET['key'] == "2"){
            $response = $areas->getAllAreas();
        }
        // Envía las industrias como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
