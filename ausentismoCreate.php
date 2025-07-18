<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Información de Ausentismo</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addFaltas">
                <label for="empleado">Nombre*</label>
                <select name="empleado" id="empleado">
                    <option value="0">Seleccione una Opción</option>
                </select>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="area">Area*</label>
                        <input type="text" id="areaEmpleado" name="areaEmpleado" placeholder="Area:" disabled>
                    </div>
                    <div class="inputs">
                        <label for="puesto">Puesto*</label>
                        <input type="text" id="puestoEmpleado" name="puestoEmpleado" placeholder="Puesto:" disabled>
                    </div>
                </div>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="fechaFalta">Fecha*</label>
                        <input type="date" id="fechaFalta" name="fechaFalta" placeholder="Fecha Falta">
                    </div>
                    <div class="inputs">
                        <label for="motivo">Motivo*</label>
                        <select name="motivo" id="motivo">
                            <option value="0" selected>Seleccione un opción</option>
                        </select>
                    </div>
                </div>
                <label for="observaciones">Observaciones*</label>
                <input type="text" id="observaciones" name="observaciones" placeholder="Obervaciones:">

                <label for="archivo">Archivo*</label>
                <input type="file" id="archivo" name="archivo" accept=".pdf">
                
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addFaltas.js"></script>
<?php
incluirTemplate('_footer');
?>