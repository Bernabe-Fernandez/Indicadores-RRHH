<?php
class Empleados
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllEmpleados()
    {
        // Preparar una declaración SQL
        $sql = "SELECT emp.idEmpleado, emp.Nombre, p.NombrePuesto, a.NombreArea, emp.Ingreso, emp.Egreso, emp.Estatus
                FROM rhhmorgall.empleados AS emp
                INNER JOIN rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                ORDER BY emp.Estatus DESC, a.NombreArea ASC;";
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

    public function getCountEmpleados()
    {
        // Preparar una declaración SQL
        $sql = "SELECT COUNT(*) AS Total FROM rhhmorgall.empleados AS emp WHERE emp.Estatus = '1' AND emp.Egreso IS NULL;";
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

    public function getEmpleadosActivos()
    {
        // Preparar una declaración SQL
        $sql = "SELECT emp.idEmpleado, emp.Nombre, p.NombrePuesto, a.NombreArea, emp.Ingreso, emp.Egreso, emp.Estatus
                FROM rhhmorgall.empleados AS emp
                INNER JOIN rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                WHERE emp.Estatus = '1';";
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

    public function getCountEmpleadosArea($area)
    {
        // Preparar una declaración SQL
        $sql = "SELECT COUNT(*) AS Total FROM rhhmorgall.Empleados AS emp WHERE emp.Estatus = '1' AND emp.Egreso IS NULL AND emp.Area = $area;";
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

    public function getEmpleadosArea()
    {
        // Preparar una declaración SQL
        $sql = "SELECT COUNT(*) AS Total, emp.Area, a.NombreArea
        FROM rhhmorgall.empleados AS emp 
        INNER JOIN rhhmorgall.areasmrg AS a ON a.idArea = emp.Area
        WHERE emp.Estatus = '1'
        GROUP BY Area;";
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

    public function createEmpleado($Nombre, $Curp, $RFC, $NSS, $Domicilio, $Contacto, $Celular, $Area, $Puesto, $observaciones, $Ingreso, $Estatus, $creacion, $userCreate)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.empleados (Nombre, CURP, RFC, NSS, domicilio, contacto, celular, Area, Puesto, Observacion,  Ingreso, Estatus, Creacion, userCreate, ultModifi, userModifi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("sssssssiisssssss", $Nombre, $Curp, $RFC, $NSS, $Domicilio, $Contacto, $Celular, $Area, $Puesto, $observaciones, $Ingreso, $Estatus, $creacion, $userCreate, $creacion, $userCreate);

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

    public function empleadosWhere($columna, $id)
    {
        // Preparar una declaración SQL
        $sql = "SELECT
                    emp.idEmpleado,
                    emp.Nombre,
                    emp.CURP,
                    emp.RFC,
                    emp.NSS,
                    emp.domicilio,
                    emp.contacto,
                    emp.celular,
                    p.idPuesto,
                    p.NombrePuesto,
                    a.idArea,
                    a.NombreArea,
                    emp.Ingreso,
                    emp.Egreso,
                    emp.Estatus,
                    emp.Observacion
                FROM 
                    rhhmorgall.empleados AS emp
                INNER JOIN
                    rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN 
                    rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                WHERE $columna = ?;";
        $selectSQL = $this->conexion->prepare($sql);
        if ($selectSQL) {
            // Vincular el parámetro
            $selectSQL->bind_param("s", $id);
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

    public function editEmpleado($id, $Nombre, $Curp, $RFC, $NSS, $Domiclio, $contacto, $celular, $Area, $Puesto, $Observacion, $Ingreso, $Estatus, $modificacion, $userModifi)
    {
        //crear tabla para modificar el puesto del usuario
        $dato = $this->consultarEmp($id);
        $actualizacion = true;
        if ($dato['Area'] != $Area) {
            //hacemos el registro nueva tabla
            // $datos = "Insertar nueva tabla porque area cambio...";
            $actualizacion = $this->insertPromocionLaboral($id, $dato['Area'], $dato['Puesto'], $Area, $Puesto, $userModifi);
        } else {
            if ($dato['Puesto'] != $Puesto) {
                //hacemos el registro
                // $datos = "Insertar nueva tabla porque puesto cambio...";
                $actualizacion = $this->insertPromocionLaboral($id, $dato['Area'], $dato['Puesto'], $Area, $Puesto, $userModifi);
            }
        }
        if ($actualizacion == false) {
            $datos = array(
                'icono' => "error",
                'mensaje' => "No se pudo crear el registro"
            );
        } else {
            //Sentencia preparada para insertar datos de forma segura
            $sqlUpdate = "UPDATE rhhmorgall.empleados SET Nombre = ?, CURP = ?, RFC = ?, NSS = ?, domicilio = ?, contacto = ?, celular = ?, Area = ?, Puesto = ?, Observacion = ?,  Ingreso = ?, Estatus = ?, ultModifi = ?, userModifi = ? WHERE idEmpleado = ?";
            $sentenciaInsert = $this->conexion->prepare($sqlUpdate);

            $sentenciaInsert->bind_param("sssssssiisssssi", $Nombre, $Curp, $RFC, $NSS, $Domiclio, $contacto, $celular, $Area, $Puesto, $Observacion, $Ingreso, $Estatus, $modificacion, $userModifi, $id);

            //Ejecutar la sentencia
            if ($sentenciaInsert->execute()) {
                $datos = array(
                    'icono' => 'success',
                    'mensaje' => 'Actualización del empleado existosa'
                );
            } else {
                $datos = array(
                    'icono' => 'success',
                    'mensaje' => 'Hubo un error al guardar los datos.'
                );
            }
        }



        return $datos;

        // // Cerrar la conexión
        $sentenciaInsert->close();
    }

    public function bajaEmpleado($id, $Egreso, $Estatus, $comentario, $Motivo, $modificacion, $userModifi)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlUpdate = "UPDATE rhhmorgall.empleados SET Egreso = ?, Estatus = ?, MotivoEgreso = ?, ComentarioEgreso = ?, ultModifi = ?, userModifi = ? WHERE idEmpleado = ?";
        $sentenciaInsert = $this->conexion->prepare($sqlUpdate);

        $sentenciaInsert->bind_param("ssisssi", $Egreso, $Estatus, $Motivo, $comentario, $modificacion, $userModifi, $id);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Se ha dado de baja al empleado exitosamente.'
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

    public function getEmpleadosAlta()
    {
        // Preparar una declaración SQL
        $sql = "SELECT emp.idEmpleado, emp.Nombre, p.NombrePuesto, a.NombreArea, emp.Ingreso
                FROM rhhmorgall.empleados AS emp
                INNER JOIN rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                WHERE emp.Ingreso LIKE '2024-%';";
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

    public function getEmpleadosBaja()
    {
        // Preparar una declaración SQL
        $sql = "SELECT emp.idEmpleado, emp.Nombre, p.NombrePuesto, a.NombreArea, emp.Egreso, mb.MotivoBaja, emp.Observacion
                FROM rhhmorgall.empleados AS emp
                INNER JOIN rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                INNER JOIN rhhmorgall.motivosBaja AS mb ON emp.MotivoEgreso = mb.idMotivosBaja
                WHERE emp.Egreso LIKE '202%-%';";
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

    public function countBajas($anio)
    {
        // Preparar una declaración SQL
        $sql = "SELECT 
                    COUNT(*) AS TotalBajas 
                FROM 
                    rhhmorgall.empleados AS emp
                WHERE 
                    emp.Egreso LIKE '$anio-%';";
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

    public function countAltas($anio)
    {
        // Preparar una declaración SQL
        $sql = "SELECT 
                    COUNT(*) AS TotalAltas 
                FROM 
                    rhhmorgall.Empleados AS emp 
                WHERE 
                    emp.Ingreso LIKE '$anio-%';";
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

    public function filtroAltas($area, $anio)
    {
        $sql = "SELECT 
                    COUNT(*) AS TotalAltas 
                FROM 
                    rhhmorgall.Empleados AS emp 
                WHERE 
                    emp.Estatus = '1' AND emp.Ingreso LIKE '$anio-%' AND emp.Area = $area;";
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

    public function filtroBajas($area, $anio)
    {
        $sql = "SELECT 
                    COUNT(*) AS TotalBajas 
                FROM 
                    rhhmorgall.empleados AS emp 
                WHERE 
                    emp.Estatus = '0' AND emp.Egreso LIKE '$anio-%' AND emp.Area = $area;";
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

    public function altasTotales($anio)
    {
        $sql = "SELECT 
                    'Total' AS AREA, COUNT(*) AS total_altas
                FROM 
                    rhhmorgall.empleados AS e
                WHERE 
                    e.Ingreso LIKE '$anio-%'
                UNION ALL
                SELECT 
                    a.NombreArea AS AREA, COUNT(*) AS total_altas
                FROM 
                    rhhmorgall.empleados AS e
                INNER JOIN 
                    rhhmorgall.areasmrg AS a ON a.idArea = e.area
                WHERE 
                    e.Ingreso LIKE '$anio-%'
                GROUP BY 
                    AREA;";
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

    public function bajasTotales($anio)
    {
        $sql = "SELECT 
                    'Total' AS AREA, COUNT(*) AS total_bajas
                FROM 
                    rhhmorgall.empleados AS e
                WHERE 
                    e.Egreso LIKE '$anio-%'
                UNION ALL
                SELECT 
                    a.NombreArea AS AREA, COUNT(*) AS total_bajas
                FROM 
                    rhhmorgall.empleados AS e
                INNER JOIN 
                    rhhmorgall.areasmrg AS a ON a.idArea = e.area
                WHERE 
                    e.Egreso LIKE '$anio-%'
                GROUP BY 
                    AREA;";
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

    public function getAreaUsuario($idEmpleado)
    {
        // Preparar una declaración SQL
        $sql = "SELECT idEmpleado, Nombre, Area, Puesto
                FROM rhhmorgall.empleados
                WHERE idEmpleado = ?;";
        $selectSQL = $this->conexion->prepare($sql);
        if ($selectSQL) {
            // Vincular el parámetro
            $selectSQL->bind_param("i", $idEmpleado);
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

    public function getEmpFinanzas($usuario)
    {
        // Preparar una declaración SQL
        $sql = "SELECT * FROM rhhmorgall.empleados
                WHERE AREA = 8 AND estatus = '1' AND Egreso IS NULL
                UNION ALL
                SELECT * FROM rhhmorgall.empleados
                WHERE AREA = 3 AND estatus = '1' AND Egreso IS NULL AND idEmpleado != $usuario
                UNION ALL
                SELECT * FROM rhhmorgall.empleados
                WHERE Nombre LIKE '%JANETH';";
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

    public function getEmpEvaluacion($area, $usuario)
    {
        // Preparar una declaración SQL
        $sql = "SELECT * FROM rhhmorgall.empleados
                WHERE Area = $area AND estatus = '1' AND Egreso IS NULL AND idEmpleado != $usuario;";
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

    public function empleadosReporte($id){
        // Preparar una declaración SQL
        $sql = "SELECT
                    emp.idEmpleado,
                    emp.Nombre,
                    emp.CURP,
                    emp.RFC,
                    emp.NSS,
                    emp.domicilio,
                    emp.contacto,
                    emp.celular,
                    p.idPuesto,
                    p.NombrePuesto,
                    a.idArea,
                    a.NombreArea,
                    emp.Ingreso,
                    emp.Egreso,
                    emp.MotivoEgreso,
                    m.MotivoBaja,
                    emp.Estatus,
                    emp.Observacion,
                    emp.ComentarioEgreso
                FROM 
                    rhhmorgall.empleados AS emp
                INNER JOIN
                    rhhmorgall.puestos AS p ON emp.Puesto = p.idPuesto
                INNER JOIN 
                    rhhmorgall.areasmrg AS a ON p.Area = a.idArea
                LEFT JOIN
                    rhhmorgall.motivosbaja AS m ON emp.MotivoEgreso = m.idMotivosBaja
                WHERE emp.idEmpleado = ?;";
        $selectSQL = $this->conexion->prepare($sql);
        if ($selectSQL) {
            // Vincular el parámetro
            $selectSQL->bind_param("i", $id);
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

    public function getEmpleadoData($idEmpleado){
        // Preparar una declaración SQL
        $sql = "SELECT 
                    emp.idEmpleado AS idEmpleado,
                    emp.Nombre AS nombre,
                    ar.NombreArea AS area,
                    pu.NombrePuesto AS puesto
                FROM 
                    rhhmorgall.empleados AS emp
                INNER JOIN
                    rhhmorgall.areasmrg AS ar ON emp.Area = ar.idArea
                INNER JOIN
                    rhhmorgall.puestos AS pu ON ar.idArea = pu.Area AND emp.Puesto = pu.idPuesto
                WHERE 
                    emp.idEmpleado = ? AND emp.Estatus = '1';";
        $selectSQL = $this->conexion->prepare($sql);
        $selectSQL->bind_param("s", $idEmpleado);
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


    public function getListaAsistencia($area, $usuario){
        // Preparar una declaración SQL
        $sql = "SELECT 
                    *
                FROM 
                    rhhmorgall.empleados
                WHERE 
                    estatus = '1' 
                    AND Egreso IS NULL
                    AND (
                        idEmpleado IN (9, 11, 16, 27, 28, 18, 40) -- IDs específicos
                        OR AREA = $area -- 
                    )
                    AND idEmpleado NOT IN ($usuario) 
                ORDER BY
                    AREA ASC
                    ";
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


    private function consultarEmp($idEmpleado)
    {
        // Preparar una declaración SQL
        $sql = "SELECT emp.idEmpleado, emp.Area, emp.Puesto, emp.Estatus
                FROM rhhmorgall.empleados AS emp
                WHERE emp.idEmpleado = $idEmpleado;";
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

    private function insertPromocionLaboral($idEmpleado, $areaAnt, $puestoAnt, $areaActual, $puestoActual, $created)
    {
        $fecha = date('Y-m-d');
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.promocioneslaborales (empleado, areaAnt, puestoAnt, areaActual, puestoActual, fechaM, userCreated, userUpdate) VALUES (?,?,?,?,?,?,?,?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("iiiiisss", $idEmpleado, $areaAnt, $puestoAnt, $areaActual, $puestoActual, $fecha, $created, $created);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            $datos = true;
        } else {
            $datos = false;
        }
        return $datos;

        // Cerrar la conexión
        $sentenciaInsert->close();
    }
}
