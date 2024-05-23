<?php
session_start();
require_once 'conexion.php';

class PasswordUpdater {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function updatePassword($username, $newPassword) {
        $sql = $this->pdo->prepare("UPDATE administrativos SET psw = :newPassword WHERE user = :username");
        $sql->bindParam(':newPassword', $newPassword);
        $sql->bindParam(':username', $username);
        $sql->execute();
    }
}

if(isset($_POST['actualizar_contraseña'])) {
    $newPassword = $_POST['nuevo_password'];
    $confirmPassword = $_POST['confirmar_password'];

    // Verificar si las contraseñas coinciden
    if($newPassword !== $confirmPassword) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Obtener el nombre de usuario de la sesión
        $username = $_SESSION['username'];

        // Obtener la conexión PDO desde el archivo de conexión
        $pdo = getConnection();

        // Crear una instancia de PasswordUpdater
        $passwordUpdater = new PasswordUpdater($pdo);

        // Actualizar la contraseña en la base de datos
        $passwordUpdater->updatePassword($username, $newPassword);

        // Redirecciona a la página de éxito
        header("location: login.php");
        exit;
    }
}
?>

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
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="recuperacion.php">Recuperar Contraseña</a>
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
                    <form method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nuevo Password</label>
                            <input type="password" class="form-control" name="nuevo_password" placeholder="Ingresa tu Nuevo Password" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Confirmar Password</label>
                            <input type="password" class="form-control" name="confirmar_password" placeholder="Confirma Tu Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="actualizar_contraseña">Aceptar</button>
                        <?php if(isset($error)) { ?>
                            <div class="alert alert-danger mt-3" role="alert">
                                <?php echo $error; ?>
                            </div>
                        <?php } ?>
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

