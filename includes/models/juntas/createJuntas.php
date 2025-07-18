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
                $gerenteJunta = $_POST['gerenteJunta'];
                $periodoJunta = $_POST['periodoJunta'];
                $areaId = $_POST['areaId'];
                $fechaJunta = $_POST['fechaJunta'];
                $horaJunta = $_POST['horaJunta'];
                $temasJunta = $_POST['temasJunta'];
                $comentariosJunta = $_POST['comentariosJunta'];
                $user = $_POST['user'];
                $idUser = $_POST['idUser'];
                $asistentesJson = $_POST['asistentes'];
                $asistentes = json_decode($asistentesJson, true);
                if ($asistentes === null) {
                    echo json_encode(['icono' => 'error', 'mensaje' => 'Error al decodificar los datos de asistentes']);
                    exit;
                }
                $response = $junta->createJunta($gerenteJunta, $areaId, $periodoJunta,  $fechaJunta, $horaJunta, $temasJunta, $comentariosJunta, $asistentes, $user, $idUser);
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
