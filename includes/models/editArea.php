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
        $area = new Areas($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idArea = intval($_POST['idArea']);
            $estatus = $_POST['estatusArea'];
            $usuario = $_POST['usuarioModifi'];
            $response = $area->updateArea($idArea, $estatus, $usuario);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();