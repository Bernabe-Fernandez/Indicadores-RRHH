<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Información de Empleados</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addEmpleados">
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombreEmpleado" name="nombreEmpleado" placeholder="Nombre:">

                <label for="curp">CURP*</label>
                <input type="text" id="curpEmpleado" name="curpEmpleado" placeholder="CURP:">

                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="rfc">RFC*</label>
                        <input type="text" id="rfcEmpleado" name="rfcEmpleado" placeholder="RFC:">
                    </div>
                    <div class="inputs">
                        <label for="nss">NSS*</label>
                        <input type="text" id="nssEmpleado" name="nssEmpleado" placeholder="NSS:">
                    </div>
                </div>

                
                <label for="domicilio">Domicilio*</label>
                <input type="text" id="domicilioEmpleado" name="domicilioEmpleado" placeholder="Domicilio:">


                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="contacto">Contacto de emergencia*</label>
                        <input type="text" id="contactoEmpleado" name="contactoEmpleado" placeholder="Contacto de Emergencia:">
                    </div>
                    <div class="inputs">
                        <label for="celular">Telefono Celular*</label>
                        <input type="text" id="celularEmpleado" name="celularEmpleado" placeholder="Telefono Celular:">
                    </div>
                </div>

                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="area">Area*</label>
                        <select name="areaEmpleado" id="areaEmpleado">
                            <option value="0" selected>Seleccione una opción</option>
                        </select>
                    </div>
                    <div class="inputs">
                        <label for="puesto">Puesto*</label>
                        <select name="puestoEmpleado" id="puestoEmpleado" disabled>
                            <option value="0">Seleccione una Opción</option>
                        </select>
                    </div>
                </div>

                <label for="observaciones">Comentarios</label>
                <textarea name="observaciones" id="observaciones"></textarea>

                <label for="fechaIngreso">Ingreso*</label>
                <input type="date" id="fechaIngreso" name="fechaIngreso" placeholder="Fecha Ingreso">
                
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addEmpleado.js"></script>
<?php
incluirTemplate('_footer');
?>