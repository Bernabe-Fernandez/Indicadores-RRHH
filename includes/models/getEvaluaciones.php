<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Evaluaciones.php';

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
        $evaluaciones = new Evaluaciones($conexion);
        if($_GET['key'] == '1'){
            $response = $evaluaciones->getAllEvaluacionesD();
        }else if($_GET['key'] == '2'){
            $response = $evaluaciones->getAllAutoEvaluacionesD();
        }else if($_GET['key'] == '3'){
            $idEvaluacion = $_GET['idEvaluacion'];
            $response = $evaluaciones->getOneEvaluacionesD($idEvaluacion);
        }else if($_GET['key'] == '4'){
            $idAutoEvaluacion = $_GET['idAutoEva'];
            $response = $evaluaciones->getOneAutoEvaluacionesD($idAutoEvaluacion);
        }else if($_GET['key'] == '5'){
            $anio = $_GET['anio'];
            $response = $evaluaciones->getCountMesEvaluaciones($anio);
        }else if($_GET['key'] == '6'){
            $anio = $_GET['anio'];
            $response = $evaluaciones->getCountMesAevaluaciones($anio);
        }
        // Envía las industrias como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
