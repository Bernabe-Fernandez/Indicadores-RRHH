<?php
//declaramos constantes para incluir secciones
define('TEMPLATES_URL', 'includes/templates/');
define('FUNCIONES_URL', 'funciones.php');

//generamos funciones para el servidor
//funcion para incluir los templates creados
function incluirTemplate(string $nombre)
{
    include TEMPLATES_URL . "$nombre.html";
}