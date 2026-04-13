<?php 
session_start();
include("conexion/Conexion.php");

$con = connection();

$sql = "SELECT id, email,contrasena,fecha_logueo,usuario FROM usuarios";

$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="css/pacientes.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* CSS necesario para el buscador */
        .search-section {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            background: rgba(255,255,255,0.9);
        }
        #buscador:focus {
            box-shadow: 0 0 0 0.25rem rgba(0,123,255,0.25);
            border-color: #007bff;
        }
        .paciente-row {
            transition: all 0.3s ease;
        }
        .paciente-row:hover {
            background-color: #f8f9fd;
        }
    </style>
</head>
    <body>
        <div class="menu-container">
            <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
                <i class="fas fa-home btn-icon"></i>
                Inicio
            </a>
                        
            <a id= "cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
                <i class="fas fa-sign-out-alt btn-icon"></i>
                Cerrar Sesión
            </a>
    </div>    
    <div class="container mt-5">
<h1>Panel de Usuarios</h1>
<a href="nuevo_usuario.php" class="btn btn-primary mb-3">Agregar usuario</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>contraseña</th>
            <th>Fecha de registro</th>
            <th>Usuario</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= $fila['email'] ?></td>
            <td><?= $fila['contrasena'] ?></td>
            <td><?= $fila['fecha_logueo'] ?></td>
            <td><?= $fila['usuario'] ?></td>
            
            <td class="acciones"> 
                <a href="edit_usuario.php?id=<?= $fila['id'] ?>" class="btn btn-warning btn-sm">Editar</a>

            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
    </body>
</html>