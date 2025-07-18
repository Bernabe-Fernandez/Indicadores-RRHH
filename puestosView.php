<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Puestos</h1>
        <div class="contenedor-agregar">
            <a href="puestosCreate.php" class="btn-gral boton-agregar">Registrar Puesto</a>   
        </div>
        <table id="tablaPuestos" class="display">
            <thead>
                <tr>
                    <th>Nombre Puesto</th>
                    <th>Area</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-puestos">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getPuestos.js"></script>
<?php
incluirTemplate('_footer');
?>