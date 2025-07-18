<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Áreas</h1>
        <div class="contenedor-agregar">
            <a href="areasCreate.php" class="btn-gral boton-agregar">Agregar Áreas</a>   
        </div>
        <table id="tablaAreas" class="display">
            <thead>
                <tr>
                    <th>Nombre Área</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-areas">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getAreas.js"></script>
<?php
incluirTemplate('_footer');
?>