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
    }else{
        $empleado = new Empleados($conexion);
        if (empty($_GET)) {
            $response = $empleado->getEmpleadosAlta();
            // Envía las industrias como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else if($_GET['opcion'] == "baja"){
            $response = $empleado->getEmpleadosBaja();
            // Envía las industrias como JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['opcion'] == "dashboardBajas"){
            $anio = $_GET['anio'];
            $response = $empleado->countBajas($anio);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['opcion'] == "dashboardAltas"){
            $anio = $_GET['anio'];
            $response = $empleado->countAltas($anio);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['opcion'] == 'filtroBajas'){
            $anio = $_GET['anio'];
            $area = intval($_GET['area']);
            $response = $empleado->filtroBajas($area, $anio);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['opcion']=='filtroAltas'){
            $anio = $_GET['anio'];
            $area = intval($_GET['area']);
            $response = $empleado->filtroAltas($area, $anio);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['opcion'] == 'graficaAltas'){
            $anio = $_GET['anio'];
            $response = $empleado->altasTotales($anio);
            header('Content-Type: application/json');
            echo json_encode($response);
        }else if($_GET['opcion'] == 'graficaBajas'){
            $anio = $_GET['anio'];
            $response = $empleado->bajasTotales($anio);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
