<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Faltas.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $archivo = "";
            if ($_FILES) {
                if (isset($_FILES['archivo'])) {
                    $archivo = $_FILES['archivo'];
                }
            }
            $empleado = intval($_POST['idEmpleado']);
            $fecha = $_POST['fechaFalta'];
            $motivo = $_POST['motivo'];
            $observaciones = $_POST['observaciones'];
            $creacion = $_POST['creacion'];
            $userCreate = $_POST['Usuario'];
            $faltas = new Faltas($conexion);
            $response = $faltas->createFalta($empleado, $fecha, $motivo, $observaciones, $archivo, $creacion, $userCreate);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    } else {
        echo "Error al conectarse";
    }

    $bd->closeConnection();
}