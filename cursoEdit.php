<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Registrar Curso</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-editCurso">
                <label for="cursos">Nombre Curso:</label>
                <input type="text" id="Nombrecurso" name="NombreCurso" placeholder="Curso:">
                <label for="fechaCurso">Fecha del Curso*</label>
                <input type="date" id="fechaCurso" name="fechaCurso" placeholder="Fecha">
                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/editCurso.js"></script>
<?php
incluirTemplate('_footer');
?>