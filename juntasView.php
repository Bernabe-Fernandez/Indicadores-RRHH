<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Juntas Internas Omnibandas</h1>
        <div class="contenedor-agregar">
            <a href="juntasCreate.php" class="btn-gral boton-agregar">Agregar Registro</a>   
        </div>
        <table id="tablaJuntas" class="display">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Organizador</th>
                    <th>Periodo</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Temas</th>
                    <th>Asistentes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-areas">

            </tbody>
        </table>
    </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script src="js/controllers/juntas/getJuntas.js"></script>
<?php
incluirTemplate('_footer');
?>