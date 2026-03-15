<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

// Capturamos los datos asegurándonos que coincidan con el atributo 'name' del HTML
$id_paciente = $_POST['id_paciente']; // Este es el ID del paciente que queremos actualizar
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

// Preparamos el UPDATE usando el rut_original en el WHERE
$sql = "UPDATE pacientes SET 
        rut='$rut', 
        nombres='$nombres', 
        apellidos='$apellidos', 
        email='$email', 
        celular='$celular', 
        id_rango_etareo='$id_rango_etareo', 
        comentarios='$comentarios', 
        fecha_registro='$fecha_registro', 
        id_estado='$id_estado', 
        usuario='$usuario' 
        WHERE id_paciente='$id_paciente'";

$query = mysqli_query($con, $sql);

if($query) {
    // Si todo sale bien, vuelve a la lista de pacientes
    header("Location: pacientes.php");
} else {
    // Si hay error de base de datos, lo mostramos
    echo "Error de SQL: " . mysqli_error($con);
}
?>