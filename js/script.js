let tokenUser;
let nombreUsuario;
let inactividadMaxima = 300000; // 5 minutos en milisegundos (300000 ms)
let temporizador;
let fechaActual = moment().format("YYYY-MM-DD HH:mm:ss");

document.addEventListener("DOMContentLoaded", function () {
  const botonSession = $("#logout");
  const nombreLogin = $("#nombreUsuario");

  if (localStorage.length > 0) {
    //seleccionamos los botones y el menu
    crearUsuario(localStorage);
    nombreLogin.text(nombreUsuario);
    console.log(tokenUser)
    if (tokenUser === "master") {
      crearBoton();
    }
  } else {
    window.location.href = "http://localhost:8080/panelmrg/";
  }
  //cambiarSelect();
  // Eventos de usuario que reinician el temporizador
  $(document).on("mousemove click keydown scroll", function () {
    reiniciarTemporizador();
  });
  // Inicializa el temporizador al cargar la página
  reiniciarTemporizador();

  //cerrar session
  botonSession.on("click", function (event) {
    event.preventDefault(); // Previene el comportamiento por defecto del enlace
    cerrarSesion();
  });
});

function crearSelector(nombre, datos) {
  // Obtener el elemento select
  let select = $(nombre);
  select.empty();
  select.append(
    $("<option>", {
      value: 0,
      text: "Seleccione una opción",
      disabled: true,
      selected: true,
    })
  );
  // Llenar el select con las opciones
  datos.forEach(function (dato) {
    select.append(
      $("<option>", {
        text: dato.nombre,
        value: dato.id,
      })
    );
  });
}

function crearSelectorFiltro(nombre, datos) {
  // Obtener el elemento select
  let selectFiltro = $(nombre);
  selectFiltro.empty();
  selectFiltro.append(
    $("<option>", {
      value: 0,
      text: "Todos",
      selected: true,
    })
  );
  // Llenar el select con las opciones
  datos.forEach(function (dato) {
    selectFiltro.append(
      $("<option>", {
        text: dato.nombre,
        value: dato.id,
      })
    );
  });
}

function crearUsuario(dataUsuario) {
  let datos = dataUsuario.getItem("datosUsuario");
  let dato = JSON.parse(datos);
  nombreUsuario = dato.nombreUser;
  tokenUser = dato.TokenAcceso;
  idEmpleado = dato.idEmpleado;
  correoUser = dato.correo;
}

function cerrarSesion() {
  //console.log(localStorage);

  Swal.fire({
    title: nombreUsuario,
    text: "¿Deseas cerrar sesión?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, cerrar sesión",
    cancelButtonText: "No, cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      localStorage.clear();
      // Redirige a la URL de cierre de sesión
      window.location.href = "http://localhost:8080/panelmrg/";
    }
  });
}

function reiniciarTemporizador() {
  clearTimeout(temporizador);
  temporizador = setTimeout(limpiarLocalStorage, inactividadMaxima);
}

function limpiarLocalStorage() {
  localStorage.clear();
  window.location.href = "http://localhost:8080/panelmrg/";
}

function crearBoton() {
  let enlace= $("<li>").append(
    $("<a>", {
      href: "http://localhost:8080/panelmrg/panelmrg.html",
    }).append(
      $("<ion-icon>", {
        name: "arrow-undo-outline",
      }),
      $("<span>", {
        text: "Regresar al Menu",
      })
    )
  );
  $("#inbox").closest("li").before(enlace);
}

// function cambiarSelect() {
  // $("select").change(function () {
    // var changedSelect = $(this);
    // $("select").each(function () {
      // if ($(this).attr("id") !== changedSelect.attr("id")) {
        // $(this).val("0");
      // }
    // });
  // });
// }
