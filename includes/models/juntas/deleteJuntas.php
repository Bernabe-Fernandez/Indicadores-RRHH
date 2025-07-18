<?php
//llamamos el archivo de configuracion
require_once '../../config/bd.php';
//llamamos el archivo de lectura
require_once '../clases/Juntas.php';

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
        $junta = new Juntas($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idJunta = $_POST['idJunta'];
                $response = $junta->deleteJuntas($idJunta);
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
