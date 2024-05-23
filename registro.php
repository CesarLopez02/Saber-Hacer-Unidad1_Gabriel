<?php
session_start();
require_once 'conexion.php';

class AdminRegistration {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function registerAdmin($name, $user, $psw) {
        $sql = $this->pdo->prepare("INSERT INTO administrativos (name, user, psw) VALUES(:name, :user, :psw)");

        $sql->bindParam(':name', $name);
        $sql->bindParam(':user', $user);
        $sql->bindParam(':psw', $psw);

        // Ejecutar la consulta
        $sql->execute();

        // Obtener el ID del administrador recién registrado
        $adminId = $this->pdo->lastInsertId();

        return $adminId;
    }

    public function userExists($user) {
        $sql = $this->pdo->prepare("SELECT COUNT(*) AS count FROM administrativos WHERE user = :user");
        $sql->bindParam(':user', $user);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}

if(isset($_POST['aceptar'])) {
    // Verificar el captcha
    $captcha = $_POST['g-recaptcha-response'];
    $secretKey = '6LfedeQpAAAAAHaRGB2pUzwQWjjUzAbrZgj97L9X';
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha");
    $responseKeys = json_decode($response, true);

    if(intval($responseKeys["success"]) !== 1) {
        // El captcha no se pasó
        header("location: error.php");
        exit;
    }

    $name = $_POST['name'];
    $user = $_POST['user'];
    $psw = $_POST['psw'];

    // Obtener la conexión PDO desde el archivo de conexión
    $pdo = getConnection();

    // Crear instancia de AdminRegistration
    $adminRegistration = new AdminRegistration($pdo);

    // Verificar si el usuario ya existe
    if ($adminRegistration->userExists($user)) {
        // Usuario ya existe, mostrar mensaje de error
        $error = "El usuario ya está registrado.";
    } else {
        // Registrar administrador y obtener el ID
        $adminId = $adminRegistration->registerAdmin($name, $user, $psw);

        // Guardar el ID del administrador en la sesión
        $_SESSION['admin_id'] = $adminId;

        $_SESSION['name'] = $name;
        header("location: preguntas.php");
        exit;
    }
}
ob_end_flush();
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
                        <a class="nav-link" href="contacto.php">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ayuda.php">Ayuda</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-1">
        <div class="container-form">
            <div class="form-container">
                <div class="text-center welcome-message">
                    <h1>Registro de Usuario</h1>
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingresa tu Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Ingresa tu Usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="psw" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="psw" id="psw" placeholder="Ingresa tu Contraseña" required>
                        </div>
                        <div class="mb-3">
                            <?php if(isset($error)) { ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>
                            <div class="g-recaptcha" data-sitekey="6LfedeQpAAAAACaGbyp2ksaKrjDi770_aFKOlJnR"></div>
                        </div>
                        <button type="submit" id="aceptar" name="aceptar" class="btn btn-primary">Registrar</button>
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
