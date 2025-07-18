<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Capacitacion.php';

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
        $capacitacion = new Capacitacion($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = intval($_POST['empleadoCurso']);
            $idCurso = intval($_POST['curso']);
            $creacion = $_POST['creacion'];
            $usuarioCreate = $_POST['usuarioCreacion'];
            $response = $capacitacion->createCapacitacion($idEmpleado, $idCurso, $creacion, $usuarioCreate);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();