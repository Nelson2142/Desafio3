<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro de Usuarios | Sistema ABC</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet"/>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Sistema Usuarios</a>
    </div>
  </nav>

  <section class="container my-5" id="registro">
    <div class="card shadow-sm">
      <div class="card-header bg-primary text-white">
        <h5>Registro de Usuario</h5>
      </div>
      <div class="card-body">
        <form id="formularioRegistro" novalidate>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nombre completo</label>
              <input type="text" id="nombreCompleto" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo electrónico</label>
              <input type="email" id="email" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" id="password" class="form-control" minlength="6" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha de nacimiento</label>
              <input type="date" id="fechaNacimiento" class="form-control" required>
            </div>
          </div>
          <div class="mt-3 d-grid">
            <button type="submit" id="btnRegistrar" class="btn btn-primary">
              <i class="bi bi-save me-1"></i>Registrar
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <section class="container my-5" id="usuarios">
    <div class="card shadow-sm">
      <div class="card-header bg-info text-white">
        <h5>Usuarios Registrados</h5>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped">
            <thead class="table-dark">
              <tr>
                <th>ID</th><th>Nombre</th><th>Email</th>
                <th>Fecha nacimiento</th><th>Fecha registro</th><th>Acciones</th>
              </tr>
            </thead>
            <tbody id="tablaUsuarios">
              <!-- AJAX -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <!-- Modal Edición -->
  <div class="modal fade" id="editarUsuarioModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title">Editar usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="editId">
          <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" id="editNombreCompleto" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" id="editEmail" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input type="date" id="editFechaNacimiento" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button id="guardarCambios" class="btn btn-warning">Guardar cambios</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>