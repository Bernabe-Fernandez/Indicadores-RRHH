<?php
class Capacitacion
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }



    public function getCapacitaciones()
    {
        // Preparar una declaración SQL
        $sql = "SELECT cap.Nombre, emp.Nombre AS Empleado, cap.Fecha, pue.NombrePuesto, ar.NombreArea
        FROM rhhmorgall.capacitacionempleado AS cxe
        INNER JOIN rhhmorgall.empleados AS emp ON cxe.empleado = emp.idEmpleado
        INNER JOIN rhhmorgall.capacitacion AS cap ON cxe.capacitacion = cap.idCapacitacion
        INNER JOIN rhhmorgall.puestos AS pue ON emp.Puesto = pue.idPuesto
        INNER JOIN rhhmorgall.areasmrg AS ar ON emp.Area = ar.idArea;";
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

    public function getCountCapacitacionMes($anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(Fecha) AS Mes,
                    COUNT(*) AS TotalCapacitacion
                FROM 
                    rhhmorgall.capacitacion AS c
                WHERE
                    c.Fecha LIKE '$anio-%'
                GROUP BY 
                    MONTH(Fecha)
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

    public function getCountCapacitacionMesFiltro($filtro, $clausula, $anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(cap.Fecha) AS Mes,
                    COUNT(DISTINCT cxe.capacitacion) AS TotalCapacitacion
                FROM 
                    rhhmorgall.capacitacionempleado AS cxe
                INNER JOIN 
                    rhhmorgall.empleados AS emp ON cxe.empleado = emp.idEmpleado
                INNER JOIN 
                    rhhmorgall.capacitacion AS cap ON cxe.capacitacion = cap.idCapacitacion
                INNER JOIN 
                    rhhmorgall.puestos AS pue ON emp.Puesto = pue.idPuesto
                INNER JOIN 
                    rhhmorgall.areasmrg AS ar ON emp.Area = ar.idArea
                WHERE 
                    rhhmorgall.$clausula = ? AND cap.Fecha LIKE '$anio-%'
                GROUP BY 
                    MONTH(cap.Fecha)
                ORDER BY 
                    Mes;";
        $selectSQL = $this->conexion->prepare($sql);
        // Vincular parámetros
        $selectSQL->bind_param("i", $filtro);
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

    public function createCapacitacion($empleado, $curso, $creacion, $usuarioCreate)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.capacitacionempleado (capacitacion, empleado, creacion, userCreate, ultModifi, userModifi) VALUES (?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("iissss", $curso, $empleado, $creacion, $usuarioCreate, $creacion, $usuarioCreate);

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
}
