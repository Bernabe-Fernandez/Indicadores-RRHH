<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<link rel="stylesheet" href="css/custom/index.css">
<main class="contenido">
    <section class="contenido-index">
        <h1>Empleados </h1>
        <div class="contenedor-agregar">
            <a href="empleadosCreate.php" class="btn-gral boton-agregar">Ingresar Empleado</a>   
        </div>
        <table id="empleados" class="display">
            <thead class="thead">
                <tr class="tr">
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Area</th>
                    <th>Ingreso</th>
                    <th>Egreso</th>
                    <th>Estatus</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="contenido-pedido">

            </tbody>
        </table>
    </section>
</main>
<script src="js/controllers/getEmpleados.js"></script>
<?php
incluirTemplate('_footer');
?>