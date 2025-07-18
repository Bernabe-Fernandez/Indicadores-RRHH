$(document).ready(function () {
    getAllEmpleadosArea();
    getAllPeriodos();
    $("#gerenteJunta").val(nombreUsuario)
    setDateToToday("#fechaJunta");


    $("#boton-asistente").click(function (e) { 
        e.preventDefault();
        id = $("#asistentesJunta").val();

        // console.log(id)
        if(id === null){
            alerta({icono: 'error', mensaje: 'Debe Seleccionar un empleado'});
        }else{
            getInfoEmpleado(id);
        }
    });


    $("#formulario-addJuntas").submit(function (e) { 
        e.preventDefault();
        const validated = validatedFormulario();

        if(validated.indicador){
            $("#gerenteJunta").prop('disabled', false);
            const formData = {};
            $(this).serializeArray().forEach(field => {
                formData[field.name] = field.value;
            });
    
            // Agregamos los datos adicionales
            formData['user'] = nombreUsuario;
            formData['idUser'] = idEmpleado;
            formData['asistentes'] = JSON.stringify(validated.datos);

            createJunta(formData);
        }


    });
});



// funcion para cargar los periodos
function getAllPeriodos() {
    $.ajax({
        url: "includes/models/periodos/getPeriodos.php",
        type: "GET",
        dataType: "json",
        data: { key: "0"},
        success: function (periodo) {
            if(periodo.mensaje){
                alerta(periodo);
            }
            else{
                crearSelector("#periodoJunta", periodo);
            }
        },
        error: function (xhr, status, error) {
          alerta({ icono: "error", mensaje: error });
        },
      });
}


// funcion para cargar lista de empleados, dependiendo del gerente
function getAllEmpleadosArea() {
    $.ajax({
        url: "includes/models/getEmpleados.php",
        type: "GET",
        dataType: "json",
        data: { key: "4", idEmpleado: idEmpleado},
        success: function (empleado) {
            if(empleado.mensaje){
                alerta(empleado);
            }
            else{
                //mandar a llamar a la lista
                // console.log(empleado)
                $("#areaId").val(empleado.Area);
                getEmpleadosForArea(empleado.idEmpleado, empleado.Area);
            }
        },
        error: function (xhr, status, error) {
          alerta({ icono: "error", mensaje: error });
        },
      });
}


function getEmpleadosForArea(idEmpleado, area) {
    const selectorEmpleados = [];
    $.ajax({
        url: "includes/models/getEmpleados.php",
        type: "GET",
        dataType: "json",
        data: { key: "8", idEmpleado: idEmpleado, area: area },
        success: function (empleados) {
            if(empleados.mensaje){
                alerta(empleados);
            }
            else{
                empleados.forEach(empleado => {
                    selectorEmpleados.push({
                        id: empleado.idEmpleado,
                        nombre: empleado.Nombre
                    });
                });
                crearSelector("#asistentesJunta", selectorEmpleados);
            }
        },
        error: function (xhr, status, error) {
          alerta({ icono: "error", mensaje: error });
        },
      });
}


function getInfoEmpleado(id) {
    $.ajax({
        url: "includes/models/getEmpleados.php",
        type: "GET",
        dataType: "json",
        data: { key: "7", idEmpleado: id},
        success: function (empleado) {
            if(empleado.mensaje){
                alerta(empleado);
            }
            else{
                //mandar a llamar a la lista
                // console.log(empleado);
                createTableAsistentes(empleado);
            }
        },
        error: function (xhr, status, error) {
          alerta({ icono: "error", mensaje: error });
        },
      });
}


// crear una variable de asistentes
function extraerAsistentes() {
    const datos = []; // Array que almacenará los objetos con los datos de cada fila
    let indicador = false;
    if(!$("#noDataRowPed").length > 0){
        indicador = true;
        const filas = $("#tabla-asistentes tbody tr");
        filas.each(function (index, tr) {
            const fila = $(tr);
            

            // Crear un objeto para la fila
            const objetoFila = {
                no: fila.children('td').eq(0).text(),
                nombre: fila.children('td').eq(1).text(),
                puesto: fila.children('td').eq(2).text(),
                area: fila.children('td').eq(3).text(),
                id: fila.children('td').eq(4).text()
            };
        
            // Agregar el objeto de la fila al array
            datos.push(objetoFila);
        });
    }

    return {
        indicador: indicador,
        datos: datos
    }
    
}

//funcion para crear la tabla
function createTableAsistentes(empleado) {
    $("#noDataRowPed").remove();

    // Verificar si el empleado ya está en la tabla
    let existe = false;
    $("#tabla-asistentes tbody tr").each(function () {
        const idExistente = $(this).find(".hidden-column").text().trim();
        if (idExistente === empleado.idEmpleado.toString()) {
            existe = true;
            return false; // Romper el bucle si ya existe
        }
    });

    if (existe) {
        Swal.fire({
            icon: "warning",
            title: "Empleado ya agregado",
            text: `El empleado ${empleado.nombre} ya está en la lista.`,
        });
        return; // Salir de la función para no agregar duplicados
    }

    
    let contador = $("#tabla-asistentes tbody tr").length +1 ;

    // Crear un nuevo elemento <tr> con los datos
    const nuevaFila = `
        <tr>
            <td>${contador}</td>
            <td>${empleado.nombre}</td>
            <td>${empleado.puesto}</td>
            <td>${empleado.area}</td>
            <td class="hidden-column">${empleado.idEmpleado}</td>
        </tr>
    `;

    $("#tabla-asistentes tbody").append(nuevaFila);

}

// funcion para registrar la asistencia
function validatedFormulario() {
    const datosTable = extraerAsistentes();
    if($("#gerenteJunta").val() === ""){
        alerta({icono: 'error', mensaje:'Debe colcoarse el nombre de quien dirije la reunión'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if($("#areaId").val() === ""){
        alerta({icono: 'error', mensaje:'Debe colocar el area de la junta'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if($("#periodoJunta").val() === null){
        alerta({icono: 'error', mensaje:'Debe seleccionar un periodo'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if($("#fechaJunta").val() === ""){
        alerta({icono: 'error', mensaje:'Debe colocar una fecha'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if($("#horaJunta").val() === ""){
        alerta({icono: 'error', mensaje:'Debe colocar un horario'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if(!datosTable.indicador){
        alerta({icono: 'error', mensaje: 'Debe agregar al menos 1 asistente a la reunión'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if($("#temasJunta").val() === ""){
        alerta({icono: 'error', mensaje: 'Debe agregar al menos 1 tema tratado en la reunion'});
        return {
            indicador: false,
            datos: []
        }
    }
    else if($("#comentariosJunta").val() === ""){
        alerta({icono: 'error', mensaje: 'Debe agregar al menos 1 comentario y/o observación de la reunion'});
        return {
            indicador: false,
            datos: []
        }
    }
    else{
        return {
            indicador: true,
            datos: datosTable.datos
        }
    }
}


// funcion para enviar los datos al backend
function createJunta(formData) {
    // console.log(formData)
    $.ajax({
        url: "includes/models/juntas/createJuntas.php",
        type: "POST",
        data: formData, // Enviamos el objeto directamente
        processData: true, // Asegúrate de procesar los datos como pares clave-valor
        contentType: 'application/x-www-form-urlencoded', // Codificación estándar para formularios
        success: function (response) {
            alerta(response, function () {
                window.location.href = "juntasView.php";
              });
        },
        error: function (xhr, status, error) {
          alerta({ icono: "error", mensaje: error });
        },
      });
}


//funcion de alerta
function alerta(datos, callback) {
    return Swal.fire({
      title: datos.mensaje,
      icon: datos.icono,
    }).then((result) => {
      if (callback && result.isConfirmed) {
        callback();
      }
    });
  }

// funcion para obtener la fecha

function setDateToToday(inputId) {
    // Obtener la fecha actual
    const today = new Date();

    // Formatear la fecha en YYYY-MM-DD
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Mes (0-11)
    const day = String(today.getDate()).padStart(2, '0'); // Día (1-31)
    const formattedDate = `${year}-${month}-${day}`;

    $(inputId).val(formattedDate);
}