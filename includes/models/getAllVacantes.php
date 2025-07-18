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
        $vacantes = new Vacantes($conexion);
        $empleado = new Empleados($conexion);
        if ($_GET['pagina'] == 'dashboard') {
            $totalEmpleados = $empleado->getCountEmpleados();
            $AllVacantes = $vacantes->getVacantes();
            //sacamos las vacantes disponibles y las vacantes ocupadas
            $disponibles = $AllVacantes['suma_total'] - $totalEmpleados['Total'];
            $ocupados = $totalEmpleados['Total'];
            $datos = array(
                'disponibles' => $disponibles,
                'ocupados' => $ocupados
            );
            header('Content-Type: application/json');
            echo json_encode($datos);
        } else if ($_GET['pagina'] == 'vacantes') {
            $totalEmpleados = $empleado->getEmpleadosArea();
            $AllVacantes = $vacantes->getAllVacantes();
            $datos = array(
                'allVacantes' => $AllVacantes,
                'allEmpleados' => $totalEmpleados
            );
            header('Content-Type: application/json');
            echo json_encode($datos);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
