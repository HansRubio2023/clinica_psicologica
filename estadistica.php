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
       <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
                <i class="fas fa-home btn-icon"></i>
                Inicio
            </a>
                        
            <a id= "cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
                <i class="fas fa-sign-out-alt btn-icon"></i>
                Cerrar Sesión
            </a>
    </div>    
        <div class="menu-card">
            
            <a href="estadistica_pacientes.php" class="btn btn-pacientes menu-btn" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fas fa-users btn-icon"></i>
               Estadisticas de Pacientes
            </a>
             <a href="estadistica_prestaciones.php" class="btn btn-pacientes menu-btn" style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fa fa-stethoscopefas fa-file-medical btn-icon"></i>
               Estadisticas de Prestaciones
            </a>
             <a href="estadistica_sesiones.php" class="btn btn-pacientes menu-btn"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                <i class="fas fa-calendar-check btn-icon"></i>
               Estadisticas de Sesiones
            </a>