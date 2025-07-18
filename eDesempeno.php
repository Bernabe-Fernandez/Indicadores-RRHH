<?php
require 'includes/app.php';
incluirTemplate('_header');
?>
<main class="contenido">
    <section class="contenido-index">
        <h1>Evaluación de desempeño</h1>
        <div class="contenedor-form">
            <form class="formulario" id="formulario-eDesempeno">
                <label for="empleado">Empleado*</label>
                <select name="empleado" id="empleado">
                        <option value="0" selected disabled>Seleccione una opción</option>
                </select>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="areaD">Area*</label>
                        <input type="text" name="areaD" id="areaD" placeholder="Area" disabled>
                    </div>
                    <div class="inputs">
                        <label for="puestoD">Puesto*</label>
                        <input type="text" name="puestoD" id="puestoD" placeholder="Puesto" disabled>
                    </div>
                </div>
                <label for="jefeD">Jefe Directo*</label>
                <input type="text" name="jefeD" id="jefeD" placeholder="Jefe Directo" disabled>
                <div class="contenedor-input">
                    <div class="inputs">
                        <label for="fechaD">Fecha Aplicación*</label>
                        <input type="date" id="fechaD" name="fechaD" disabled>
                    </div>
                    <div class="inputs">
                        <label for="antigD">Antigüedad*</label>
                        <input type="text" id="antigD" name="antigD" placeholder="Antigüedad" disabled>
                    </div>
                </div>
                <p class="subtitle-form">Aspectos a Evaluar</p>
                <label for="potencialD">Trabaja a todo su potencial*</label>
                <select name="potencialD" id="potencialD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="calidadD">Calidad del trabajo*</label>
                <select name="calidadD" id="calidadD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="consistenciaD">Consistencia en el trabajo*</label>
                <select name="consistenciaD" id="consistenciaD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="comuniD">Comunicación*</label>
                <select name="comuniD" id="comuniD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="trabajoInD">Trabajo Independiente*</label>
                <select name="trabajoInD" id="trabajoInD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="iniciativaD">Toma la iniciativa*</label>
                <select name="iniciativaD" id="iniciativaD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="equipoD">Trabajo en equipo*</label>
                <select name="equipoD" id="equipoD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="producD">Productividad*</label>
                <select name="producD" id="producD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="creatiD">Creatividad*</label>
                <select name="creatiD" id="creatiD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="honestoD">Honestidad*</label>
                <select name="honestoD" id="honestoD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="integriD">Integridad*</label>
                <select name="integriD" id="integriD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="relacionD">Relaciones con los compañeros de trabajo*</label>
                <select name="relacionD" id="relacionD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="clientesD">Relaciones con los clientes*</label>
                <select name="clientesD" id="clientesD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="habilidadesD">Habilidades Técnicas*</label>
                <select name="habilidadesD" id="habilidadesD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="fiabilidadD">Fiabilidad*</label>
                <select name="fiabilidadD" id="fiabilidadD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                
                <label for="puntualD">Puntualidad*</label>
                <select name="puntualD" id="puntualD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="asistenciaD">Asistencia*</label>
                <select name="asistenciaD" id="asistenciaD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="interesD">Interés en su trabajo*</label>
                <select name="interesD" id="interesD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="compromisoD">Compromiso*</label>
                <select name="compromisoD" id="compromisoD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="resultadoD">Compromiso*</label>
                <select name="resultadoD" id="resultadoD">
                        <option value="0" selected disabled>Seleccione una opción</option>
                        <option value="4">Excelente</option>
                        <option value="3">Bien</option>
                        <option value="2">Satisfactorio</option>
                        <option value="1">Insatisfactorio</option>
                </select>

                <label for="comentarioD">Comentarios</label>
                <textarea name="comentarioD" id="comentarioD"></textarea>

                <div class="contenedor-boton">
                    <input class="boton-form-naranja" type="submit" value="Capturar">
                </div>

            </form>
        </div>
    </section>
</main>
<script src="js/controllers/evaluacionDese.js"></script>
<?php
incluirTemplate('_footer');
?>