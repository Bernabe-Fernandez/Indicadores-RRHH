<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Vacantes</h1>
        <table id="tablaVacantes" class="display">
            <thead>
                <tr>
                    <th>Area</th>
                    <th>Vacantes Totales</th>
                    <th>Vacantes Actuales</th>
                    <th>Vacantes Pendientes</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-vacantes">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getVacantes.js"></script>
<?php
incluirTemplate('_footer');
?>