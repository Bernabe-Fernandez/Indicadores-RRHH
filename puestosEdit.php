<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Actualizar Puesto</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-editPuesto">
                <label for="nombrePuesto">Puesto:</label>
                <input type="text" id="nombrePuesto" name="nombrePuesto" placeholder="Puesto:">
                <label for="selectPuestoArea">Area*</label>
                <select name="selectPuestoArea" id="selectPuestoArea">
                    <option value="0" disabled selected>Seleccione una opción</option>
                </select>
                <label for="selectPuestoEstatus">Estatus*</label>
                <select name="selectPuestoEstatus" id="selectPuestoEstatus">
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
<script src="js/controllers/editPuesto.js"></script>
<?php
incluirTemplate('_footer');
?>