<?php
//creación del archivo pdf para evaluación de desempeño
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_GET)) {
      $datos = array(
            'icono' => 'error',
            'mensaje' => 'No se enviaron datos'
      );
      header('Content-Type: application/json');
      echo json_encode($datos);
      exit;
} else {
      $response = json_decode($_GET['informacion'], true);
}
// var_dump($response);
$contadorPuntos = [0, 0, 0, 0, 0];
ob_start();

?>

<!DOCTYPE html>
<html lang="es" id="ReporteD">

<head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Autoevaluacion de Desempeño</title>
      <style>
            body {
                  font-family: 'DejaVu Sans',
                        Arial,
                        sans-serif;
            }

            .cuerpo {
                  width: 725px;
                  height: 950px;
                  margin: 0;
                  padding: 0;
                  border: 1px solid black;
            }

            .titulo table {
                  width: auto;
                  height: auto;
            }

            .titulo table tbody tr td h1 {
                  font-size: 21px;
            }

            .titulo table tbody tr td img {
                  width: 250px;
                  height: auto;
                  margin-left: 50px;
            }

            table {
                  border-collapse: collapse;
                  /* Colapsar los bordes para evitar doble línea */
            }

            .description {
                  margin: 0 10px;
            }

            .description table {
                  width: 100%;
            }

            .description table tbody tr td {
                  font-size: 12px;
                  border: 1px solid black;
                  width: 170px;
                  height: 20px;
            }

            .caracteristicas {
                  width: auto;
                  background-color: rgb(87, 136, 251);
                  border: 1px solid black;
                  margin: 0 10px;
                  color: #fff;
                  text-align: center;
            }

            .caracteristicas h3 {
                  padding: 5px;
                  margin: 0;
            }

            .preguntas-abiertas,
            .evaluacion {
                  width: auto;
                  height: auto;
                  margin: 0 10px;
            }

            .preguntas-abiertas table,
            .evaluacion table {
                  width: 100%;
            }

            .preguntas-abiertas table thead,
            .evaluacion table thead {
                  font-size: 12px;
                  text-align: center;
            }

            .preguntas-abiertas table thead tr th {
                  width: 50%;
                  border: 1px solid black;
            }

            .evaluacion table thead tr th {
                  padding: 4px;
                  min-width: 100px;
                  border: 1px solid black;
            }

            .preguntas-abiertas table tbody,
            .evaluacion table tbody {
                  font-size: 11px;
            }

            .preguntas-abiertas table tbody tr td {
                  border: 1px solid black;
                  height: 50px;
                  text-align: center;
            }

            .evaluacion table tbody tr td {
                  border: 1px solid black;
                  text-align: center;
            }

            .evaluacion table tbody tr td.not-center {
                  text-align: left;
            }
      </style>
</head>

<body>
      <div class="cuerpo">
            <div class="titulo">
                  <table>
                        <tbody>
                              <tr>
                                    <td>
                                          <h1>AUTOEVALUACIÓN DE DESEMPEÑO</h1>
                                    </td>
                                    <td>
                                          <img src="http://localhost:8080/rrhhmorgall/img/logo.png" alt="icono" />
                                    </td>
                              </tr>
                        </tbody>
                  </table>
            </div>

            <div class="description">
                  <table>
                        <tbody>
                              <tr>
                                    <td>NOMBRE DEL EMPLEADO</td>
                                    <td><?php echo $response['Nombre'] ?></td>
                                    <td>DEPARTAMENTO</td>
                                    <td><?php echo $response['NombreArea'] ?></td>
                              </tr>
                              <tr>
                                    <td>PUESTO</td>
                                    <td><?php echo $response['NombrePuesto'] ?></td>
                                    <td>FECHA DE APLICACIÓN</td>
                                    <td><?php echo $response['fechaAp'] ?></td>
                              </tr>
                        </tbody>
                  </table>
            </div>
            <div class="caracteristicas">
                  <h3>PREGUNTAS ABIERTAS</h3>
            </div>
            <div class="preguntas-abiertas">
                  <table>
                        <thead>
                              <tr>
                                    <th>PREGUNTAS</th>
                                    <th>RESPUESTA</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    <td>Misión</td>
                                    <td><?php echo $response['mision'] ?></td>
                              </tr>
                              <tr>
                                    <td>Visión</td>
                                    <td><?php echo $response['vision'] ?></td>
                              </tr>
                              <tr>
                                    <td>Objetivos</td>
                                    <td><?php echo $response['objetivos'] ?></td>
                              </tr>
                        </tbody>
                  </table>
            </div>
            <div class="caracteristicas">
                  <h3>CARACTERÍSTICAS</h3>
            </div>
            <div class="evaluacion">
                  <table>
                        <thead>
                              <tr>
                                    <th>ASPECTOS A EVALUAR</th>
                                    <th>1</th>
                                    <th>2</th>
                                    <th>3</th>
                                    <th>4</th>
                              </tr>
                        </thead>
                        <tbody>
                              <tr>
                                    <td class="not-center">
                                          ¿Necesitas supervisión frecuente para realizar tus labores?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['supervision']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Consideras que puedes tomar decisiones por sí sólo?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['independiente']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Realizas tu trabajo sin necesidad de ayuda de otra persona?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['ayuda']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Consideras que tus aportaciones son esenciales para el
                                          desarrollo de la empresa?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['aportaciones']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Eres innovador a la hora de toma de decisiones?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['innovador']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Puedo ver con claridad cómo mi trabajo influye en el éxito
                                          general de la compañía?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['influencia']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Sé lo que se espera de mí para lograr los objetivos y
                                          resultados?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['lograr']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Resuelves los imprevistos de tu trabajo y mejoras los
                                          procedimientos cuando se requiere?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['imprevistos']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Estableces y mantienes comunicación con compañeros, superiores,
                                          clientes, etc. propiciando un ambiente de cordialidad y respeto?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['comunicacion']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Cooperas con los compañeros en las labores complejas?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['cooperacion']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Qué tanto compromiso consideras que tienes con tus labores?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['compromiso']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Cumples exactamente con el horario de trabajo?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['horario']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Cómo consideras tu puntualidad y asistencia?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['puntualidad']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Te identificas con los valores de la empresa?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['identificar']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">¿Cómo calificas tu iniciativa?</td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['iniciativa']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">¿Fomentas el trabajo en equipo?</td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['trabajoEqui']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Puedo verme trabajando aquí en los próximos 5 años?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['futuro']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Entiendo claramente las estrategias para lograr los objetivos
                                          de la empresa?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['estrategias']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Siento que todos pueden hacer equipo conmigo?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['equipo']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Generas credibilidad y confianza frente al manejo de la
                                          información y en la ejecución de actividades?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['confianza']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Demuestras efectividad ante la alta demanda de trabajo?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['efectivo']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Utilizas los recursos de la mejor manera?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['recursos']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">¿Te causa problema acatar ordenes?</td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['ordenes']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Te consideras con la capacidad de resolver cualquier problema
                                          que se te presente?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['capacidad']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Mi jefe reconoce mi potencial y aprovecha mis fortalezas?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['potencial']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Entregas resultados esperados de acuerdo con la programación
                                          previamente establecida?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['resultados']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Aplicas las destrezas y los conocimientos necesarios para el
                                          cumplimiento de las actividades y funciones de tu puesto?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['trabajo']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Realizas tu trabajo de acuerdo con los requerimientos en
                                          términos de contenido, exactitud, presentación, calidad y
                                          atención?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['destreza']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                              <tr>
                                    <td class="not-center">
                                          ¿Cómo calificas tu desempeño a nivel general?
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          if ($i == $response['desempenoG']) {
                                                $puntuacion = '&#10003;';
                                                $contadorPuntos[$i] = $contadorPuntos[$i] + 1;
                                          } else {
                                                $puntuacion = '';
                                          }
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>

                              <tr>
                                    <td class="not-center">
                                          Total
                                    </td>
                                    <?php
                                    for ($i = 1; $i <= 4; $i++) :
                                          $puntuacion = $contadorPuntos[$i];
                                    ?>
                                          <td><?php echo $puntuacion ?></td>
                                    <?php endfor; ?>
                              </tr>
                        </tbody>
                  </table>
            </div>
      </div>
</body>

</html>




<?php
// creación del pdf
$contenidoReporte = ob_get_clean();
$dompdf = new Dompdf();

// echo $contenidoReporte;
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($contenidoReporte);
// $dompdf->setPaper('A4', 'landscape');
$dompdf->setPaper('Carta');
$dompdf->render();
$pdf_content = $dompdf->output();

// Configurar cabeceras para indicar que es un PDF
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="nombre_archivo.pdf"');
header('Content-Length: ' . strlen($pdf_content));

// Enviar el contenido del PDF como respuesta Ajax
echo $pdf_content;

?>