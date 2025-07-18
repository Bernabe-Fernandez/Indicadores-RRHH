<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <h1>Informe Recursos Humanos</h1>
    <section class="contenido-index">
        <div class="contenedor-anio">
            <p>Año del Informe:</p>
            <select name="anioInforme" id="anioInforme">
                <option value="2024">2024</option>
                <option value="2025" selected>2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
            </select>
        </div>
        <div class="tablero">
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Ausencias</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="faltas"></canvas>
                        </div>
                        <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="puesto">Puesto</label>
                                    <select name="puesto" id="puestosFaltas">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="empleado">Empleado</label>
                                    <select name="empleado" id="empleadoFaltas">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="areas">Area</label>
                                    <select name="areas" id="areasFaltas">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="motivos">Motivos</label>
                                    <select name="motivos" id="motivosFaltas">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroFaltas">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Vacantes</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="vacantes"></canvas>
                        </div>
                        <div class="filtros">
                            <h4>Filtros</h4>
                            <label for="area">Area</label>
                            <select name="areas" id="areasVacantes">
                                <option value="0" selected>Todos</option>
                            </select>
                            <button id="filtroVacantes">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>            
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Accidentes</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="accidentes"></canvas>
                        </div>
                        <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="area">Area</label>
                                    <select name="areas" id="areasAccidente">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroAccidente">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Rotación</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="rotacion"></canvas>
                        </div>
                        <div class="filtros">
                            <h4>Filtros</h4>
                            <label for="area">Area</label>
                            <select name="areas" id="areasRotacion">
                                <option value="0" selected>Todos</option>
                            </select>
                            <button id="filtroRotacion">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Altas</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="altas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Bajas</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="bajas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Capacitación</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="capacitacion"></canvas>
                        </div>
                        <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="area">Area</label>
                                    <select name="areas" id="areasCapacitacion">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="puesto">Puesto</label>
                                    <select name="puesto" id="puestosCapacitacion">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="empleado">Empleado</label>
                                    <select name="empleado" id="empleadoCapacitacion">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroCapacitacion">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Eventos al Personal</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="eventos"></canvas>
                        </div>
                        <!-- <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="area">Area</label>
                                    <select name="areas" id="areasClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="puesto">Puesto</label>
                                    <select name="puesto" id="puestosClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="empleado">Empleado</label>
                                    <select name="empleado" id="empleadoClima">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroClima">Aplicar</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Evaluaciones Desempeño</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="eDesempeno"></canvas>
                        </div>
                        <!-- <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="area">Area</label>
                                    <select name="areas" id="areasClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="puesto">Puesto</label>
                                    <select name="puesto" id="puestosClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="empleado">Empleado</label>
                                    <select name="empleado" id="empleadoClima">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroClima">Aplicar</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Autoevaluacion Desempeño</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="autoeDesem"></canvas>
                        </div>
                        <!-- <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="area">Area</label>
                                    <select name="areas" id="areasClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="puesto">Puesto</label>
                                    <select name="puesto" id="puestosClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="empleado">Empleado</label>
                                    <select name="empleado" id="empleadoClima">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroClima">Aplicar</button>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="seccion-tablero">
                <div class="grafica">
                    <h3>Promociones laborales</h3>
                    <div class="contenedor-grafica">
                        <div class="canva-grafica">
                            <canvas class="canva" id="promocionesL"></canvas>
                        </div>
                        <!-- <div class="filtros">
                            <h4>Filtros</h4>
                            <div class="contenedor-filtros">
                                <div class="filtro">
                                    <label for="area">Area</label>
                                    <select name="areas" id="areasClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="puesto">Puesto</label>
                                    <select name="puesto" id="puestosClima">
                                        <option value="0" selected>Todos</option>
                                    </select>
                                </div>
                                <div class="filtro">
                                    <label for="empleado">Empleado</label>
                                    <select name="empleado" id="empleadoClima">
                                        <option value="0" selected>Seleccione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <button id="filtroClima">Aplicar</button>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src="js/controllers/getDashboardAccidente.js"></script>
<script src="js/controllers/getDashboardVacantes.js"></script>
<script src="js/controllers/getDashboardFaltas.js"></script>
<script src="js/controllers/getDashboardRotacion.js"></script>
<script src="js/controllers/getDashboardCapacitacion.js"></script>
<script src="js/controllers/getDashboardEventos.js"></script>
<script src="js/controllers/getDashboardEvaluaciones.js"></script>
<script src="js/controllers/getDashboardAevaluaciones.js"></script>
<script src="js/controllers/getDashboardPromocionl.js"></script>
<?php
incluirTemplate('_footer');
?>