<?php
class Cursos
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }
    public function createCurso($curso, $fecha, $Creacion, $UsuarioCreate)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.capacitacion (Nombre, Fecha, creacion, usuarioCreate, ultModifi, usuarioModifi) VALUES (?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("ssssss", $curso, $fecha, $Creacion, $UsuarioCreate, $Creacion, $UsuarioCreate);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Registro Correcto'
            );
        } else {
            $datos = array(
                'icono' => 'error',
                'mensaje' => 'Hubo un error al guardar los datos.'
            );
        }

        return $datos;

        // Cerrar la conexión
        $sentenciaInsert->close();
    }
    public function getAllCursos()
    {
        //Sentencia preparada para insertar datos de forma segura
        $sql = "SELECT idCapacitacion, Nombre, Fecha FROM rhhmorgall.capacitacion;";

        $selectSQL = $this->conexion->prepare($sql);
        if ($selectSQL) {
            // Ejecutar la consulta
            if ($selectSQL->execute()) {
                // Obtener resultado de la consulta
                $result = $selectSQL->get_result();
                // Verificar si hay filas devueltas
                if ($result->num_rows > 0) {
                    // Iterar sobre las filas y mostrar los resultados
                    while ($row = $result->fetch_assoc()) {
                        $datos[] = $row;
                    }
                } else {
                    $datos = array(
                        'icono' => 'error',
                        'mensaje' => 'No se encontraron resultados.'
                    );
                }
            } else {
                $datos = array(
                    'icono' => 'error',
                    'mensaje' => 'Error al ejecutar la consulta.'
                );
                $selectSQL->error;
            }
            $selectSQL->close();
        } else {
            $datos = array(
                'icono' => 'error',
                'mensaje' => 'Error al preparar la declaración.'
            );
            $this->conexion->error;
        }

        return $datos;
    }
    public function getCurso($idCurso)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sql = "SELECT idCapacitacion, Nombre, Fecha FROM rhhmorgall.capacitacion WHERE idCapacitacion = ?;";

        $selectSQL = $this->conexion->prepare($sql);
        // Vincular parámetros
        $selectSQL->bind_param("i", $idCurso);
        if ($selectSQL) {
            // Ejecutar la consulta
            if ($selectSQL->execute()) {
                // Obtener resultado de la consulta
                $result = $selectSQL->get_result();
                // Verificar si hay filas devueltas
                if ($result->num_rows > 0) {
                    // Iterar sobre las filas y mostrar los resultados
                    while ($row = $result->fetch_assoc()) {
                        $datos = $row;
                    }
                } else {
                    $datos = array(
                        'icono' => 'error',
                        'mensaje' => 'No se encontraron resultados.'
                    );
                }
            } else {
                $datos = array(
                    'icono' => 'error',
                    'mensaje' => 'Error al ejecutar la consulta.'
                );
                $selectSQL->error;
            }
            $selectSQL->close();
        } else {
            $datos = array(
                'icono' => 'error',
                'mensaje' => 'Error al preparar la declaración.'
            );
            $this->conexion->error;
        }

        return $datos;
    }
    public function editCurso($idCurso, $nombre, $Fecha, $update, $usuarioUpdate){
        $sqlUpdate = "UPDATE rhhmorgall.capacitacion SET Nombre = ?, Fecha = ?, ultModifi = ?, usuarioModifi = ? WHERE idCapacitacion = ?";
        $sentenciaInsert = $this->conexion->prepare($sqlUpdate);
        $sentenciaInsert->bind_param("ssssi", $nombre, $Fecha, $update, $usuarioUpdate, $idCurso);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Curso Actualizado Correctamente'
            );
        } else {
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Hubo un error al guardar los datos.'
            );
        }

        return $datos;

        // Cerrar la conexión
        $sentenciaInsert->close();
    }
}
