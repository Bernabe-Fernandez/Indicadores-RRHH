<?php
//llamamos el archivo de configuracion
require_once '../config/bd.php';
//llamamos el archivo de lectura
require_once 'Encuestas.php';

//creamos una instancia de la bd
$bd = new Database();
//nos conectamos a la bd
$conexion = $bd->getConnection();
// Verifica si la conexión se estableció correctamente
if ($conexion != null) {
    //evaluamos si la conexion nos dio error
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    } else {
        $encuesta = new Encuestas($conexion);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['pagina'] === "salida") {
                $empleado = intval($_POST['colaborador']);
                $trato = intval($_POST['calificacionJ']);
                $egreso = $_POST['egresoC'];
                if ($_POST['motivoE'] == 'Otro') {
                    $especifique = $_POST['otroM'];
                }else{
                    $especifique = "";
                }
                $motivo = $_POST['motivoE'];
                $relacionJ = $_POST['relacionJ'];
                $relacionC = $_POST['relacionC'];
                $gusto = $_POST['gusto'];
                $disgusto = $_POST['disgusto'];
                $mejora = $_POST['mejora'];
                $recomendacion = $_POST['recomendacion'];
                $comentario = $_POST['comentario'];
                $response = $encuesta->createEncuestaSalida($empleado, $egreso, $motivo, $especifique, $relacionJ, $trato, $relacionC, $gusto, $disgusto, $mejora, $recomendacion, $comentario);
            }else if($_POST['pagina'] === "clima"){
                $relacionJ = $_POST['relacionJ']; 
                $relacionD = $_POST['relacionD']; 
                $relacionG = $_POST['relacionG']; 
                $apoyo = $_POST['apoyo']; 
                $apoyar = $_POST['apoyar']; 
                $gustoC = $_POST['gustoC']; 
                $disgustoC = $_POST['disgustoC']; 
                $comodo = $_POST['comodo']; 
                $climaL = $_POST['climaL']; 
                $mejoras = $_POST['mejoras'];
                $esfuerzoF = $_POST['esfuerzoF'];
                $accidenT = $_POST['accidente'];
                $actPeligrosas = $_POST['peligro'];
                $tiempoExt = $_POST['tAdicional'];
                $trabajarSp = $_POST['Tsinparar'];
                $trabajoAc = $_POST['Tacelerado'];
                $concentrado = $_POST['concentracion'];
                $memorizarInf = $_POST['memoriceInfo'];
                $variosAsu = $_POST['variosAsun'];
                    $acosoL = $_POST['acosoL'];
                $acosoEsp = null;
                if($_POST['acosoEsp'] != ""){
                    $acosoEsp = $_POST['acosoEsp'];
                }
                $sucesoLab = $_POST['sucesoLaboral'];
                $sucesoEsp = null;
                if($_POST['sucesoLabo'] != ""){
                    $sucesoEsp = $_POST['sucesoLabo'];
                }
                $response = $encuesta->createEncuestaClima($relacionJ, $relacionD, $relacionG, $apoyo, $apoyar, $gustoC, $disgustoC, $comodo, $climaL, $mejoras, $esfuerzoF, $accidenT, $actPeligrosas, $tiempoExt, $trabajarSp, $trabajoAc, $concentrado, $memorizarInf, $variosAsu, $acosoL, $acosoEsp, $sucesoLab, $sucesoEsp);
            }else if($_POST['pagina'] === "desempeno"){
                $empleado = $_POST['empleado'];
                $jefeD = $_POST['jefeD'];
                $fechaD = $_POST['fechaD'];
                $antigD = $_POST['antigD'];
                $potencialD = $_POST['potencialD'];
                $calidadD = $_POST['calidadD'];
                $consistenciaD = $_POST['consistenciaD'];
                $comuniD = $_POST['comuniD'];
                $trabajoInD = $_POST['trabajoInD'];
                $iniciativaD = $_POST['iniciativaD'];
                $equipoD = $_POST['equipoD'];
                $producD = $_POST['producD'];
                $creatiD = $_POST['creatiD'];
                $honestoD = $_POST['honestoD'];
                $integriD = $_POST['integriD'];
                $relacionD = $_POST['relacionD'];
                $clientesD = $_POST['clientesD'];
                $habilidadesD = $_POST['habilidadesD'];
                $fiabilidadD = $_POST['fiabilidadD'];
                $puntualD = $_POST['puntualD'];
                $asistenciaD = $_POST['asistenciaD'];
                $interesD = $_POST['interesD'];
                $compromisoD = $_POST['compromisoD'];
                $resultadoD = $_POST['resultadoD'];
                $comentarioD = $_POST['comentarioD'];
                $user = $_POST['usuario'];
                $response = $encuesta->createEncuestaD($empleado, $jefeD, $fechaD, $antigD, $potencialD, $calidadD, $consistenciaD, $comuniD, $trabajoInD, $iniciativaD, $equipoD, $producD, $creatiD, $honestoD, $integriD, $relacionD, $clientesD, $habilidadesD, $fiabilidadD, $puntualD, $asistenciaD, $interesD, $compromisoD, $resultadoD, $comentarioD, $user);
            }else if($_POST['pagina'] === "autoDesem"){
                $empleadoAu = intval($_POST['empleadoAu']);
                $misionAu = $_POST['misionAu'];
                $visionAu = $_POST['visionAu'];
                $objetivosAu = $_POST['objetivosAu'];
                $supervisionAu = $_POST['supervisionAu'];
                $independienteAu = $_POST['independienteAu'];
                $ayudaAu = $_POST['ayudaAu'];
                $aportacionAu = $_POST['aportacionAu'];
                $innovadorAu = $_POST['innovadorAu'];
                $influenciaAu = $_POST['influenciaAu'];
                $lograrAu = $_POST['lograrAu'];
                $imprevistosAu = $_POST['imprevistosAu'];
                $comunicacionAu = $_POST['comunicacionAu'];
                $cooperasAu = $_POST['cooperasAu'];
                $compromisoAu = $_POST['compromisoAu'];
                $horarioAu = $_POST['horarioAu'];
                $puntualidadAu = $_POST['puntualidadAu'];
                $identificarAu = $_POST['identificarAu'];
                $iniciativaAu = $_POST['iniciativaAu'];
                $trabajoEquiAu = $_POST['trabajoEquiAu'];
                $futuroAu = $_POST['futuroAu'];
                $estrategiasAu = $_POST['estrategiasAu'];
                $equipoAu = $_POST['equipoAu'];
                $confianzaAu = $_POST['confianzaAu'];
                $efectivoAu = $_POST['efectivoAu'];
                $ordenesAu = $_POST['ordenesAu'];
                $capacidadAu = $_POST['capacidadAu'];
                $potencialAu = $_POST['potencialAu'];
                $resultadosAu = $_POST['resultadosAu'];
                $destrezaAu = $_POST['destrezaAu'];
                $trabajoAu = $_POST['trabajoAu'];
                $desempenoAu = $_POST['desempenoAu'];
                $recursosAu = $_POST['recursosAu'];
                $response = $encuesta->createAutoDesem($empleadoAu, $misionAu, $visionAu, $objetivosAu, $supervisionAu, $independienteAu,$ayudaAu, $aportacionAu, $innovadorAu, $influenciaAu, $lograrAu, $imprevistosAu, $comunicacionAu, $cooperasAu, $compromisoAu, $horarioAu, $puntualidadAu, $identificarAu, $iniciativaAu, $trabajoEquiAu, $futuroAu, $estrategiasAu, $equipoAu, $confianzaAu, $efectivoAu, $recursosAu, $ordenesAu, $capacidadAu, $potencialAu, $resultadosAu, $destrezaAu, $trabajoAu, $desempenoAu);
            }
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    echo "Error al conectarse";
}

$bd->closeConnection();
