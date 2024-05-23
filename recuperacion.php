<?php
session_start();
require_once 'conexion.php';

class PasswordRecovery {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function userExists($username) {
        $sql = $this->pdo->prepare("SELECT * FROM administrativos WHERE user = :username");
        $sql->bindParam(':username', $username);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        return $user ? true : false;
    }

    public function verifySecurityQuestions($username, $answer1, $answer2) {
        $sql = $this->pdo->prepare("SELECT * FROM administrativos WHERE user = :username AND pregunta1 = :answer1 AND pregunta2 = :answer2");
        $sql->bindParam(':username', $username);
        $sql->bindParam(':answer1', $answer1);
        $sql->bindParam(':answer2', $answer2);
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        return $user ? true : false;
    }
}

if(isset($_POST['recuperar_contraseña'])) {
    $username = $_POST['nombre_usuario'];
    $answer1 = $_POST['pregunta1'];
    $answer2 = $_POST['pregunta2'];

    // Obtener la conexión PDO desde el archivo de conexión
    $pdo = getConnection();

    // Crear una instancia de la clase PasswordRecovery
    $passwordRecovery = new PasswordRecovery($pdo);

    // Verificar si el usuario existe
    if($passwordRecovery->userExists($username)) {
        // Verificar si las respuestas a las preguntas de seguridad son correctas
        if($passwordRecovery->verifySecurityQuestions($username, $answer1, $answer2)) {
            // El usuario existe y las respuestas a las preguntas de seguridad son correctas
            $_SESSION['username'] = $username;
            // Redirecciona a la siguiente página
            header("location: nuevo_password.php");
            exit;
        } else {
            // El usuario existe pero las respuestas a las preguntas de seguridad son incorrectas
            $error = "El usuario es correcto pero las preguntas de seguridad son incorrectas.";
        }
    } else {
        // El usuario no existe, mostrar un mensaje de error
        $error = "El nombre de usuario no existe.";
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
                        <a class="nav-link" href="login.php">Inicio</a>
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
                    <h1>Recuperacion de contraseña</h1>
                    <<form method="post">
    <div class="mb-3">
        <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control" name="nombre_usuario" placeholder="Ingresa tu nombre de usuario" required>
    </div>
    <div class="mb-3">
        <label for="pregunta1" class="form-label">Pregunta de Seguridad 1</label>
        <input type="text" class="form-control" name="pregunta1" placeholder="Ingresa tu respuesta a la pregunta de seguridad 1" required>
    </div>
    <div class="mb-3">
        <label for="pregunta2" class="form-label">Pregunta de Seguridad 2</label>
        <input type="text" class="form-control" name="pregunta2" placeholder="Ingresa tu respuesta a la pregunta de seguridad 2" required>
    </div>
    <button type="submit" class="btn btn-primary" name="recuperar_contraseña">Recuperar Contraseña</button>
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
