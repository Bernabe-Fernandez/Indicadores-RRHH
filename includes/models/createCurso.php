<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Curso.php';

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
        $Cursos = new Cursos($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $Curso = $_POST['NombreCurso'];
            $Fecha = $_POST['fechaCurso'];
            $Creacion = $_POST['creacion'];
            $UsuarioCreate = $_POST['usuarioCreacion'];
            $response = $Cursos->createCurso($Curso, $Fecha, $Creacion, $UsuarioCreate);
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();