<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Información de Eventos al Personal</h1>
        <br>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addEventos">
                <label for="nombreEvento">Nombre del Evento*</label>
                <input type="text" id="nombreEvento" name="nombreEvento" placeholder="Nombre Evento:">
                <label for="fechaEvento">Ingreso*</label>
                <input type="date" id="fechaEvento" name="fechaEvento" placeholder="Fecha Evento">
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addEventos.js"></script>
<?php
incluirTemplate('_footer');
?>