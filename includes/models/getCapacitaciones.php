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
        $capacitaciones = new Capacitacion($conexion);
        if ($_GET['pagina'] == 'capacitacion') {
            $response = $capacitaciones->getCapacitaciones();
        } else if ($_GET['pagina'] == 'dashboard') {
            if ($_GET["filtro"] == NULL) {
                $anio = $_GET['anio'];
                $response = $capacitaciones->getCountCapacitacionMes($anio);
            } else {
                $filtro = $_GET["filtro"];
                $clausula = $_GET["clausula"];
                $anio = $_GET['anio'];
                $response  = $capacitaciones->getCountCapacitacionMesFiltro($filtro, $clausula, $anio);
            }
        }
        // Envía las industrias como JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
