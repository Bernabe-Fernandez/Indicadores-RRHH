<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Capacitación</h1>
        <div class="contenedor-agregar">
            <a href="cursoCreate.php" class="btn-gral boton-agregar">Registrar Curso</a>   
        </div>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addCapacitacion">
                <label for="cursos">Curso:</label>
                <select name="curso" id="cursoSelector">
                    <option value="0">Seleccione una Opción</option>
                </select>
                <label for="empleadoCurso">Nombre*</label>
                <select name="empleadoCurso" id="empleadoCurso">
                    <option value="0">Seleccione una Opción</option>
                </select>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="areaCurso">Area*</label>
                        <input type="text" id="areaCurso" name="areaCurso" placeholder="Area:" disabled>
                    </div>
                    <div class="inputs">
                        <label for="puestoCurso">Puesto*</label>
                        <input type="text" id="puestoCurso" name="puestoCurso" placeholder="Puesto:" disabled>
                    </div>
                </div>
                <label for="fechaCurso">Fecha*</label>
                <input type="date" id="fechaCurso" name="fechaCurso" placeholder="Fecha Curso" disabled>
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/addCapacitacion.js"></script>
<?php
incluirTemplate('_footer');
?>