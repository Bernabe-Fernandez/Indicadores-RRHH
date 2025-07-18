<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Capacitaciones</h1>
        <div class="contenedor-agregar">
            <a href="capacitacionCreate.php" class="btn-gral boton-agregar">Registrar Capacitación</a>   
            <a href="cursoView.php" class="btn-gral boton-ver">Ver Cursos</a>   
        </div>
        <table id="capacitacion" class="display">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Participante</th>
                    <th>Fecha</th>
                    <th>Puesto</th>
                    <th>Área</th>
                </tr>
            </thead>
            <tbody id="contenido-cursos">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getCapacitacion.js"></script>
<?php
incluirTemplate('_footer');
?>