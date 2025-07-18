<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Actualizar Áreas</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-editAreas">
                <label for="nombreArea">Area:</label>
                <input type="text" id="nombreArea" name="nombreArea" placeholder="Area:" disabled>
                <label for="estatusArea">Estatus*</label>
                <select name="estatusArea" id="estatusArea">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/editAreas.js"></script>
<?php
incluirTemplate('_footer');
?>