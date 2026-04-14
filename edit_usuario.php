<?php
session_start();
include("../clinica_psicologica/conexion/conexion.php");

$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $usuario = $_POST['usuario'];
    $rol = $_POST['rol'];

    // Verificar si el email ya existe en otro usuario
    $verificar = "SELECT * FROM usuarios WHERE email = '$email' AND id != '$id'";
    $resultado = mysqli_query($con, $verificar);

    if(mysqli_num_rows($resultado) > 0) {
        header("Location: edit_usuario.php?id=$id&error=email_exists");
        exit();
    } else {
        $sql = "UPDATE usuarios SET email='$email', contrasena='$contrasena', usuario='$usuario', rol = '$rol' WHERE id='$id'";
        $query = mysqli_query($con, $sql);

        if($query){
            Header("Location: usuarios.php");
        } else {
            header("Location: edit_usuario.php?id=$id&error=update_failed");
            exit();
        }
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
    <div class="menu-container">
        <div class="menu-card">
            <h1 class="menu-title text-center">Editar Usuario</h1>
            
            <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'email_exists') {
                    echo '<div class="alert alert-danger text-center" role="alert">Error: El email ya está registrado por otro usuario</div>';
                } elseif($_GET['error'] == 'update_failed') {
                    echo '<div class="alert alert-danger text-center" role="alert">Error al actualizar el usuario</div>';
                }
            }
            ?>
            
            <?php
            $id = $_GET['id'];
            $sql = "SELECT * FROM usuarios WHERE id='$id'";
            $query = mysqli_query($con, $sql);
            $fila = mysqli_fetch_assoc($query);
            ?>
            <form action="edit_usuario.php" method="POST">
                <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                <div style="max-width: 350px; margin: 0 auto;">
                    <div class="mb-3">
                        <label for="email" class="form-label"></label>
                        <i class="fa-solid fa-envelope text-primary"></i> Email
                        <input type="email" class="form-control" id="email" name="email" value="<?= $fila['email'] ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="contrasena" class="form-label"></label>
                        <i class="fa-solid fa-key text-primary"></i> Contraseña
                        <input type="password" class="form-control" id="contrasena" name="contrasena" value="<?= $fila['contrasena'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label"></label>
                        <i class="fas fa-user text-primary"></i> Nombre
                        <input type="text" class="form-control" id="usuario" name="usuario" value="<?= $fila['usuario'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="rol" class="form-label"></label>
                        <i class="fas fa-id-badge text-primary"></i> Rol
                        <select class="form-select" id="rol" name="rol" required>
                        <option value="admin">Admin</option>
                        <option value="usuario">Usuario</option>
                    </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">Actualizar Usuario</button>
                </div>
            </form>
        </div>

        <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
            <i class="fas fa-home btn-icon"></i>
            Inicio
        </a>
        
        <a id="cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
            <i class="fas fa-sign-out-alt btn-icon"></i>
            Cerrar Sesión
        </a>
    </div>
</body>
    </div>
</body>
</html>
