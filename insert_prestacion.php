<?php
session_start();

include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

//$id_evaluacion = $_POST['id_evaluacion'] ?? null;
$rut = $_POST['rut'] ?? '';
$id_tipo_atencion = $_POST['id_tipo_atencion'] ?? '';
$derivacion = $_POST['derivacion'] ?? '';
$comentarios = $_POST['comentarios'];
$fecha_registro = $_POST['fecha_registro'] ?? date("Y-m-d"); 
$usuario = $_POST['usuario'] ?? '';
$id_profesion = $_POST['id_profesion'] ?? '';

if (empty($fecha_registro)) {
    $_SESSION['error'] = "La fecha de registro es obligatoria";
    header("Location: nueva_prestacion.php");
    exit;
}
    

$sql = "INSERT INTO evaluaciones ( rut, id_tipo_atencion, derivacion, comentarios, fecha_registro, usuario, id_profesion) 
        VALUES ( '$rut', '$id_tipo_atencion', '$derivacion', '$comentarios', '$fecha_registro', '$usuario', '$id_profesion')";

$query = mysqli_query($con, $sql);

if($query) {
    header("Location: prestaciones.php");
    exit(); 
} else {
    
    echo "Error en la base de datos: " . mysqli_error($con);
}
?>