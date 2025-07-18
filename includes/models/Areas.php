<?php
class Areas
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAreas()
    {
        // Preparar una declaración SQL
        $sql = "SELECT *
                FROM rhhmorgall.areasmrg
                WHERE estatus = '1'
                ORDER BY NombreArea;";
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

    public function getAllAreas(){
        // Preparar una declaración SQL
        $sql = "SELECT *
                FROM rhhmorgall.areasmrg
                ORDER BY NombreArea;";
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

    public function getAreasWhere($idArea){
        // Preparar una declaración SQL
        $sql = "SELECT *
                FROM rhhmorgall.areasmrg
                WHERE idArea = $idArea;";
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

    public function createAreas($nombreArea, $usuario, $vacantes)
    {
        // Inicializar el array de respuesta
        $datos = array();

        // Sentencia preparada para insertar datos de forma segura en la tabla areasmrg
        $sqlInsertArea = "INSERT INTO rhhmorgall.areasmrg (NombreArea, userCreate, userModifi) VALUES (?, ?, ?)";
        $sentenciaInsertArea = $this->conexion->prepare($sqlInsertArea);

        // Verificar si la sentencia fue preparada correctamente
        if ($sentenciaInsertArea === false) {
            $datos = array(
                'icono' => 'error',
                'mensaje' => 'Error al preparar la consulta: ' . $this->conexion->error
            );
            return $datos;
        }

        // Vincular parámetros
        $sentenciaInsertArea->bind_param("sss", $nombreArea, $usuario, $usuario);

        // Ejecutar la sentencia
        if ($sentenciaInsertArea->execute()) {
            // Obtener el ID de la última fila insertada
            $idArea = $this->conexion->insert_id;

            // Sentencia preparada para insertar datos de forma segura en la tabla vacantes
            $sqlInsertVacantes = "INSERT INTO rhhmorgall.vacantes (Area, PAutorizada, userCreate, userModifi) VALUES (?, ?, ?, ?)";
            $sentenciaInsertVacantes = $this->conexion->prepare($sqlInsertVacantes);

            // Verificar si la sentencia fue preparada correctamente
            if ($sentenciaInsertVacantes === false) {
                $datos = array(
                    'icono' => 'error',
                    'mensaje' => 'Error al preparar la consulta: ' . $this->conexion->error
                );
                return $datos;
            }

            // Vincular parámetros
            $sentenciaInsertVacantes->bind_param("isss", $idArea, $vacantes, $usuario, $usuario);

            // Ejecutar la sentencia
            if ($sentenciaInsertVacantes->execute()) {
                $datos = array(
                    'icono' => 'success',
                    'mensaje' => 'Registro Correcto'
                );
            } else {
                $datos = array(
                    'icono' => 'error',
                    'mensaje' => 'Hubo un error al guardar los datos en vacantes: ' . $sentenciaInsertVacantes->error
                );
            }

            // Cerrar la sentencia preparada para vacantes
            $sentenciaInsertVacantes->close();
        } else {
            $datos = array(
                'icono' => 'error',
                'mensaje' => 'Hubo un error al guardar los datos en areasmrg: ' . $sentenciaInsertArea->error
            );
        }

        // Cerrar la sentencia preparada para areasmrg
        $sentenciaInsertArea->close();

        return $datos;
    }


    public function updateArea($idArea, $estatus, $usuario)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlUpdate = "UPDATE rhhmorgall.areasmrg SET estatus = ?, userModifi = ? WHERE idArea = ?";
        $sentenciaInsert = $this->conexion->prepare($sqlUpdate);

        $sentenciaInsert->bind_param("ssi", $estatus, $usuario, $idArea);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Update Correcto'
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
