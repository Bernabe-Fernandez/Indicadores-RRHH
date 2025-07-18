<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Información de Incidente</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addFaltas">
                <label for="empleadoAccidente">Nombre*</label>
                <select name="empleadoAccidente" id="empleadoAccidente">
                    <option value="0">Seleccione una Opción</option>
                </select>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="areaAccidente">Area*</label>
                        <input type="text" id="areaAccidente" name="areaAccidente" placeholder="Area:" disabled>
                    </div>
                    <div class="inputs">
                        <label for="puestoAccidente">Puesto*</label>
                        <input type="text" id="puestoAccidente" name="puestoAccidente" placeholder="Puesto:" disabled>
                    </div>
                </div>
                <label for="tipoAccidente">Tipo*</label>
                <input type="text" id="tipoAccidente" name="tipoAccidente" placeholder="Tipo:">
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="fechaAccidente">Fecha*</label>
                        <input type="date" id="fechaAccidente" name="fechaAccidente" placeholder="Fecha">
                    </div>
                    <div class="inputs">
                        <label for="incapacidad">Incapacidad*</label>
                        <select name="incapacidad" id="incapacidad">
                            <option value="3" disabled selected>Seleccione un opción</option>
                            <option value="1" >Si</option>
                            <option value="0" >No</option>
                        </select>
                    </div>
                </div>
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addAccidentes.js"></script>
<?php
incluirTemplate('_footer');
?>