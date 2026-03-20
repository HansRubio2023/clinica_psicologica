<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

$id_evaluacion = $_POST['id_evaluacion'] ?? null;
$rut = $_POST['rut'] ?? '';
$id_tipo_atencion = $_POST['id_tipo_atencion'] ?? '';
$derivacion = $_POST['derivacion'] ?? '';
$comentarios = $_POST['comentarios'];
$fecha_registro = $_POST['fecha_registro'] ?? date("Y-m-d"); 
$usuario = $_POST['usuario'] ?? '';
$id_profesion = $_POST['id_profesion'] ?? '';

$sql = "INSERT INTO evaluaciones (id_evaluacion, rut, id_tipo_atencion, derivacion, comentarios, fecha_registro, usuario, id_profesion) 
        VALUES ('$id_evaluacion', '$rut', '$id_tipo_atencion', '$derivacion', '$comentarios', '$fecha_registro', '$usuario', '$id_profesion')";

$query = mysqli_query($con, $sql);

if($query) {
    header("Location: prestaciones.php");
    exit(); 
} else {
    
    echo "Error en la base de datos: " . mysqli_error($con);
}
?>