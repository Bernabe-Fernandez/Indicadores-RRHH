<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'PromocionesLabo.php';

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
        $promocionL =  new PromocionesLabo($conexion);
        if ($_GET['key'] == "1") {
            $response = $promocionL->getAllPromocionesL();
        }else if($_GET['key'] == "2"){
            $idPromocion = $_GET['idPromocion'];
            $response = $promocionL->getOnePromocionL($idPromocion);
        }else if($_GET['key'] == "3"){
            $anio = $_GET['anio'];
            $response = $promocionL->getCountMesPromocionL($anio);
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
