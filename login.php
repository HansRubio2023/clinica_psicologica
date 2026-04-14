<?php 

session_start();

include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"]== "POST"){
    
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $stmt = $con->prepare("SELECT id, email, contrasena,usuario,rol FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();   
    $result = $stmt->get_result();

    if($result->num_rows === 1){
    
    $user = $result->fetch_assoc();

    if($pass === $user['contrasena']){
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol'] = $user['rol'];

        header("Location: menu.php");
        exit;
    }
    else{
        echo "contraseña incorrecta";
    
    
    
    
    }
    }
    else{
        echo "usuario incorrecto";
    }
}
  
?>