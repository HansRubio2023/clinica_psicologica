<?php 
session_start();
include("conexion/Conexion.php");
$con = connection();

$mail = $_POST['email'];
$password = $_POST['contrasena'];
$usuario = $_POST['usuario'];

$sql = "INSERT INTO usuarios (email, contrasena, usuario) VALUES ('$mail', '$password', '$usuario')";
$query = mysqli_query($con, $sql);
if($query){
    Header("Location: usuarios.php");
}else {
    echo "Error al insertar el usuario";
}




?>