<?php
session_start();


include("conexion/conexion.php");
$con = connection();


if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}




$id_sesion = $_POST['id_sesion']; 
$rut = $_POST['rut'];
$numero_sesion = $_POST['numero_sesion'];
$fecha_sesion = $_POST['fecha_sesion'];
$comentarios = $_POST['comentarios'];  
$usuario = $_POST['usuario'];
$asiste = $_POST['asiste'];


if (empty($fecha_sesion)) {
    $_SESSION['error'] = "No puedes dejar la fecha vacía";
    header("Location: editar_sesion.php?id_sesion=" . $_POST['id_sesion']);
    exit();
}

$sql = "UPDATE sesiones SET 
        rut='$rut', 
        numero_sesion='$numero_sesion', 
        fecha_sesion='$fecha_sesion', 
        comentarios='$comentarios', 
        asiste='$asiste', 
        usuario='$usuario' 
        WHERE id_sesion='$id_sesion'";

$query = mysqli_query($con, $sql);

if($query) {
    // Si todo sale bien, vuelve a la lista de pacientes
    header("Location: sesiones.php");
} else {
    // Si hay error de base de datos, lo mostramos
    echo "Error de SQL: " . mysqli_error($con);
}
?>