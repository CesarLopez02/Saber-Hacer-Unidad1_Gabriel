<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    // Si no está autenticado, redirigir al usuario al formulario de inicio de sesión
    header("Location: login.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Mi Sitio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <!-- Enlace a Font Awesome para iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="//code.tidio.co/krb5ztefd2rmo7hwogvrch8fof6nvfln.js" async></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="login.php">
                <img src="logo.png" alt="Bootstrap Logo" width="30" height="24" class="d-inline-block align-text-top">
                TILDO MX
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registro_empleados.php">Registro de Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lista_empleados.php">Lista de Empleados</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Más
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="contacto.php">Contacto</a></li>
                            <li><a class="dropdown-item" href="ayuda.php">Ayuda</a></li>
                            <li><a class="dropdown-item" href="logout.php">Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido de Contacto -->
    <div class="container mt-5">
        <h2 class="text-center">Contacto</h2>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- Iconos de redes sociales -->
                <div class="mb-3">
                    <h4 class="mb-3">Contáctame por:</h4>
                    <a href="https://wa.me/tunumero" target="_blank" class="btn btn-success me-3"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                    <a href="https://telegram.me/tuusuario" target="_blank" class="btn btn-primary me-3"><i class="fab fa-telegram"></i> Telegram</a>
                    <a href="mailto:tucorreo@gmail.com" class="btn btn-danger me-3"><i class="fas fa-envelope"></i> Correo Electrónico</a>
                </div>

                <!-- Formulario de contacto -->
                <form class="contact-form">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="window.location.href = 'error.php';">Enviar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <!-- Enlace a Font Awesome para iconos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
