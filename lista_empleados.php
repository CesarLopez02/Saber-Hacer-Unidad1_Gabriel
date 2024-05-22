<?php 
	require_once '../conexion.php';
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
    <!-- Tabla Bootstrap -->
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
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <?php 
                $query = $cnnPDO->prepare('SELECT * FROM empleados');
                $query->execute();
                while($_SESSION = $query->fetch())
                {
            ?>
            <tbody id="tableBody">
                <!-- Aquí van los datos del formulario -->
                <tr>
                    <td><?php echo $_SESSION['nombre']?></td>
                    <td><?php echo $_SESSION['apellido']?></td>
                    <td><?php echo $_SESSION['email']?></td>
                    <td><?php echo $_SESSION['telefono']?></td>
                    <td><?php echo $_SESSION['area']?></td>
                    <td><button type="submit" id="editar" name="editar" class="btn btn-success">Editar</button></td>
                    <td><button type="submit" id="eliminar" name="eliminar" class="btn btn-danger">Eliminar</button></td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Enlace a Bootstrap JS y Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("searchInput").addEventListener("input", function() {
            var searchValue = this.value.toLowerCase();
            var rows = document.querySelectorAll("#tableBody tr");

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
