<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Formato de Asistencia Reuniones</h1>
        <h3>Estrategia de Comunicación</h3>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-addJuntas">
                <label for="gerenteJunta">Nombre quien dirige la reunión*</label>
                <input type="text" name="gerenteJunta" id="gerenteJunta" placeholder="Nombre" disabled>

                <label for="periodoJunta">Periodo*</label>
                <select name="periodoJunta" id="periodoJunta">
                    <option value="" disabled selected>--- Seleccione una opción ---</option>
                </select>

                <input type="hidden" name="areaId" id="areaId">

                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="fechaJunta">Fecha de Reunión*</label>
                        <input type="date" id="fechaJunta" name="fechaJunta">
                    </div>
                    <div class="inputs">
                        <label for="horaJunta">Hora de Reunión*</label>
                        <input type="time" id="horaJunta" name="horaJunta">
                    </div>
                </div>

                <div class="contenedor-asistentes">
                    <label for="asistentesJunta">Asistentes*</label>
                    <div class="contenedor-asignar">
                        <select name="asistentesJunta" id="asistentesJunta">
                            <option value="" selected disabled>--- Seleccione una opción ----</option>
                        </select>
                        <div class="contenido-boton">
                            <ion-icon class="boton-icono" id="boton-asistente" name="add-circle-outline"></ion-icon>
                            <span class="mensajeInfo">Agregar Asistente</span>
                        </div>
                    </div>
                </div>

                <div class="contenido-tabla">
                    <table id="tabla-asistentes">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nombre Completo</th>
                                <th>Puesto</th>
                                <th>Área</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="noDataRowPed">
                                <td colspan="5">Sin datos cargados</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <label for="temasJunta">Temas que se trataron en la reunión</label>
                <textarea name="temasJunta" id="temasJunta"></textarea>

                <label for="comentariosJunta">Observaciones/Comentarios</label>
                <textarea name="comentariosJunta" id="comentariosJunta"></textarea>


                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>
            </form>
        </div>
    </section>
</main>
<script src="js/controllers/juntas/addJuntas.js"></script>
<?php
incluirTemplate('_footer');
?>