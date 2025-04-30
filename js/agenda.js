document.addEventListener("DOMContentLoaded", init);
let idCita = null;
var fechaActual = moment().format("DD/MM/YYYY");
function init() {
    // console.log("ingreso");
    const form = document.getElementById("formPaciente");
    form.addEventListener("submit", registrar);

    flatpickr("#btnCambiaFecha", {
        dateFormat: "d/m/Y",
        minDate: "today",
        defaultDate: "today",
        altInput: true,
        altFormat: "d/m/Y"
    });
    listado();
}

function mostrarformularioReg() {
    // console.log("registrar");
    document.getElementById("verFormulario").style.display = "block";
    document.getElementById("verListado").style.display = "none";
    document.getElementById("btnNuevoPed").style.display = "none";

    // $("#btnCambiaFecha").val("Cambiar Fecha");
    $("#txtFechaCompleta").val(fechaActual);
    var fechaAct = fechaActual;
    var valors = fechaAct.split('/');

    if (valors[1] == '01') {
        $("#hNombreMes").html("Enero");
    } else if (valors[1] == '02') {
        $("#hNombreMes").html("Febrero");
    } else if (valors[1] == '03') {
        $("#hNombreMes").html("Marzo");
    } else if (valors[1] == '04') {
        $("#hNombreMes").html("Abril");
    } else if (valors[1] == '05') {
        $("#hNombreMes").html("Mayo");
    } else if (valors[1] == '06') {
        $("#hNombreMes").html("Junio");
    } else if (valors[1] == '07') {
        $("#hNombreMes").html("Julio");
    } else if (valors[1] == '08') {
        $("#hNombreMes").html("Agosto");
    } else if (valors[1] == '09') {
        $("#hNombreMes").html("Septiembre");
    } else if (valors[1] == '10') {
        $("#hNombreMes").html("Octubre");
    } else if (valors[1] == '11') {
        $("#hNombreMes").html("Noviembre");
    } else if (valors[1] == '12') {
        $("#hNombreMes").html("Diciembre");
    }

    $("#hDiaFecha").html(valors[0]);
}

function diaSemana() {
    var fecha = $("#btnCambiaFecha").val();
    $("#txtFechaCompleta").val(fecha);

    var fecha = $("#txtFechaCompleta").val();
    var vals = fecha.split('/');

    if (vals[1] == '01') {
        $("#hNombreMes").html("Enero");
    } else if (vals[1] == '02') {
        $("#hNombreMes").html("Febrero");
    } else if (vals[1] == '03') {
        $("#hNombreMes").html("Marzo");
    } else if (vals[1] == '04') {
        $("#hNombreMes").html("Abril");
    } else if (vals[1] == '05') {
        $("#hNombreMes").html("Mayo");
    } else if (vals[1] == '06') {
        $("#hNombreMes").html("Junio");
    } else if (vals[1] == '07') {
        $("#hNombreMes").html("Julio");
    } else if (vals[1] == '08') {
        $("#hNombreMes").html("Agosto");
    } else if (vals[1] == '09') {
        $("#hNombreMes").html("Septiembre");
    } else if (vals[1] == '10') {
        $("#hNombreMes").html("Octubre");
    } else if (vals[1] == '11') {
        $("#hNombreMes").html("Noviembre");
    } else if (vals[1] == '12') {
        $("#hNombreMes").html("Diciembre");
    }

    $("#hDiaFecha").html(vals[0]);

}

function listado() {
    document.getElementById("verFormulario").style.display = "none";
    document.getElementById("verListado").style.display = "block";
    document.getElementById("btnNuevoPed").style.display = "block";
    const tabla = document.getElementById("tbListCita");
    fetch('controller/agendaAjax.php?action=listar')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en establecer la conexion.');
            }
            return response.json();
        })
        .then(data => {
            // console.log(data);
            tabla.innerHTML = "";
            data.forEach((p, index) => {
                // console.log(p);
                const fila = document.createElement("tr");
                fila.innerHTML = `
          <td>${index + 1}</td>
          <td>${p.nombrePaciente}</td>
          <td>${p.fechaCita}</td>
          <td>${p.especialidad}</td>
          <td>
            <button hidden class="btn btn-sm btn-primary me-2" onclick="editar(${p.idCita}, '${p.nombrePaciente}', '${p.fechaCita}')">Editar</button>
            <button class="btn btn-sm btn-danger" onclick="eliminar(${p.idCita})">Eliminar</button>
          </td>
        `;
                tabla.appendChild(fila);
            });
        })
        .catch(error => {
            console.error('No se pudo obtener la información', error);
        });
}

function eliminar(id) {
    // console.log(id);
    if (confirm("¿Está seguro de eliminar la cita,esta acción no se puede revertir.?")) {
        const formData = new FormData();
        formData.append("action", "eliminar");
        formData.append("id", id);

        fetch("controller/agendaAjax.php", {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                alert(data.mensaje);
                listado();
            })
            .catch(error => {
                 console.error("Error al eliminar:", error);
                // alert
            });
    }
}

function registrar(e) {
    e.preventDefault();
    const nombre = document.getElementById("txtNomPaciente").value;
    const fecha = document.getElementById("txtFechaCompleta").value;
    const especialidad = document.getElementById("cboEspecialidad").value;
    const action = idCita ? "actualizar" : "registrar";
    const formData = new FormData();
    formData.append("action", action);
    formData.append("nombre", nombre);
    formData.append("fecha", fecha);
    formData.append("especialidad", especialidad);
    if (idCita) formData.append("id", idCita);
    
    // for (let [key, value] of formData.entries()) {
    //     console.log(`${key}: ${value}`);
    //   }

    fetch("controller/agendaAjax.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data)
            if (data.error) {
                alert(data.mensaje);
                // swal("Mensaje del Sistema", data.mensaje, "error");
            } else {
                alert(data.mensaje);
                // swal("Mensaje del Sistema", data.mensaje, "success");
                location.reload();
            }
        })
        .catch(error => {
             console.error("Error al Registrar:", error);
        });

}