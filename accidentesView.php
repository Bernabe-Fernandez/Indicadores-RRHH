<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Accidentes Laborales</h1>
        <div class="contenedor-agregar">
            <a href="accidentesCreate.php" class="btn-gral boton-agregar">Registrar Incidente</a>   
        </div>
        <table id="accidentes" class="display">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Puesto</th>
                    <th>Area</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Incapacidad</th>
                </tr>
            </thead>
            <tbody id="contenido-accidentes">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getAccidentes.js"></script>
<?php
incluirTemplate('_footer');
?>