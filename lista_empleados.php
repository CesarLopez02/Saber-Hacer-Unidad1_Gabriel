<?php
session_start();
require_once 'conexion.php';

// Clase Empleado
class Empleado {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function obtenerTodos() {
        $query = $this->db->prepare('SELECT * FROM empleados');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $apellido, $email, $telefono, $area) {
        $query = "UPDATE empleados SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono, area = :area WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':area', $area);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM empleados WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Obtener la conexión PDO
$pdo = getConnection();
$empleadoObj = new Empleado($pdo);

// Manejo de formularios
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar_empleado'])) {
        $empleadoObj->actualizar($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['telefono'], $_POST['area']);
        header('Location: lista_empleados.php');
        exit;
    }

    if (isset($_POST['eliminar_empleado'])) {
        $empleadoObj->eliminar($_POST['id']);
        header('Location: lista_empleados.php');
        exit;
    }
}

$empleados = $empleadoObj->obtenerTodos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados - Mi Sitio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <div class="container mt-5">
        <h2 class="text-center">Datos de Empleados Registrados</h2>
        <div class="d-flex justify-content-end">
            <form class="d-flex" role="search">
                <input type="text" class="form-control form-control me-2" placeholder="Buscar empleado" aria-label="Buscar empleado" aria-describedby="basic-addon2" id="searchInput">
            </form>
        </div>
        <table class="table table">
            <thead class="table-primary text">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?php echo htmlspecialchars($empleado['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['email']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($empleado['area']); ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarEmpleado<?php echo $empleado['id']; ?>">Editar</button>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarEmpleado<?php echo $empleado['id']; ?>">Eliminar</button>
                    </td>
                </tr>
                <!-- Modal para editar empleado -->
                <div class="modal fade" id="editarEmpleado<?php echo $empleado['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $empleado['id']; ?>">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="apellido" class="form-label">Apellido</label>
                                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo htmlspecialchars($empleado['apellido']); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($empleado['email']); ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo htmlspecialchars($empleado['telefono']); ?>">
                                    </div>
                                    <div class="mb-3">
                                    <label for="area" class="form-label">Área</label>
                                    <select class="form-select" id="area" name="area" value="">
                                    <option selected><?php echo htmlspecialchars($empleado['area']); ?></option>
                                    <option value="Ventas">Ventas</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Recursos Humanos">Recursos Humanos</option>
                                    <option value="Finanzas">Finanzas</option>
                                    <option value="Tecnologia">Tecnología</option>
                                   </select>
                        </div>
                                    <button type="submit" class="btn btn-primary" name="actualizar_empleado">Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal para eliminar empleado -->
                <div class="modal fade" id="eliminarEmpleado<?php echo $empleado['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Eliminar Empleado</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>¿Estás seguro de que deseas eliminar este empleado?</p>
                                <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $empleado['id']; ?>">
                                    <button type="submit" class="btn btn-danger" name="eliminar_empleado">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll("tbody tr");

            rows.forEach(function(row) {
                var cells = row.querySelectorAll("td");
                var found = false;

                cells.forEach(function(cell) {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>
</body>
</html>
