<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Eventos Al Personal</h1>
        <div class="contenedor-agregar">
            <a href="eventosCreate.php" class="btn-gral boton-agregar">Agregar Evento</a>   
        </div>
        <table id="eventos" class="display">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="contenido-eventos">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getEventos.js"></script>
<?php
incluirTemplate('_footer');
?>