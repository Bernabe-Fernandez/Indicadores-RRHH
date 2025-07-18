<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Puestos.php';

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
        $puestos = new Puestos($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idPuesto = intval($_POST['idPuesto']);
            $nombrePuesto = $_POST['nombrePuesto'];
            $areaPuesto= intval($_POST['selectPuestoArea']);
            $estatus = $_POST['selectPuestoEstatus'];
            $usuario = $_POST['usuarioModifi'];
            $response = $puestos->updatePuesto($idPuesto, $nombrePuesto, $areaPuesto, $estatus, $usuario);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();