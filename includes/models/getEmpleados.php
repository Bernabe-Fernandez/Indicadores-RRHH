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
        $empleado = new Empleados($conexion);
        if (empty($_GET)) {
            $response = $empleado->getAllEmpleados();
            header('Content-Type: application/json');
            echo json_encode($response);
        } else if($_GET['key'] == "1"){
            $id = $_GET['nombre'];
            $columna = 'Nombre';
            $response = $empleado->empleadosWhere($columna, $id);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['key'] == "2"){
            $response = $empleado->getEmpleadosActivos();
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['key'] == "3"){
            $id = $_GET['id'];
            $columna = 'idEmpleado';
            $response = $empleado->empleadosWhere($columna, $id);
            $response['antiguedad'] = calcularAntiguedad($response['Ingreso']);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['key'] == "4"){
            $idEmpleado = intval($_GET['idEmpleado']);
            $response = $empleado->getAreaUsuario($idEmpleado);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['key'] == "5"){
            $idUsario = intval($_GET['idEmpleado']);
            $area = intval($_GET['area']);
            $response = $empleado->getEmpEvaluacion($area, $idUsario);
            // if($_GET['area'] == "3"){
            //     $area = intval($_GET['area']);
            //     $response = $empleado->getEmpFinanzas($idUsario);
            // }else{
            //     $area = intval($_GET['area']);
            //     $response = $empleado->getEmpEvaluacion($area, $idUsario);
            // }
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['key'] == "6"){
            $id = $_GET['id'];
            $response = $empleado->empleadosReporte($id);
            $response['antiguedad'] = calcularAntiguedad($response['Ingreso']);            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else if($_GET['key'] == "7"){
            $idEmpleado = intval($_GET['idEmpleado']);
            $response = $empleado->getEmpleadoData($idEmpleado);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        else if($_GET['key'] == "8"){
            $idEmpleado = intval($_GET['idEmpleado']);
            $area = intval($_GET['area']);
            $response = $empleado->getListaAsistencia($area, $idEmpleado);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}


function calcularAntiguedad($inicio) {
    $start = new DateTime($inicio);
    $end = new DateTime();
    $antiguedad = $start->diff($end);
    $anios = $antiguedad->y;
    $meses = $antiguedad->m;
    $dias = $antiguedad->d;
    $tAntiguedad = "";
    if($anios == 1){
        $tAntiguedad = "{$anios} año ";
    }else if($anios > 1){
        $tAntiguedad = "{$anios} años ";
    }
    if($meses == 1){
        $tAntiguedad = $tAntiguedad . "{$meses} mes";
    }else if($meses > 1){
        $tAntiguedad = $tAntiguedad . "{$meses} meses";
    }
    if($tAntiguedad == ""){
        $tAntiguedad = "{$dias} días";
    }

    return $tAntiguedad;
}

$bd->closeConnection();
