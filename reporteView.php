<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/reportes.css" />
<link rel="stylesheet" href="css/custom/index.css">

<main class="contenido">
    <section class="contenido-index">
        <h1>Asistencia</h1>
        <div class="view" id="createReporte">
            <div class="contenedor-agregar">
                <a href="reporteCreate.php" class="btn-gral boton-agregar">Generar Reporte</a>
            </div>
            <div class="contenedor-reporte">
                <div class="area-reportes">
                    <div class="reporte">
                        <label for="reporteAsis">Selecciona el reporte a consultar:</label>
                        <select name="reporteAsis" id="reporteAsis">
                            <option value="0" disabled selected>Seleccione una opción</option>
                        </select>

                        <div class="acciones-form">
                            <button class="btn-gral boton-ver" id="verReporte">Visualizar</button>
                            <button class="btn-gral boton-dow" id="dowReporte">Descargar</button>
                        </div>
                    </div>
                </div>
                <form class="form-filtro" id="form-filtros">
                    <div class="contenedor-input">
                        <div class="input">
                            <label for="mesReporte">Mes:*</label>
                            <select name="mesReporte" id="mesReporte">
                                <option value="0" selected>Seleccione una opción</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="anioReporte">Año:*</label>
                            <select name="anioReporte" id="anioReporte">
                                <option value="0" selected>Seleccione una opción</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                            </select>
                        </div>
                        <div class="input">
                            <label for="tReporte">Tipo:*</label>
                            <select name="tReporte" id="tReporte">
                                <option value="0" selected>Seleccione una opción</option>
                                <option value="quincenal">Quincenal</option>
                                <option value="semanal">Semanal</option>
                                <option value="ventas">Ventas</option>
                            </select>
                        </div>
                    </div>

                    <div class="contenedor-btn-filtro">
                        <button class="btn-filtro" id="btn-filtro">Filtrar</button>
                        <button class="btn-limpiar" id="btn-limpiar">Limpiar</button>
                    </div>
                </form>
            </div>
            <!-- <div class="contenedor-form">
                <form class="formulario" id="form-registroReporte">
                    <label for="tipoReporte">Selecciona el tipo de reporte:*</label>
                    <select name="tipoReporte" id="tipoReporte">
                        <option value="0" disabled selected>Seleccione una opción</option>
                        <option value="quincenal">Quincenal</option>
                        <option value="semanal">Semanal</option>
                    </select>

                    <label for="reporteAsis">Selecciona el reporte a consultar:</label>
                    <select name="reporteAsis" id="reporteAsis" disabled>
                        <option value="0" selected>Seleccione una opción</option>
                    </select>

                    

                    <div class="acciones-form">
                        <button class="btn-gral boton-gen" id="verReporte">Visualizar</button>
                        <button class="btn-gral boton-new" id="dowReporte">Descargar</button>
                    </div>
                </form>
            </div> -->
        </div>
    </section>
</main>
<script src="js/controllers/viewAsistencia.js"></script>
<?php
incluirTemplate('_footer');
?>