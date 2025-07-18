<?php
class Faltas
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllFaltas()
    {
        // Preparar una declaración SQL
        $sql = "SELECT au.idAusentismo, au.Fecha, mf.NombreMotivo, emp.Nombre, p.NombrePuesto, a.NombreArea, au.Observaciones
                FROM rhhmorgall.ausentismo AS au
                INNER JOIN rhhmorgall.empleados AS emp ON au.Empleado = emp.IdEmpleado
                INNER JOIN rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                INNER JOIN rhhmorgall.motivosfalta AS mf ON au.Motivo = mf.idMotivoFalta
                ORDER BY au.Fecha;";
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

    public function getCountFaltasMes($anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT
                    MONTH(Fecha) AS Mes, 
                    COUNT(*) AS TotalFaltas
                FROM 
                    rhhmorgall.ausentismo as a
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

    public function createFalta($idEmpleado, $fecha, $motivo, $observaciones, $archivo, $creacion, $userCreate)
    {
        //modificación de la unicación del archivo
        if ($archivo != "") {
            $extension = $this->obtenerExtension($archivo['name']);
            //Generar el nombre del archivo con el formato deseado
            $nombreArchivo = 'comprobanteAusencia-' . $idEmpleado . '-' . date('Y-m-d') . "." . $extension;;
            // Ruta donde se guardará el archivo
            $rutaArchivo = "D:/Ausencias/" . $nombreArchivo;
            // Mover el archivo cargado a la ubicación deseada
            if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
                // Guardar el nombre del archivo en la base de datos
                $nombreArchivoEnBD = $nombreArchivo;
            } else {
                $datos = array(
                    'icono' => 'error',
                    'mensaje' => "Error al mover el archivo a la ruta: $rutaArchivo"
                );
            }
        }
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.ausentismo (Empleado, Fecha, Motivo, Observaciones, Comprobante, creacion, userCreacion, ultModifi, userModifi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("issssssss", $idEmpleado, $fecha, $motivo, $observaciones, $nombreArchivoEnBD, $creacion, $userCreate, $creacion, $userCreate);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Se registro el ausentismo correctamente'
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

    public function getCountFaltasMesFiltro($filtro, $clausula, $anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(Fecha) AS Mes,
                    COUNT(*) AS TotalFaltas
                FROM 
                    rhhmorgall.ausentismo
                INNER JOIN 
                    rhhmorgall.empleados ON empleados.idEmpleado = ausentismo.Empleado
                INNER JOIN 
                    rhhmorgall.puestos ON puestos.idPuesto = empleados.Puesto
                INNER JOIN 
                    rhhmorgall.areasmrg ON areasmrg.idArea = empleados.Area
                INNER JOIN 
                    rhhmorgall.motivosfalta ON motivosfalta.idMotivoFalta = ausentismo.Motivo
                WHERE 
                    rhhmorgall.$clausula = ? AND rhhmorgall.ausentismo.Fecha LIKE '$anio-%'
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

    public function getComprobanteFalta($idAusentismo){
        //Preparar una declaración SQL
        $sql = "SELECT idAusentismo, Comprobante
                FROM rhhmorgall.Ausentismo
                WHERE idAusentismo = $idAusentismo";
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


    function obtenerExtension($nombreArchivo)
    {
        return pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    }
}
