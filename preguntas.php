<?php
session_start();
require_once 'conexion.php';

class SecurityQuestionsUpdater {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updateSecurityQuestions($adminId, $pregunta1, $pregunta2) {
        $sql = $this->pdo->prepare("UPDATE administrativos SET pregunta1 = :pregunta1, pregunta2 = :pregunta2 WHERE id = :adminId");
        $sql->bindParam(':pregunta1', $pregunta1);
        $sql->bindParam(':pregunta2', $pregunta2);
        $sql->bindParam(':adminId', $adminId);
        $sql->execute();
    }
}

if(isset($_POST['aceptar'])) {
    // Verificar el captcha
    // Tu código de verificación de captcha aquí...

    // Obtener el ID del administrador de la sesión
    $adminId = $_SESSION['admin_id'];

    // Obtener las respuestas a las preguntas de seguridad del formulario
    $pregunta1 = $_POST['pregunta1'];
    $pregunta2 = $_POST['pregunta2'];

    // Obtener la conexión PDO desde el archivo de conexión
    $pdo = getConnection();

    // Crear una instancia de SecurityQuestionsUpdater
    $securityQuestionsUpdater = new SecurityQuestionsUpdater($pdo);

    // Actualizar las respuestas a las preguntas de seguridad en la base de datos
    $securityQuestionsUpdater->updateSecurityQuestions($adminId, $pregunta1, $pregunta2);

    // Redirigir a la página de login u otra página según sea necesario
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Mi Sitio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>reCAPTCHA Example</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
                        <a class="nav-link" href="registro.php">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recuperacion.php">Recuperar Contraseña</a>
                    </li>
                  
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-1">
        <div class="container-form">
            <div class="form-container">
                <div class="text-center welcome-message">
                    <h1>Preguntas de seguridad</h1>
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">¿Cuál es tu deporte favorito?</label>
                            <input type="text" class="form-control" id="pregunta1" name="pregunta1" placeholder="Ingresa tu respuesta" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">¿Cuál es tu comida favorita?</label>
                            <input type="text" class="form-control" id="pregunta2" name="pregunta2" placeholder="Ingresa tu respuesta" required>
                        </div>
                        <div class="mb-3">
                            <div class="g-recaptcha" data-sitekey="6LfedeQpAAAAACaGbyp2ksaKrjDi770_aFKOlJnR"></div>
                        </div>
                        <button type="submit" id="aceptar" name="aceptar" class="btn btn-primary">Aceptar</button>
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
