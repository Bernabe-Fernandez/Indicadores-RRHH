<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Asistencia</h1>
        <div class="view" id="createReporte">
            <div class="contenedor-agregar">
                <a href="reporteView.php" class="btn-gral boton-agregar">Ver Reportes</a>
            </div>
            <div class="contenedor-form">
                <form enctype="multipart/form-data" class="formulario" method="POST" id="form-registroReporte">
                    <label for="reporteAsis">Selecciona el formato de asistencia:</label>
                    <input type="file" id="reporteAsis" name="reporteAsis" accept=".xlsx, .xls">
                    <div class="contenedor-boton">
                        <input class="boton-form-naranja" type="submit" value="Generar Formato">
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden" id="formatoTabla">
            <div class="contenedor-botones">
                <button class="btn-gral boton-gen" id="genReporte">Generar Reporte</button>
                <button class="btn-gral boton-new" id="NewReporte">Nuevo Reporte</button>
            </div>
            <table class="tablaAsistencia" id="tablaReporte">
                <thead id="headReporte">
                </thead>
                <tbody id="bodyReporte">
                </tbody>
            </table>
        </div>
    </section>
</main>
<script src="js/controllers/createAsistencia.js"></script>
<?php
incluirTemplate('_footer');
?>