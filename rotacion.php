<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/envios.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Rotación de Personal</h1>
        <div class="contenedor-tabla">
            <h3>Altas</h3>
            <table id="empleados-alta" class="display">
                <thead class="thead">
                    <tr class="tr">
                        <th>Nombre</th>
                        <th>Ingreso</th>
                        <th>Puesto</th>
                        <th>Area</th>
                    </tr>
                </thead>
                <tbody id="contenido-altas">

                </tbody>
            </table>
        </div>
        <div class="contenedor-tabla">
            <h3>Bajas</h3>
            <table id="empleados-baja" class="display">
                <thead class="thead">
                    <tr class="tr">
                        <th>Nombre</th>
                        <th>Egreso</th>
                        <th>Puesto</th>
                        <th>Area</th>
                        <th>Motivo</th>
                        <th>Observaciones</th>
                        <th>Encuesta Salida</th>
                    </tr>
                </thead>
                <tbody id="contenido-baja">

                </tbody>
            </table>
        </div>
    </section>
</main>
<script src="js/controllers/getRotacion.js"></script>
<?php
incluirTemplate('_footer');
?>