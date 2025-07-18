<?php
class PromocionesLabo
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllPromocionesL()
    {
        // Preparar una declaración SQL
        $sql = "SELECT p.idPromocion, emp.Nombre, a_anterior.NombreArea AS areaAnt, p_anterior.NombrePuesto AS puestoAnt, a_actual.NombreArea AS areaActual, p_actual.NombrePuesto AS puestoActual, p.comentario, p.fechaM AS fechaProm
                FROM rhhmorgall.promocioneslaborales AS p
                JOIN rhhmorgall.empleados AS emp ON p.empleado = emp.idEmpleado
                JOIN rhhmorgall.areasmrg AS a_anterior ON a_anterior.idArea = p.areaAnt
                JOIN rhhmorgall.areasmrg AS a_actual ON a_actual.idArea = p.areaActual
                JOIN rhhmorgall.puestos AS p_anterior ON p_anterior.idPuesto = p.puestoAnt
                JOIN rhhmorgall.puestos AS p_actual ON p_actual.idPuesto = p.puestoActual";
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

    public function getOnePromocionL($idPromocion)
    {
        // Preparar una declaración SQL
        $sql = "SELECT p.idPromocion, emp.Nombre, a_anterior.NombreArea AS areaAnt, p_anterior.NombrePuesto AS puestoAnt, a_actual.NombreArea AS areaActual, p_actual.NombrePuesto AS puestoActual, p.comentario, p.fechaM AS fechaProm
                FROM rhhmorgall.promocioneslaborales AS p
                JOIN rhhmorgall.empleados AS emp ON p.empleado = emp.idEmpleado
                JOIN rhhmorgall.areasmrg AS a_anterior ON a_anterior.idArea = p.areaAnt
                JOIN rhhmorgall.areasmrg AS a_actual ON a_actual.idArea = p.areaActual
                JOIN rhhmorgall.puestos AS p_anterior ON p_anterior.idPuesto = p.puestoAnt
                JOIN rhhmorgall.puestos AS p_actual ON p_actual.idPuesto = p.puestoActual
                WHERE p.idPromocion = $idPromocion;";
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

    public function updatePromocionL($idPromocion, $comentario, $fechaM, $usuarioModifi)
    {
        $sqlUpdate = "UPDATE rhhmorgall.promocioneslaborales SET comentario = ?, fechaM = ?, userUpdate = ? WHERE idPromocion = ?";
        $sentenciaInsert = $this->conexion->prepare($sqlUpdate);
        $sentenciaInsert->bind_param("sssi", $comentario, $fechaM, $usuarioModifi, $idPromocion);

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

    public function getCountMesPromocionL($anio)
    {
        // Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(fechaM) AS Mes, 
                    COUNT(*) AS TotalProm
                FROM 
                    rhhmorgall.promocioneslaborales AS pl
                WHERE 
                    pl.fechaM LIKE '$anio-%'
                GROUP BY 
                    MONTH(fechaM)
                ORDER BY 
                    Mes;";
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
}
