<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$rut = $_POST['rut'] ?? '';
$nombres = $_POST['nombres'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$email = $_POST['email'] ?? '';
$celular = $_POST['celular'] ?? '';
$id_rango_etareo = $_POST['id_rango_etareo'] ?? null; 
$comentarios = $_POST['comentarios'];
$fecha_registro = $_POST['fecha_registro'] ?? date("Y-m-d"); 
$id_estado = $_POST['id_estado'] ?? 1;
$usuario = $_POST['usuario'] ?? '';

$sql = "INSERT INTO pacientes (rut, nombres, apellidos, email, celular, id_rango_etareo, comentarios, fecha_registro, id_estado, usuario) 
        VALUES ('$rut', '$nombres', '$apellidos', '$email', '$celular', '$id_rango_etareo', '$comentarios', '$fecha_registro', '$id_estado', '$usuario')";

$query = mysqli_query($con, $sql);

if($query) {
    header("Location: pacientes.php");
    exit(); 
} else {
    
    echo "Error en la base de datos: " . mysqli_error($con);
}
?>