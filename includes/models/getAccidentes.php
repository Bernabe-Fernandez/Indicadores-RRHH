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
        $accidentes = new Accidentes($conexion);
        if ($_GET['pagina'] == 'accidentes') {
            $allAccidentes = $accidentes->getAccidentes();
            header('Content-Type: application/json');
            echo json_encode($allAccidentes);
        } else if ($_GET['pagina'] == 'dashboard') {
            if ($_GET["filtro"] == NULL) {
                $anio = $_GET['anio'];
                $accidentesMes = $accidentes->getCountAccidentesMes($anio);
                header('Content-Type: application/json');
                echo json_encode($accidentesMes);
            } else {
                $filtro = $_GET["filtro"];
                $clausula = $_GET["clausula"];
                $anio = $_GET['anio'];
                $accidentesFiltro = $accidentes->getCountAccidentesMesFiltro($filtro, $clausula, $anio);
                header('Content-Type: application/json');
                echo json_encode($accidentesFiltro);
            }
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
