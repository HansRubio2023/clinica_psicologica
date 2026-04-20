<?php 
session_start();

include("conexion/Conexion.php");

$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['rol']!=='admin') {
    header("Location: index.php");
    exit;
}

$sql = "SELECT id, email,contrasena,fecha_logueo,usuario,rol FROM usuarios";

$query = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="css/nuevo_pacientes.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
    <body>
         <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
            <i class="fas fa-home btn-icon"></i>
            Inicio
        </a>
        
        <a id="cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
            <i class="fas fa-sign-out-alt btn-icon"></i>
            Cerrar Sesión
        </a>
    </div>   
    <div class="container mt-5">
<h1 style="color: white; text-align: center;" >Panel de Usuarios</h1>
<div class="d-flex justify-content-end mb-3">
    <a href="nuevo_usuario.php"class="btn btn-success btn-lg" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
         <i class="fas fa-plus" ></i> Nueva Sesión
    </a>
</div>

<div class="card-body p-4">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
        <tr>
           <!-- <th>ID</th> -->
            <th>Email</th>
            <th>contraseña</th>
            <th>Fecha de registro</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        </thead>
    </thead>
    <tbody>
        <?php while($fila = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <!--<td><?= $fila['id'] ?></td>-->
            <td><?= $fila['email'] ?></td>
            <td><?= $fila['contrasena'] ?></td>
            <td><?= $fila['fecha_logueo'] ?></td>
            <td><?= $fila['usuario'] ?></td>
            <td><?= $fila['rol'] ?></td>
            
            <td class="acciones"> 
                <a href="edit_usuario.php?id=<?= $fila['id'] ?>" class="btn btn-warning btn-sm me-1" >
                        <i class="fas fa-edit"></i>
                    </a>


            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</div>
    </body>
</html>

