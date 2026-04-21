<?php

session_start();




include("conexion/Conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}



?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link rel="stylesheet" href="css/menu.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    
</head>
<body>
    <div class="menu-container">
         <!-- <a id="inicio" href="inicio.php" class="btn btn-inicio menu-btn">
                <i class="fas fa-home btn-icon"></i>
                Inicio
            </a>-->
                        
            <a id= "cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
                <i class="fas fa-sign-out-alt btn-icon"></i>
                Cerrar Sesión
            </a>
    </div>    
        <div class="menu-card">
            <h1 class="menu-title">
                <center>
                    <img src="img/unap_positivo.png" alt="Logo" class="logo" style="width: 120px; height: auto;"><br>
                App Clínica Psicologíca
                </center>
            </h1>
            
            <a href="pacientes.php" class="btn btn-pacientes menu-btn" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fas fa-users btn-icon"></i>
                Pacientes
            </a>
             <a href="prestaciones.php" class="btn btn-pacientes menu-btn" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fa fa-stethoscopefas fa-file-medical btn-icon"></i>
                Prestaciones
            </a>
             <a href="sesiones.php" class="btn btn-pacientes menu-btn"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fas fa-calendar-check btn-icon"></i>
                Sesiones
            </a>
             <a href="estadistica.php" class="btn btn-pacientes menu-btn" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fas fa-users btn-icon"></i>
                Estadisticas
            <?php if ($_SESSION['rol'] === 'admin'): ?>
                <a href="usuarios.php" class="btn btn-pacientes menu-btn"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">  
                    <i class="fas fa-chart-bar btn-icon"></i>
                    Usuarios
                </a>
            <?php endif; ?>
                <div class=row justify-content-center>
    <div  style="position: absolute; top: -50px;left: -400px;" >
    <h2 style="color: white;"> <?php  echo $_SESSION['usuario']; ?></h2>

        
</div>


    </div>
</div>  
</body>
</html>