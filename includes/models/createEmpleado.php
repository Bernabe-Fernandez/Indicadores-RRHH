<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
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
        $Empleado = new Empleados($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Nombre = $_POST['nombreEmpleado'];
            $Curp = $_POST['curpEmpleado'];
            $RFC = $_POST['rfcEmpleado'];
            $NSS = $_POST['nssEmpleado'];
            $Domicilio = $_POST['domicilioEmpleado'];
            $Contacto = $_POST['contactoEmpleado'];
            $Celular = $_POST['celularEmpleado'];
            $Puesto = intval($_POST['puestoEmpleado']);
            $Area = intval($_POST['areaEmpleado']);
            $Ingreso = $_POST['fechaIngreso'];
            $creacion = $_POST['creacion'];
            $observaciones = $_POST['observaciones'];
            $userCreate = $_POST['usuarioCreacion'];
            $response = $Empleado->createEmpleado($Nombre, $Curp, $RFC, $NSS, $Domicilio, $Contacto, $Celular, $Area, $Puesto, $observaciones, $Ingreso, "1", $creacion, $userCreate);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();