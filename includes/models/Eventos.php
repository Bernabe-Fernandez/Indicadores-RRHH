<?php
class Eventos
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function getAllEventos()
    {
        // Preparar una declaración SQL
        $sql = "SELECT * FROM rhhmorgall.eventos";
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

    public function createEvento($Evento, $fechaEvento, $creacion, $usuarioCreacion)
    {
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.eventos (NombreEvento, Fecha, creacion, userCreate, ultModifi, userModifi) VALUES (?, ?, ? ,?,?,?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("ssssss", $Evento, $fechaEvento, $creacion, $usuarioCreacion, $creacion, $usuarioCreacion);

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

    public function getCountEventosMes($anio)
    {
        //Preparar una declaración SQL
        $sql = "SELECT 
                    MONTH(Fecha) AS Mes, 
                    COUNT(*) AS TotalEventos
                FROM 
                    rhhmorgall.eventos as e
                WHERE
                    e.Fecha LIKE '$anio-%'
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
}
