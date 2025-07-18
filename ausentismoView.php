<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Ausentismos</h1>
        <div class="contenedor-agregar">
            <a href="ausentismoCreate.php" class="btn-gral boton-agregar">Ingresar Ausentismo</a>   
        </div>
        <table id="tablaAusentismo" class="display">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Area</th>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Observaciones</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-pedido">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getFaltas.js"></script>
<?php
incluirTemplate('_footer');
?>