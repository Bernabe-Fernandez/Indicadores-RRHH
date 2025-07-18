<?php
class Encuestas
{
    private $conexion;
    public $datos = array();


    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function createEncuestaSalida($empleado, $egreso, $motivo,$especifique, $relacionJ, $trato, $relacionC, $gusto, $disgusto, $mejora, $recomendacion, $comentario){
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.encuestasalida (empleado, egreso, motivo, especifique, relacionJ, trato, relacionC, gusto, disgusto, mejora, recomendacion, comentario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("issssissssss", $empleado, $egreso, $motivo, $especifique, $relacionJ, $trato, $relacionC, $gusto, $disgusto, $mejora, $recomendacion, $comentario);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            //UN AÑO ENCUESTA DE SALIDA
            setcookie('encuestaSalida', '1', time() + (365 * 24 * 60 * 60), "/");
            // setcookie('formulario_enviado', '1', time() + 150, "/");
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Gracias por tu respuesta'
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

    public function createEncuestaClima($relacionJ, $relacionD, $relacionG, $apoyo, $apoyar, $gustoC, $disgustoC, $comodo, $climaL, $mejoras, $esfuerzoF, $accidenT, $actPeligrosas, $tiempoExt, $trabajarSp, $trabajoAc, $concentrado, $memorizarInf, $variosAsu,$acosoL, $acosoEsp, $sucesoLab, $sucesoEsp){
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.climalaboral (relacionJ, relacionD, relacionG, apoyo, apoyar, gustoC, disgustoC, comodo, climaL, mejoras, esfuerzoF, accidenteT, actPeligrosas, tiempoEx, trabajarSp, trabajoAc, concentrado, memorizarInf, variosAsu, acosoL, acosoEsp, sucesoLab, sucesoEsp) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("sssssssssssssssssssssss", $relacionJ, $relacionD, $relacionG, $apoyo, $apoyar, $gustoC, $disgustoC, $comodo, $climaL, $mejoras, $esfuerzoF, $accidenT, $actPeligrosas, $tiempoExt, $trabajarSp, $trabajoAc, $concentrado, $memorizarInf, $variosAsu,$acosoL, $acosoEsp, $sucesoLab, $sucesoEsp);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            //60 DÍAS PARA REACTIVACIÓN CLIMA LABORAL
            // setcookie('climaLaboral', '1', time() + (60 * 24 * 60 * 60), "/");
            setcookie('climaLaboral', '1', time() + 60, "/");
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Gracias por tu respuesta'
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

    public function createEncuestaD($empleado, $jefeD, $fechaAp, $antiguedad, $potencial, $calidad, $consistencia, $comunicacion, $independiente, $iniciativa, $equipo, $producti, $creatividad, $honestidad, $integridad, $relacionInt, $relacionExt, $habilidadT, $fiabilidad, $puntualidad, $asistencia, $interes, $compromiso, $resultado, $comentarios, $user){
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.evaluaciondesem (empleado, jefeD, fechaAp, antiguedad, potencial, calidad, consistencia, comunicacion, independiente, iniciativa, equipo, producti, creatividad, honestidad, integridad, relacionInt, relacionExt, habilidadT, fiabilidad, puntualidad, asistencia, interes, compromiso, resultado, comentarios, userCraeted, userUpdate) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("sssssssssssssssssssssssssss", $empleado, $jefeD, $fechaAp, $antiguedad, $potencial, $calidad, $consistencia, $comunicacion, $independiente, $iniciativa, $equipo, $producti, $creatividad, $honestidad, $integridad, $relacionInt, $relacionExt, $habilidadT, $fiabilidad, $puntualidad, $asistencia, $interes, $compromiso, $resultado, $comentarios, $user, $user);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            // setcookie('formulario_enviado', '1', time() + (167.292 * 24 * 60 * 60), "/");
            // setcookie('formulario_enviado', '1', time() + 150, "/");
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Gracias por tu respuesta'
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

    public function createAutoDesem($empleadoAu, $misionAu, $visionAu, $objetivosAu, $supervisionAu, $independienteAu,$ayudaAu, $aportacionAu, $innovadorAu, $influenciaAu, $lograrAu, $imprevistosAu, $comunicacionAu, $cooperasAu, $compromisoAu, $horarioAu, $puntualidadAu, $identificarAu, $iniciativaAu, $trabajoEquiAu, $futuroAu, $estrategiasAu, $equipoAu, $confianzaAu, $efectivoAu, $recursosAu, $ordenesAu, $capacidadAu, $potencialAu, $resultadosAu, $destrezaAu, $trabajoAu, $desempenoAu){
        //Sentencia preparada para insertar datos de forma segura
        $sqlInsert = "INSERT INTO rhhmorgall.autoevaluaciond (empleado, mision, vision, objetivos, supervision, independiente, ayuda, aportaciones, innovador, influencia, lograr, imprevistos, comunicacion, cooperacion, compromiso, horario, puntualidad, identificar, iniciativa, trabajoEqui, futuro, estrategias, equipo, confianza, efectivo, recursos, ordenes,capacidad, potencial, resultados, trabajo, destreza, desempenoG) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sentenciaInsert = $this->conexion->prepare($sqlInsert);

        // Vincular parámetros
        $sentenciaInsert->bind_param("issssssssssssssssssssssssssssssss", $empleadoAu, $misionAu, $visionAu, $objetivosAu, $supervisionAu, $independienteAu,$ayudaAu, $aportacionAu, $innovadorAu, $influenciaAu, $lograrAu, $imprevistosAu, $comunicacionAu, $cooperasAu, $compromisoAu, $horarioAu, $puntualidadAu, $identificarAu, $iniciativaAu, $trabajoEquiAu, $futuroAu, $estrategiasAu, $equipoAu, $confianzaAu, $efectivoAu, $recursosAu, $ordenesAu, $capacidadAu, $potencialAu, $resultadosAu,$trabajoAu, $destrezaAu, $desempenoAu);

        //Ejecutar la sentencia
        if ($sentenciaInsert->execute()) {
            // setcookie('formulario_enviado', '1', time() + (167.292 * 24 * 60 * 60), "/");
            //60 DÍAS PARA REACTIVAR
            setcookie('AutoevaluacionDesem', '1', time() + 120, "/");
            $datos = array(
                'icono' => 'success',
                'mensaje' => 'Gracias por tu respuesta'
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