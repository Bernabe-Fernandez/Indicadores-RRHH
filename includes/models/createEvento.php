<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Eventos.php';

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
        $eventos = new Eventos($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Evento = $_POST['nombreEvento'];
            $Fecha = $_POST['fechaEvento'];
            $creacion = $_POST['creacion'];
            $usuarioCreacion = $_POST['usuarioCreacion'];
            $response = $eventos->createEvento($Evento, $Fecha, $creacion, $usuarioCreacion);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();