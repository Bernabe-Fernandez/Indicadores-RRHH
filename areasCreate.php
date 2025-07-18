<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Área</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addArea">
                <label for="nombreArea">Nombre del Área:</label>
                <input type="text" id="nombreArea" name="nombreArea" placeholder="Área:">
                <label for="vacantesArea">Numero de Vacantes*</label>
                <input type="number" id="vacantesArea" name="vacantesArea" value="1">
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addArea.js"></script>
<?php
incluirTemplate('_footer');
?>