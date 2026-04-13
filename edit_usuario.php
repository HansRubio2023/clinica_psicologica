<?php
session_start();
include("../clinica_psicologica/conexion/conexion.php");

$con = connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $usuario = $_POST['usuario'];

    $sql = "UPDATE usuarios SET email='$email', contrasena='$contrasena', usuario='$usuario' WHERE id='$id'";
    $query = mysqli_query($con, $sql);

    if($query){
        Header("Location: usuarios.php");
    } else {
        echo "Error al actualizar el usuario";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="css/nuevo_pacientes.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">    
        <h1>Editar Usuario</h1>
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM usuarios WHERE id='$id'";
        $query = mysqli_query($con, $sql);
        $fila = mysqli_fetch_assoc($query);
        ?>
        <form action="edit_usuario.php" method="POST">
            <input type="hidden" name="id" value="<?= $fila['id'] ?>">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $fila['email'] ?>" required>
            </div>
            <div class="menu-container">
            <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
                <i class="fas fa-home btn-icon"></i>
                Inicio
            </a>
                        
            <a id= "cerrar_sesion" href="index.php" class="btn btn-logout menu-btn">
                <i class="fas fa-sign-out-alt btn-icon"></i>
                Cerrar Sesión
            </a>
    </div>    
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?= $fila['contrasena'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $fila['usuario'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
