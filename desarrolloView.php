<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Desarrollo Organizacional</h1>
        <h3>Evaluaciones de desempeño</h2>
            <table id="evaluacionesD" class="display">
                <thead>
                    <tr>
                        <th>Empleado</th>
                        <th>Puesto</th>
                        <th>Area</th>
                        <th>Fecha de aplicación</th>
                        <th>Jefe Directo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="contenido-pedido">

                </tbody>
            </table>
            <h3>Autoevaluaciones de desempeño</h2>
                <table id="autoevaluacionD" class="display">
                    <thead>
                        <tr>
                            <th>Empleado</th>
                            <th>Puesto</th>
                            <th>Area</th>
                            <th>Fecha de aplicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="contenido-pedido">

                    </tbody>
                </table>
                <h3>Promociones Laborales</h2>
                    <table id="promocionL" class="display">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Area Anterior</th>
                                <th>Puesto Anterior</th>
                                <th>Area Actual</th>
                                <th>Puesto Actual</th>
                                <th>Comentario</th>
                                <th>Fecha de Movimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="contenido-pedido">

                        </tbody>
                    </table>
    </section>
</main>
<script src="js/controllers/getEvaluaciones.js"></script>
<?php
incluirTemplate('_footer');
?>