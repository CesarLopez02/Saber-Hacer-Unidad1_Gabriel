<?php 

session_start();
require_once 'conexion.php';
// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    // Si no está autenticado, redirigir al usuario al formulario de inicio de sesión
    header("Location: login.php");
    exit;
}

class EmpleadoManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function insertEmpleado($nombre, $apellido, $email, $telefono, $area) {
        $sql = $this->pdo->prepare("INSERT INTO empleados (nombre, apellido, email, telefono, area) VALUES(:nombre, :apellido, :email, :telefono, :area)");

        $sql->bindParam(':nombre', $nombre);
        $sql->bindParam(':apellido', $apellido);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':telefono', $telefono);
        $sql->bindParam(':area', $area);

        $sql->execute();
    }

    public function emailExists($email) {
        $sql = $this->pdo->prepare("SELECT COUNT(*) AS count FROM empleados WHERE email = :email");
        $sql->bindParam(':email', $email);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
}

if(isset($_POST['aceptar'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $area = $_POST['area'];

    // Obtener la conexión PDO desde el archivo conexion.php
    $pdo = getConnection();

    // Crear la instancia de EmpleadoManager con la conexión PDO
    $empleadoManager = new EmpleadoManager($pdo);

    // Verificar si el correo electrónico ya está registrado
    if ($empleadoManager->emailExists($email)) {
        // Correo electrónico ya existe, mostrar mensaje de error
        $error = "El correo electrónico ya está registrado.";
    } else {
        // Insertar empleado
        $empleadoManager->insertEmpleado($nombre, $apellido, $email, $telefono, $area);
        header("location:lista_empleados.php");
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
    <title>Inicio - Mi Sitio</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <div class="container mt-1">
        <div class="container-form">
            <div class="form-container">
                <div class="text-center welcome-message">
                    <h1>Registrar Empleados</h1>
                    <form method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" required id="nombre" name="nombre" placeholder="Ingresa el nombre del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" required id="apellido" name="apellido" placeholder="Ingresa el apellido del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" required id="email" name="email" placeholder="Ingresa el correo electrónico del empleado">
                            <?php if(isset($error)) { ?>
                                <div class="alert alert-danger mt-3" role="alert">
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" required id="telefono" name="telefono" placeholder="Ingresa el número de teléfono del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">Área</label>
                            <select class="form-select" required id="area" name="area">
                                <option selected>Selecciona el área del empleado</option>
                                <option value="Ventas">Ventas</option>
                                <option value="Marketing">Marketing</option>
                                <option value="Recursos Humanos">Recursos Humanos</option>
                                <option value="Finanzas">Finanzas</option>
                                <option value="Tecnologia">Tecnología</option>
                            </select>
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
