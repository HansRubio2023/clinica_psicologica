<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

$rut = $_POST['rut'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$id_rango_etareo = $_POST['id_rango_etareo'];
$comentarios = $_POST['comentarios'];  
$fecha_registro = $_POST['fecha_registro'];
$id_estado = $_POST['id_estado'];
$usuario = $_POST['usuario'];

$sql = "INSERT INTO pacientes VALUES 
('$rut', '$nombres', '$apellidos', '$email', '$celular', '$id_rango_etareo', '$comentarios', 
'$fecha_registro', '$id_estado', '$usuario')";

$query = mysqli_query($con, $sql);
if($query)
{
    header("location: pacientes.php");
};

?>