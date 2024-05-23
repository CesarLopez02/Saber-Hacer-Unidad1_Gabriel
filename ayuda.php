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
    <title>Ayuda - Mi Sitio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="//code.tidio.co/krb5ztefd2rmo7hwogvrch8fof6nvfln.js" async></script>
    <title>Bootstrap Example</title>
    <link rel="stylesheet" href="style.css">
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

    <!-- Contenido de Ayuda -->
    <div class="container mt-5">
        <h2 class="text-center">Ayuda</h2>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="help-section">
                    <h3>Preguntas Frecuentes</h3>
                    <p>Encuentra respuestas a las preguntas más comunes sobre nuestro sitio.</p>
                    <ul>
                        <li><strong>¿Cómo puedo registrar a un nuevo empleado en el sistema?</strong><br>
                            Puedes registrar a un nuevo empleado completando el formulario de registro de empleados en la página correspondiente. Debes proporcionar la información requerida, como nombre, apellido, correo electrónico, teléfono, y área de trabajo.
                        </li>
                        <li><strong>¿Qué información necesito para registrar a un empleado?</strong><br>
                            Para registrar a un nuevo empleado, necesitas información básica como nombre completo, dirección de correo electrónico, número de teléfono y área en la que trabajará.
                        </li>
                        <li><strong>¿Puedo editar la información de un empleado después de registrarla?</strong><br>
                            Sí, puedes editar la información de un empleado en cualquier momento. Visita la página de lista de empleados, encuentra al empleado que deseas editar y haz clic en el botón "Editar".
                        </li>
                        <li><strong>¿Cómo elimino a un empleado del sistema?</strong><br>
                            Puedes eliminar a un empleado del sistema visitando la página de lista de empleados, encontrando al empleado que deseas eliminar y haciendo clic en el botón "Eliminar".
                        </li>
                        <li><strong>¿Qué debo hacer si olvidé la contraseña de mi cuenta de empleado?</strong><br>
                            Si olvidaste tu contraseña, puedes restablecerla haciendo clic en el enlace "¿Olvidaste tu contraseña?" en la página de inicio de sesión. Se te enviará un correo electrónico con instrucciones para restablecer tu contraseña.
                        </li>
                        <li><strong>¿Cómo puedo contactar al administrador del sistema si tengo problemas o preguntas adicionales?</strong><br>
                            Puedes ponerte en contacto con el administrador del sistema a través de la página de contacto, donde encontrarás información de contacto como correo electrónico y números de teléfono. También puedes utilizar los botones de redes sociales para contactar al administrador a través de plataformas como WhatsApp o Telegram.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
