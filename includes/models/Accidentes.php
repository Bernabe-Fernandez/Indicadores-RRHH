<?php
class Accidentes
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAccidentes()
    {
        // Preparar una declaración SQL
        $sql = "SELECT 
                    a.idAccidente, e.Nombre, p.NombrePuesto, ar.NombreArea, a.Fecha, a.Tipo, a.Incapacidad
                FROM
                    rhhmorgall.accidentes AS a
                INNER JOIN 
                    rhhmorgall.empleados AS e ON a.Empleado = e.idEmpleado
                INNER JOIN 
                    rhhmorgall.puestos AS p ON p.idPuesto = e.Puesto
                INNER JOIN 
                    rhhmorgall.areasmrg as ar ON ar.idArea = e.Area;";
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

    public function createAccidente($empleado, $fecha, $tipo, $incapacidad, $creacion, $UsuarioCreacion)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.accidentes (Empleado, Fecha, Tipo, Incapacidad, creacion, usuarioCreate, ultModificacion, usuarioModifi) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("isssssss", $empleado, $fecha, $tipo, $incapacidad, $creacion, $UsuarioCreacion, $creacion, $UsuarioCreacion);

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


    public function getCountAccidentesMes($anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(Fecha) AS Mes,
                    COUNT(*) AS TotalAccidente 
                FROM 
                    rhhmorgall.accidentes AS a
                WHERE
                    a.Fecha LIKE '$anio-%'
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

    public function getCountAccidentesMesFiltro($filtro, $clausula, $anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(Fecha) AS Mes, COUNT(*) AS TotalAccidente
                FROM 
                    rhhmorgall.accidentes as a
                INNER JOIN 
                    rhhmorgall.empleados ON empleados.idEmpleado = a.Empleado
                INNER JOIN 
                    rhhmorgall.puestos ON puestos.idPuesto = empleados.Puesto
                INNER JOIN 
                    rhhmorgall.areasmrg ON areasmrg.idArea = empleados.Area
                WHERE 
                    rhhmorgall.$clausula = ? AND
                    a.Fecha LIKE '$anio-%'
                GROUP BY 
                    MONTH(Fecha)
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
}
