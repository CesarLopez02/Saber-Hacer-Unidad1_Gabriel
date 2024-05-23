<?php 
session_start();

require 'conexion.php';

class UserAuthentication {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function authenticate($user, $psw) {
        $query = $this->pdo->prepare('SELECT * FROM administrativos WHERE user = :user AND psw = :psw');
        $query->bindParam(':user', $user);
        $query->bindParam(':psw', $psw);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}

if (isset($_POST['aceptar'])) {
    $user = $_POST['user'];
    $psw = $_POST['psw'];

    // Obtener la conexión a la base de datos desde el archivo conexion.php
    $pdo = getConnection();

    // Crear la instancia de autenticación
    $auth = new UserAuthentication($pdo);

    // Autenticar el usuario
    $userData = $auth->authenticate($user, $psw);

    if ($userData) {
        $_SESSION['user'] = $user;
        $_SESSION['psw'] = $psw;
        header("Location: index.php");
        exit;
    } else {
        // Aquí puedes manejar el error de autenticación
        $error = "Usuario o contraseña incorrectos.";
    }
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Mi Sitio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//code.tidio.co/krb5ztefd2rmo7hwogvrch8fof6nvfln.js" async></script>

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
                    <h1>Inicio de Sesion</h1>
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } ?>
                    <form method="post">
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Ingresa tu Usuario">
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="psw" id="psw" placeholder="Ingresa tu Contraseña">
                        </div>
                        <button type="submit" id="aceptar" name="aceptar" class="btn btn-primary">Iniciar Sesion</button>
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
