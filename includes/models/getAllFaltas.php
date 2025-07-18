<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Faltas.php';

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
        $key = $_GET['pagina'];
        $faltas = new Faltas($conexion);
        if ($key == 'faltas') {
            $AllFaltas = $faltas->getAllFaltas();
            header('Content-Type: application/json');
            echo json_encode($AllFaltas);
        } else if ($key == 'dashboard') {
            if ($_GET["filtro"] == NULL) {
                $anio = $_GET['anio'];
                $FaltasMeses = $faltas->getCountFaltasMes($anio);
                header('Content-Type: application/json');
                echo json_encode($FaltasMeses);
            } else {
                $filtro = $_GET["filtro"];
                $clausula = $_GET["clausula"];
                $anio = $_GET['anio'];
                $faltasFiltro = $faltas->getCountFaltasMesFiltro($filtro, $clausula, $anio);
                header('Content-Type: application/json');
                echo json_encode($faltasFiltro);
            }
        }else if($key == 'comprobante'){
            $ausentismo = $_GET['ausentismo'];
            $comprobanteFaltas = $faltas->getComprobanteFalta($ausentismo);
            header('Content-Type: application/json');
            echo json_encode($comprobanteFaltas);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
