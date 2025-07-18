<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Accidentes.php';

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
        $Accidente = new Accidentes($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idEmpleado = intval($_POST['idEmpleado']);
            $tipo = $_POST['tipoAccidente'];
            $incapacidad = $_POST['incapacidad'];
            $fecha = $_POST['fechaAccidente'];
            $creacion = $_POST['creacion'];
            $usuarioCreacion = $_POST['usuarioCreacion'];
            $response = $Accidente->createAccidente($idEmpleado, $fecha, $tipo, $incapacidad, $creacion, $usuarioCreacion);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();