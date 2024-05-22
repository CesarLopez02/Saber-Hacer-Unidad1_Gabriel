<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña - Mi Sitio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Bootstrap Logo" width="30" height="24" class="d-inline-block align-text-top">
                Mi Sitio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro_empleados.php">Registro de Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_empleados.php">Lista de Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contacto.html">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ayuda.html">Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido de Recuperación de Contraseña -->
    <div class="container mt-1">
        <div class="container-form">
            <div class="form-container">
                <div class="text-center welcome-message">
                    <h1>Recuperacion De Contraseña</h1>
                    <form>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nuevo Password</label>
                            <input type="text" class="form-control" placeholder="Ingresa tu Nuevo Password">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Telefono</label>
                            <input type="text" class="form-control" placeholder="Confirma Tu Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
