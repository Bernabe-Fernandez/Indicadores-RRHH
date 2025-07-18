<?php
class Juntas
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllJuntas()
    {
        // Preparar una declaración SQL
        $sql = "SELECT
                    j.id AS idJunta,
                    j.idGerente AS IdGerente,
                    emp.Nombre AS nombreGerente,
                    j.area_id AS idArea,
                    ar.NombreArea AS nombreArea,
                    j.fecha AS fecha,
                    j.hora AS hora,
                    j.temas AS temas,
                    j.notas AS notas,
                    j.periodo AS idPeriodo,
                    pe.name AS nombrePeriodo,
                    GROUP_CONCAT(asis_emp.nombre SEPARATOR ', ') AS asistentes
                FROM
                    rhhmorgall.juntas AS j
                LEFT JOIN
                    rhhmorgall.empleados AS emp ON emp.idEmpleado = j.idGerente
                LEFT JOIN 
                    rhhmorgall.asistencias a ON j.id = a.junta_id
                LEFT JOIN
                    rhhmorgall.areasmrg AS ar ON ar.idArea = j.area_id
                LEFT JOIN
                    rhhmorgall.periodos AS pe ON pe.id = j.periodo
                LEFT JOIN
                    rhhmorgall.empleados AS asis_emp ON a.empleado_id = asis_emp.idEmpleado
                GROUP BY
                    j.id;";
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

    public function getInfoJunta($idJunta){
        // Preparar una declaración SQL
        $sql = "SELECT
                    j.id as idJunta,
                    j.idGerente AS IdGerente,
                    emp.Nombre AS nombreGerente,
                    j.area_id AS idArea,
                    ar.NombreArea AS nombreArea,
                    j.fecha AS fecha,
                    j.hora AS hora,
                    j.temas AS temas,
                    j.notas AS notas,
                    j.periodo AS idPeriodo,
                    j.temas as temas,
                    pe.name AS nombrePeriodo,
                    GROUP_CONCAT(asis_emp.nombre SEPARATOR ', ') AS asistentes
                FROM
                    rhhmorgall.juntas AS j
                LEFT JOIN
                    rhhmorgall.empleados AS emp ON emp.idEmpleado = j.idGerente
                LEFT JOIN 
                    rhhmorgall.asistencias a ON j.id = a.junta_id
                LEFT JOIN
                    rhhmorgall.areasmrg AS ar ON ar.idArea = j.area_id
                LEFT JOIN
                    rhhmorgall.periodos AS pe ON pe.id = j.periodo
                LEFT JOIN
                    rhhmorgall.empleados AS asis_emp ON a.empleado_id = asis_emp.idEmpleado
                WHERE
                    j.id = $idJunta
                GROUP BY
                    j.id;";
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


    public function createJunta($gerenteJunta, $areaId, $periodoJunta,  $fechaJunta, $horaJunta, $temasJunta, $comentariosJunta, $asistentes, $user, $idUser){
        try {
            $this->conexion->begin_transaction();

            $insertJunta = "INSERT INTO rhhmorgall.juntas (idGerente, area_id, fecha, hora, temas, notas, periodo, userCreate, userModifi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $sentenciaInsert = $this->conexion->prepare($insertJunta);

            // Vincular parámetros
            $sentenciaInsert->bind_param("iissssiss", $idUser, $areaId, $fechaJunta, $horaJunta, $temasJunta, $comentariosJunta, $periodoJunta, $user, $user);

            // Ejecutar la sentencia
            if (!$sentenciaInsert->execute()) {
                throw new Exception("Error al insertar en tabla juntas: " . $sentenciaInsert->error);
            }

            $idJunta = $sentenciaInsert->insert_id;
            $sentenciaInsert->close();


            $insertAsistentes = "INSERT INTO rhhmorgall.asistencias (junta_id, empleado_id, userCreate, userModifi) VALUES (?, ?, ?, ?)";
            $sentenciaInsertAsis = $this->conexion->prepare($insertAsistentes);

            foreach ($asistentes as $asistente) {

                // echo $asistente['id'];
                $sentenciaInsertAsis->bind_param("iiss", $idJunta, $asistente['id'], $user, $user);
                if (!$sentenciaInsertAsis->execute()) {
                    throw new Exception("Error al insertar las asistencias: " . $sentenciaInsertAsis->error);
                }
            }
            $sentenciaInsertAsis->close();

            // Confirmar transacción
            $this->conexion->commit();
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Registro Creado con exito'
            );

        } catch (Exception $e) {
            $this->conexion->rollback();
            $datos = array(
                'icono' => 'error',
                'mensaje' => $e->getMessage()
            );
        }

        return $datos;
    }

    public function deleteJuntas($idJunta)
    {
        try {
            $this->conexion->begin_transaction();

            $deleteJunta = "DELETE FROM rhhmorgall.juntas WHERE id = ?;";

            $sentenciaDelete = $this->conexion->prepare($deleteJunta);

            // Vincular parámetros
            $sentenciaDelete->bind_param("i", $idJunta);

            // Ejecutar la sentencia
            if (!$sentenciaDelete->execute()) {
                throw new Exception("Error al eliminar el registro: " . $sentenciaDelete->error);
            }

            
            $sentenciaDelete->close();

            // Confirmar transacción
            $this->conexion->commit();
            $datos = array(
                'icono' => 'warning',
                'mensaje' => 'Registro Eliminado con exito'
            );

        } catch (Exception $e) {
            $this->conexion->rollback();
            $datos = array(
                'icono' => 'error',
                'mensaje' => $e->getMessage()
            );
        }

        return $datos;
    }
}
