<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Vacantes.php';

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
        $area = $_GET['area'];
        $vacantes = new Vacantes($conexion);
        $vacantesAuto = $vacantes->getVacantesAutArea($area);
        header('Content-Type: application/json');
        echo json_encode($vacantesAuto);        
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();