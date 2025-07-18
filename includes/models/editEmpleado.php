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
            $modificacion = $_POST['modificacion'];
            $userModifi = $_POST['usuarioModifi'];
            $idEmpleado = intval($_POST['idEmpleado']);
            if ($_POST['key'] == "1") {
                $Nombre = $_POST['nombreEmpleado'];
                $Curp = $_POST['curpEmpleado'];
                $RFC = $_POST['rfcEmpleado'];
                $NSS = $_POST['nssEmpleado'];
                $Domiclio = $_POST['domicilioEmpleado'];
                $contacto = $_POST['contactoEmpleado'];
                $celular = $_POST['celularEmpleado'];
                $Puesto = intval($_POST['puestoEmpleado']);
                $Area = intval($_POST['areaEmpleado']);
                $Observacion = $_POST['observaciones'];
                $Ingreso = $_POST['fechaIngreso'];
                $Estatus = "1";
                $response = $Empleado->editEmpleado($idEmpleado, $Nombre, $Curp, $RFC, $NSS, $Domiclio, $contacto, $celular, $Area, $Puesto, $Observacion, $Ingreso, $Estatus, $modificacion, $userModifi);
            }else if($_POST['key'] == '0'){
                $Egreso = $_POST['fechaEgreso'];
                $Estatus = $_POST['Estatus'];
                $comentario = $_POST['ComEgreso'];
                $Motivo = intval($_POST['motivoEgreso']);
                $response = $Empleado->bajaEmpleado($idEmpleado, $Egreso, $Estatus, $comentario, $Motivo, $modificacion, $userModifi);
            }            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
