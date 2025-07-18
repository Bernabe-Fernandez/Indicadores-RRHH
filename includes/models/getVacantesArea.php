<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Vacantes.php';
require_once 'Empleados.php';

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
        $area = $_GET['area'];
        $vacantes = new Vacantes($conexion);
        $areaVacantes = $vacantes->getVacantesArea($area);
        $empleado = new Empleados($conexion);
        $totalEmpleados = $empleado->getCountEmpleadosArea($area);
        //sacamos las vacantes disponibles y las vacantes ocupadas
        $disponibles = $areaVacantes['suma_total'] - $totalEmpleados['Total'];
        $ocupados = $totalEmpleados['Total'];
        $datos = array(
            'disponibles' => $disponibles,
            'ocupados' => $ocupados
        );
        header('Content-Type: application/json');
        echo json_encode($datos);
        
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();