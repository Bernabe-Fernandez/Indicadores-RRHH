<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Editar Información de Empleados</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-bajaEmpleados">
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombreEmpleado" name="nombreEmpleado" placeholder="Nombre:" disabled>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="area">Area*</label>
                        <select name="areaEmpleado" id="areaEmpleado" disabled>
                            <option value="0" disabled selected>Seleccione una opción</option>
                        </select>
                    </div>
                    <div class="inputs">
                        <label for="puesto">Puesto*</label>
                        <select name="puestoEmpleado" id="puestoEmpleado" disabled>
                            <option value="0" disabled selected>Seleccione una Opción</option>
                        </select>
                    </div>
                </div>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="fechaIngreso">Ingreso*</label>
                        <input type="date" id="fechaIngreso" name="fechaIngreso" placeholder="Fecha Ingreso" disabled>
                    </div>
                    <div class="inputs">
                        <label for="fechaEgreso">Egreso*</label>
                        <input type="date" id="fechaEgreso" name="fechaEgreso" placeholder="Fecha Egreso">
                    </div>
                </div>
                <label for="motivoEgreso">Motivo*</label>
                <select name="motivoEgreso" id="motivoEgreso">
                    <option value="0" disabled selected>Seleccione una opción</option>
                </select>
                <label for="ComEgreso">Comentario Egreso:*</label>
                <input type="text" id="ComEgreso" name="ComEgreso" placeholder="Comentario Egreso:">
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/bajaEmpleado.js"></script>
<?php
incluirTemplate('_footer');
?>