<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Agenda de Citas</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>

</head>

<body>
  <div class="container-fluid mt-4">
    <div class="card shadow">
      <div class="card-body">
        <h3 class="text-center text-secondary mb-4">AGENDA DE CITAS</h3>

        <div class="row g-3 align-items-end mb-4">
          <div class="col-md-3" align="left">
            <button class=" btn-lg btn btn-rounded btn-info" id="btnNuevoPed" onclick="mostrarformularioReg();">
              <i class="fa fa-plus me-2"></i>Nuevo
            </button>
          </div>
          <!-- <div class="col-md-9" align="right">
            <button class=" btn-lg btn btn-rounded btn-info" id="btnBusqueda">
              <i class="fa fa-filter me-2"></i>Filtrar
            </button>
          </div> -->
        </div>


        <!-- Filtros -->
        <div class="row g-3 align-items-end mb-4" hidden id="divFiltro">
          <div class="col-md-3">
            <label class="form-label">Fecha Desde - Hasta</label>
            <div class="input-group">
              <input type="text" class="form-control" id="FechaDesdeBusq" placeholder="dd/mm/yyyy">
              <span class="input-group-text">-</span>
              <input type="text" class="form-control" id="FechaHastaBusq" placeholder="dd/mm/yyyy">
              <button class="btn btn-outline-info" id="btnBuscarFechas">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>

          <div class="col-md-3">
            <label class="form-label">Por Especialidad</label>
            <select class="form-select" id="cboFilEspecialidad">
              <option value="">Todas</option>
              <option value="1">Medicina General</option>
              <option value="2">Pediatría</option>
              <option value="3">Dermatología</option>
            </select>
          </div>

          <div class="col-md-4">
            <label class="form-label">Por Num Doc/Paciente</label>
            <div class="input-group">
              <input type="text" class="form-control" id="PacientBusq" placeholder="Número de documento o nombre">
              <button class="btn btn-outline-info" id="btnBuscarPaciente">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>

          <div class="col-md-2 text-end">
            <button class="btn btn-info w-100" id="btnBusquedaGeneralListado">
              <i class="fa fa-sync-alt me-2"></i>Generar
            </button>
          </div>
        </div>

        <!-- Formulario -->
        <div id="verFormulario" style="display: none;">
          <form id="formPaciente">
          <hr>
          <div class="row mb-4" id="divAgendaCita">
            <div class="col-md-3">
              <div class="card text-center">
                <div class="card-body">
                  <h1 style="font-size: 100px;" class="text-center text-inverse p-t-30" id="hDiaFecha"></h1>
                  <h1 class="text-info text-center p-t-20" id="hNombreMes"></h1> <br>
                  <input type="hidden" class="form-control" id="txtFechaCompleta">
                  <input type="button" class="btn btn-block btn-rounded btn-outline-info" id="btnCambiaFecha"
                    onchange="diaSemana()">
                </div>
              </div>
            </div>
            <div class="col-md-9">
              <h4 class="text-primary">Nombre Paciente:</h4>
              <div id="divContMedicos">
                <input type="text" class="form-control" id="txtNomPaciente" required name="txtNomPaciente">
              </div>
              <hr style="border-top: 1px dashed #1e88e5;">
              <h4 class="text-primary">Especialidad:</h4>
              <!-- <p class="text-muted">Selecciona la Especialidad y la fecha para tu cita.</p> -->
              <div id="divContMedicos">
                <select class="form-select" id="cboEspecialidad" required>
                  <option selected value="1">Medicina General</option>
                  <option value="2">Pediatría</option>
                  <option value="3">Dermatología</option>
                </select>
              </div>
            </div>
          </div>

          <div class="text-center">
            <button class="btn btn btn-lg btn-success btn-lg me-2" type="submit" id="btnRegistrarCita"><i
                class="fa fa-save"></i> Registrar</button>
            <a href="index.html" class="btn btn-secondary btn-lg me-2" id="btnCancelarReg">
              <i class="fa fa-times-circle"></i> Cancelar
            </a>
          </div>
          </form>
        </div>

        <!-- Listado -->
        <div id="verListado" class="table-responsive mt-4">
          <table class="table table-bordered table-striped align-middle" id="listado">
            <thead class="table-info">
              <tr>
                <th>N°</th>
                <th>Paciente</th>
                <th>Fecha</th>
                <th>Especialidad</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody id="tbListCita">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="js/agenda.js"></script>
</body>

</html>