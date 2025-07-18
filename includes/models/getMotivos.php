<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'MotivosFalta.php';

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
        $Motivos =  new MotivosFalta($conexion);
        $AllMotivos = $Motivos->getMotivosFalta();
        header('Content-Type: application/json');
        echo json_encode($AllMotivos);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
