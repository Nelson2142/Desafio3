<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios | Sistema ABC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        .hero-section {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        .feature-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #6e8efb;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }
        .card-registro {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border: none;
            margin-bottom: 30px;
        }
        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }
        .navbar-brand {
            font-weight: 700;
        }
        .nav-link {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- Barra de Navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-people-fill me-2"></i>Sistema Usuarios
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-house-door me-1"></i> Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#registro"><i class="bi bi-person-plus me-1"></i> Registro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#usuarios"><i class="bi bi-list-ul me-1"></i> Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-question-circle me-1"></i> Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Sistema de Gestión de Usuarios</h1>
            <p class="lead">Registra, administra y visualiza todos los usuarios de tu organización</p>
        </div>
    </section>

    <!-- Contenido Principal -->
    <div class="container my-5" id="registro">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-registro">
                    <div class="card-header bg-primary text-white">
                        <h3 class="text-center my-2"><i class="bi bi-person-plus me-2"></i>Formulario de Registro</h3>
                    </div>
                    <div class="card-body p-4">
                        <form id="formularioRegistro">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombreCompleto" class="form-label">Nombre Completo</label>
                                    <input type="text" class="form-control" id="nombreCompleto" required>
                                    <div class="invalid-feedback">Por favor ingresa tu nombre completo</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" required>
                                    <div class="invalid-feedback">Por favor ingresa un email válido</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" minlength="6" required>
                                    <div class="invalid-feedback">La contraseña debe tener al menos 6 caracteres</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fechaNacimiento" class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" class="form-control" id="fechaNacimiento" required>
                                    <div class="invalid-feedback">Por favor ingresa tu fecha de nacimiento</div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-save me-2"></i>Registrar Usuario
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sección de Usuarios -->
    <div class="container my-5" id="usuarios">
        <div class="row">
            <div class="col-12">
                <div class="card card-registro">
                    <div class="card-header bg-info text-white">
                        <h3 class="text-center my-2"><i class="bi bi-people-fill me-2"></i>Usuarios Registrados</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre Completo</th>
                                        <th>Email</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaUsuarios">
                                    <!-- Los usuarios se cargarán aquí dinámicamente -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

   

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Sistema de Usuarios</h5>
                    <p>Una solución completa para la gestión de usuarios en tu organización.</p>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Inicio</a></li>
                        <li><a href="#registro" class="text-white">Registro</a></li>
                        <li><a href="#usuarios" class="text-white">Usuarios</a></li>
                        <li><a href="#" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-envelope me-2"></i> info@sistemausuarios.com</li>
                        <li><i class="bi bi-telephone me-2"></i> +1 234 567 890</li>
                        <li><i class="bi bi-geo-alt me-2"></i> Ciudad, País</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; 2023 Sistema Usuarios. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white me-3"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal para editar usuario -->
    <div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-hidden="true">
     
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>