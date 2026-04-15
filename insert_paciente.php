<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
$id = $_POST['id_paciente'];
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

 $verificar = "SELECT * FROM pacientes WHERE rut= '$rut' AND id_paciente != '$id'";
    $resultado = mysqli_query($con, $verificar);

    if(mysqli_num_rows($resultado) > 0) {
        header("Location: nuevo_paciente.php?id=$id&error=rut_exists");
        exit();
    }
    

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