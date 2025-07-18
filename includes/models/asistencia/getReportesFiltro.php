<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // echo json_encode($_POST);
    if (!empty($_POST)) {
        $dirSemanal = 'C:\laragon\www\rrhhmorgall\assets\reportes\semanal';
        $dirQuincenal = 'C:\laragon\www\rrhhmorgall\assets\reportes\quincenal';
        $dirVentas = 'C:\laragon\www\rrhhmorgall\assets\reportes\ventas';

        // Obtiene una lista de todos los archivos y carpetas dentro del directorio
        $archSemanal = scandir($dirSemanal);
        $archQuincenal = scandir($dirQuincenal);
        $archVentas = scandir($dirVentas);

        //validar cuantas variables tiene post
        $filtro = '';

        if ($_POST['mesReporte'] != 0 && $_POST['anioReporte'] != 0) {
            $filtro = $_POST['anioReporte'] . '-' . $_POST['mesReporte'] . '-';
        } else if ($_POST['mesReporte'] != 0) {
            $filtro = '-' . $_POST['mesReporte'] . '-';
        } else if ($_POST['anioReporte'] != 0) {
            $filtro = $_POST['anioReporte'] . '-';
        }   

        if ($_POST['tReporte'] != 0) {
            if ($_POST['tReporte'] == 'quincenal') {
                $dirQuincenal = 'C:\laragon\www\rrhhmorgall\assets\reportes\quincenal';
                $archQuincenal = scandir($dirQuincenal);
                $reportesFiltrados = array_filter($archQuincenal, function ($archQuincenal) use ($filtro) {
                    // Ignorar los archivos especiales "." y ".."
                    if ($archQuincenal === '.' || $archQuincenal === '..') {
                        return false;
                    }
                    // Verificar si el nombre del archivo contiene el mes y el año
                    return strpos($archQuincenal, $filtro) !== false;
                });
            } else if ($_POST['tReporte'] == 'semanal') {
                $dirSemanal = 'C:\laragon\www\rrhhmorgall\assets\reportes\semanal';
                $archSemanal = scandir($dirSemanal);
                $reportesFiltrados = array_filter($archSemanal, function ($archSemanal) use ($filtro) {
                    // Ignorar los archivos especiales "." y ".."
                    if ($archSemanal === '.' || $archSemanal === '..') {
                        return false;
                    }
                    // Verificar si el nombre del archivo contiene el mes y el año
                    return strpos($archSemanal, $filtro) !== false;
                });
            } else if($_POST['tReporte'] == 'ventas'){
                $dirVentas = 'C:\laragon\www\rrhhmorgall\assets\reportes\ventas';
                $archVentas = scandir($dirVentas);
                $reportesFiltrados = array_filter($archVentas , function ($archVentas) use ($filtro) {
                    // Ignorar los archivos especiales "." y ".."
                    if ($archVentas  === '.' || $archVentas  === '..') {
                        return false;
                    }
                    // Verificar si el nombre del archivo contiene el mes y el año
                    return strpos($archVentas , $filtro) !== false;
                });
            }
        } else {
            $reportesSemanales = array_filter($archSemanal, function ($archSemanal) use ($filtro) {
                // Ignorar los archivos especiales "." y ".."
                if ($archSemanal === '.' || $archSemanal === '..') {
                    return false;
                }
                // Verificar si el nombre del archivo contiene el mes y el año
                return strpos($archSemanal, $filtro) !== false;
            });

            $reportesQuinenales = array_filter($archQuincenal, function ($archQuincenal) use ($filtro) {
                // Ignorar los archivos especiales "." y ".."
                if ($archQuincenal === '.' || $archQuincenal === '..') {
                    return false;
                }
                // Verificar si el nombre del archivo contiene el mes y el año
                return strpos($archQuincenal, $filtro) !== false;
            });

            $reportesVentas = array_filter($archVentas, function ($archVentas) use ($filtro) {
                // Ignorar los archivos especiales "." y ".."
                if ($archVentas === '.' || $archVentas === '..') {
                    return false;
                }
                // Verificar si el nombre del archivo contiene el mes y el año
                return strpos($archVentas, $filtro) !== false;
            });

            $allArchivosFiltro = array_merge($reportesSemanales, $reportesQuinenales);

            $reportesFiltrados = $allArchivosFiltro;
        }
        echo json_encode($reportesFiltrados);
    }
}
