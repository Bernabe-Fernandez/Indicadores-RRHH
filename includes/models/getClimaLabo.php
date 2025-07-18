<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'ClimaLabo.php';

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
        $climaLabo = new ClimaLabo($conexion);
        $anio = $_GET['anio'];
        $response = $climaLabo->getAllClimaLab($anio);
        // Envía las industrias como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
