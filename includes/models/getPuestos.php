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
        if ($_GET['key'] == '1') {
            //consultar puestos dependiendo del area seleccionada
            $area = $_GET['area'];
            if ($area != NULL || $area != "") {
                $response = $puestos->getPuestosArea($area);
            } else {
                $response = 'Seleccione un area';
            }
        }else if($_GET['key'] == '2'){
            //consultar puestos y areas para tabla
            $response = $puestos->getAllPuestos();
        }
        else if($_GET['key'] == '3'){
            $idPuesto = $_GET['idPuesto'];
            $response = $puestos->getPuesto($idPuesto);
        }       
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
