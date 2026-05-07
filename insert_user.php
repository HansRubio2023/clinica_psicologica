<?php 
session_start();

include("conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
$id = $_POST['id'];
$mail = $_POST['email'];
$password = $_POST['contrasena'];
$password=password_hash($password, PASSWORD_DEFAULT);
$usuario = $_POST['usuario'];



$verificar = "SELECT * FROM usuarios WHERE email = '$mail' AND id != '$id'";
    $resultado = mysqli_query($con, $verificar);
if(mysqli_num_rows($resultado) > 0) {
        header("Location: nuevo_usuario.php?id=$id&error=email_exists");
        exit();
    }

$sql = "INSERT INTO usuarios (email, contrasena, usuario) VALUES ('$mail', '$password', '$usuario')";
$query = mysqli_query($con, $sql);
if($query){
    Header("Location: usuarios.php");
}else {
    echo "Error al insertar el usuario";
}




?>