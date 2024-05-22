<?php 
	session_start();
	require_once '../conexion.php';

	if(isset($_POST['aceptar']))
    {
		print_r($_POST);
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $email=$_POST['email'];
        $telefono=$_POST['telefono'];
        $area=$_POST['area'];
 
        $sql=$cnnPDO->prepare("INSERT INTO empleados (nombre, apellido, email, telefono, area) VALUES(:nombre, :apellido, :email, :telefono, :area)");

        $sql->bindParam(':nombre',$nombre);
        $sql->bindParam(':apellido',$apellido);
        $sql->bindParam(':email',$email);
        $sql->bindParam(':telefono',$telefono);
        $sql->bindParam(':area',$area);

        //Ejecutar variable $sql
       $sql->execute();
        unset($sql);

        header("location:registro_empleados.php");
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
    <link rel="stylesheet" href="CSS/style.css">
    <style>
        .container-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }

        .form-container {
            width: 500px;
            padding: 20px;
            border-radius: 10px;
            border: 5px solid #007bff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f8f9fa;
        }
    </style>
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
                        <a class="nav-link" href="registro_empleados.html">Registro de Empleados</a>
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
    <div class="container mt-1">
        <div class="container-form">
            <div class="form-container">
                <div class="text-center welcome-message">
                    <h1>Registrar Empleados</h1>
                    <form method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Ingresa el apellido del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa el correo electrónico del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ingresa el número de teléfono del empleado">
                        </div>
                        <div class="mb-3">
                            <label for="area" class="form-label">Área</label>
                            <select class="form-select" id="area" name="area">
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
