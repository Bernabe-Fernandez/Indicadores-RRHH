<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Editar Promociones Laborales</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-editPromocionesL">
                <label for="nombre">Nombre*</label>
                <input type="text" id="nombreEmpleado" name="nombreEmpleado" placeholder="Nombre:" disabled>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="areaAnterior">Area Anterior*</label>
                        <input type="text" id="areaAnterior" name="areaAnterior" placeholder="Area Anterior:" disabled>
                    </div>
                    <div class="inputs">
                        <label for="puestoAnterior">Puesto Anterior*</label>
                        <input type="text" id="puestoAnterior" name="puestoAnterior" placeholder="Puesto Anterior:" disabled>
                    </div>
                </div>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="areaActual">Area Actual*</label>
                        <input type="text" id="areaActual" name="areaActual" placeholder="Area Actual:" disabled>
                    </div>
                    <div class="inputs">
                        <label for="puestoActual">Puesto Actual*</label>
                        <input type="text" id="puestoActual" name="puestoActual" placeholder="Puesto Actual:" disabled>
                    </div>
                </div>
                <label for="comentario">Comentario*</label>
                <input type="text" id="comentario" name="comentario" placeholder="Comentario:">
                <label for="embarque">Fecha Movimiento*</label>
                <input type="date" id="fechaM" name="fechaM" placeholder="Fecha Movimiento">
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/editPromocionesL.js"></script>
<?php
incluirTemplate('_footer');
?>