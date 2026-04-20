<?php
session_start();

include("../clinica_psicologica/conexion/conexion.php");

$con = connection();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['rol']!=='admin') {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM usuarios";
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
    <div class="menu-container">
        <div class="menu-card">
            <h1 class="menu-title text-center">Agregar Usuario</h1>
            
            <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'email_exists') {
                    echo '<div class="alert alert-danger text-center" role="alert">Error: El email ya está registrado</div>';
                } elseif($_GET['error'] == 'insert_failed') {
                    echo '<div class="alert alert-danger text-center" role="alert">Error al insertar el usuario</div>';
                }
            }
            ?>
            
            <form action="insert_user.php" method="POST">
                <div style="max-width: 350px; margin: 0 auto;">
                <div class="mb-3">
                    <label for="email" class="form-label"></label>
                    <i class="fa-solid fa-envelope text-primary"></i> Email
                    <input type="email" class="form-control" id="email" name="email" placeholder="email"  required>
                </div>
                </div>
                <div style="max-width: 350px; margin: 0 auto;">
                <div class="mb-3">
                    <label for="contrasena" class="form-label"></label>
                    <i class="fa-solid fa-key text-primary"></i> Contraseña
                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="contraseña" required>
                </div>
                </div>
                <div class="mb-3">
                    <div style="max-width: 350px; margin: 0 auto;">
                    <label for="usuario" class="form-label"></label>
                     <i class="fas fa-user text-primary"></i> Nombre
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre" required>
                </div>
                </div>
                <div style="max-width: 350px; margin: 0 auto;">
                <div class="mb-3">
                    <label for="rol" class="form-label"></label>
                      <i class="fas fa-id-badge text-primary"></i> Rol
                    <select class="form-select" id="rol" name="rol" required>
                        <option value="admin">Admin</option>
                        <option value="usuario">Usuario</option>
                    </select>
                </div>
                </div >

                <button type="submit" class="btn btn-primary w-50 mt-4 d-block mx-auto" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;"> Guardar
                </button>
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
</html>