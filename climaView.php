<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<link rel="stylesheet" href="css/custom/climaL.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Clima Laboral</h1>
        <div class="contenedor-anio">
            <p>Año del Informe:</p>
            <select name="anioClima" id="anioClima">
                <option value="2024" selected>2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
            </select>
        </div>
        <div class="tablero-clima">
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>1. ¿Cómo consideras qué es la relación con tu jefe inmediato?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="relacionJ"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>2. ¿Cómo consideras la relación con los compañeros de tu departamento al que perteneces?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="relacionD"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>3. Cómo consideras la relación con tus compañeros de otras áreas (General)?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="relacionG"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>4. Cuando se te presenta un problema, ¿Sientes el apoyo o ayuda?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="apoyo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>5. Cuando alguien tiene algún problema, ¿Estás dispuesto a darle apoyo?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="apoyar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>6. ¿Te sientes cómodo/a trabajando en Morgall?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="comodo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>7. ¿Mi trabajo me exige hacer mucho esfuerzo físico?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="esfuerzo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>8. ¿Me preocupa sufrir un accidente en mi trabajo?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="accidente"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>9. ¿Considero que las actividades que realizo son peligrosas?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="actividad"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>10. ¿Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="tiempoExt"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>11. ¿Por la cantidad de trabajo que tengo debo trabajar sin parar?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="trabajarSp"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>12. ¿Considero que es necesario mantener un ritmo de trabajo acelerado?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="trabajarAc"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>13. ¿Mi trabajo exige que esté muy concentrado?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="concentrado"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>14. ¿Mi trabajo requiere que memorice mucha información?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="memorizarinfo"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>15. ¿Mi trabajo exige que atienda varios asuntos al mismo tiempo?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="variosAsu"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>16. ¿Ha presenciado o sufrido alguna vez, dentro del trabajo alguna amenaza o acoso de cualquier índole?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="acosoL"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>17. ¿Has tenido sueños de carácter recurrente sobre algún suceso o acontecimiento laboral?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="sucesoLab"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica-clima">
                    <h3>18. ¿Con cuánto calificas el clima laboral de la empresa?</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="climaL"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="ult-question">
            <div class="grafica-clima">
                <h3>7. ¿Con cuánto calificas el clima laboral de la empresa?</h3>
                <div class="contenedor-grafica">
                    <div class="canva-grafica">
                        <canvas class="canva" id="climaL"></canvas>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="preguntas-abiertas">
            <div class="contenido-tabla">
                <table id="gustoC">
                    <thead>
                        <th>19. ¿Qué es lo qué más te gusta de la relación con tus compañeros/as?</th>
                    </thead>
                </table>
            </div>
            <div class="contenido-tabla">
                <table id="disgustoC">
                    <thead>
                        <th>20. ¿Qué es lo qué menos te gusta de la relación con tus compañeros/as?</th>
                    </thead>
                </table>
            </div>
            <div class="contenido-tabla">
                <table id="acosoEsp">
                    <thead>
                        <th>21. Amenaza o Acoso especifica</th>
                    </thead>
                </table>
            </div>
            <div class="contenido-tabla">
                <table id="sucesoEsp">
                    <thead>
                        <th>22. Suceso especifico</th>
                    </thead>
                </table>
            </div>
            <div class="contenido-tabla">
                <table id="mejorar">
                    <thead>
                        <th>23.¿Qué aspectos mejorarías para mantener un clima laboral positivo?</th>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</main>
<script src="js/controllers/getClimaLaboral.js"></script>
<?php
incluirTemplate('_footer');
?>