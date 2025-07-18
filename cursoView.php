<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Cursos</h1>
        <div class="contenedor-agregar">
            <a href="cursoCreate.php" class="btn-gral boton-agregar">Ingresar Curso</a>   
        </div>
        <table id="tablaCursos" class="display">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody id="contenido-cursos">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getCursos.js"></script>
<?php
incluirTemplate('_footer');
?>