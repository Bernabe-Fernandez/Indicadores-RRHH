<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Puesto</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-createPuesto">
                <label for="puesto">Puesto:</label>
                <input type="text" id="nombrePuesto" name="nombrePuesto" placeholder="Puesto:">
                <label for="PuestoAreas">Area*</label>
                <select name="PuestoAreas" id="PuestoAreas">
                    <option value="0" selected disabled>Seleccione una opción</option>
                    <option value="1">Finanzas</option>
                </select>
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addPuesto.js"></script>
<?php
incluirTemplate('_footer');
?>