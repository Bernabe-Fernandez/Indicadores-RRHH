<?php
class Evaluaciones
{
      private $conexion;
      public $datos = array();


      public function __construct($conexion)
      {
            $this->conexion = $conexion;
      }

      public function getAllEvaluacionesD()
      {
            // Preparar una declaración SQL
            $sql = "SELECT ed.idEvaluacionD, emp.Nombre, a.NombreArea, p.NombrePuesto, ed.jefeD, ed.fechaAp
                  FROM rhhmorgall.evaluaciondesem AS ed
                  INNER JOIN rhhmorgall.empleados AS emp ON emp.idEmpleado = ed.empleado
                  INNER JOIN rhhmorgall.puestos AS p ON p.idPuesto = emp.Puesto
                  INNER JOIN rhhmorgall.areasmrg AS a ON a.idArea = emp.Area
                  ORDER BY ed.fechaAp DESC;";
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

      public function getAllAutoEvaluacionesD()
      {
            // Preparar una declaración SQL
            $sql = "SELECT au.idAutoEva, emp.Nombre, a.NombreArea, p.NombrePuesto, CAST(au.created AS DATE) AS fechaAp
            FROM rhhmorgall.autoevaluaciond AS au
            INNER JOIN rhhmorgall.empleados AS emp ON emp.idEmpleado = au.empleado
            INNER JOIN rhhmorgall.puestos AS p ON p.idPuesto = emp.Puesto
            INNER JOIN rhhmorgall.areasmrg AS a ON a.idArea = emp.Area
            ORDER BY au.created DESC;";
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

      public function getOneEvaluacionesD($idEvaluacion)
      {
            // Preparar una declaración SQL
            $sql = "SELECT ed.*, emp.Nombre, a.NombreArea, p.NombrePuesto
            FROM rhhmorgall.evaluaciondesem AS ed
            INNER JOIN rhhmorgall.empleados AS emp ON emp.idEmpleado = ed.empleado
            INNER JOIN rhhmorgall.puestos AS p ON p.idPuesto = emp.Puesto
            INNER JOIN rhhmorgall.areasmrg AS a ON a.idArea = emp.Area
            WHERE idEvaluacionD = $idEvaluacion;";
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

      public function getOneAutoEvaluacionesD($idAutoEvaluacion)
      {
            // Preparar una declaración SQL
            $sql = "SELECT au.*, emp.Nombre, a.NombreArea, p.NombrePuesto, CAST(au.created AS DATE) AS fechaAp
            FROM rhhmorgall.autoevaluaciond AS au
            INNER JOIN rhhmorgall.empleados AS emp ON emp.idEmpleado = au.empleado
            INNER JOIN rhhmorgall.puestos AS p ON p.idPuesto = emp.Puesto
            INNER JOIN rhhmorgall.areasmrg AS a ON a.idArea = emp.Area
            WHERE idAutoEva = $idAutoEvaluacion;";
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

      public function getCountMesEvaluaciones($anio){
            // Preparar una declaración SQL
            $sql = "SELECT 
                        MONTH(fechaAp) AS Mes,
                        COUNT(*) AS TotalEva
                  FROM 
                        rhhmorgall.evaluaciondesem
                  WHERE 
                        fechaAp LIKE '$anio-%'
                  GROUP BY 
                        MONTH(fechaAp)
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

      public function getCountMesAevaluaciones($anio){
            // Preparar una declaración SQL
            $sql = "SELECT 
                        MONTH(created) AS Mes,
                        COUNT(*) AS TotalAutoE
                  FROM 
                        rhhmorgall.autoevaluaciond
                  WHERE 
                        created LIKE '$anio-%'
                  GROUP BY 
                        MONTH(created)
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
