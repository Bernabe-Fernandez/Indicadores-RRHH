<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Actualizar Vacantes</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-editVacantes">
                <label for="area">Area:</label>
                <input type="text" id="nombreArea" name="nombreArea" placeholder="Area:" disabled>
                <label for="numVacantes">Numero de Vacantes*</label>
                <input type="number" id="numVacantes" name="numVacantes">
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/editVacantes.js"></script>
<?php
incluirTemplate('_footer');
?>