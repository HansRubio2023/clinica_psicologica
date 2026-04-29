<?php
session_start();

include("conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$id_paciente = $_POST['id_evaluacion']; 
$rut = $_POST['rut'];
$nombre= $_POST['nombre'];
$apellido= $_POST['apellido'];
$id_tipo_atencion = $_POST['id_tipo_atencion'];
$id_derivacion = $_POST['id_derivacion'];
$nueva_derivacion = $_POST['nueva_derivacion'];
$comentarios = $_POST['comentarios'];  
$fecha_registro = $_POST['fecha_registro'];
$usuario = $_POST['usuario'];
$id_profesion = $_POST['id_profesion'];




if ($id_derivacion === 'nueva' && !empty($nueva_derivacion)) {
    $sql_derivacion = "INSERT INTO tipo_derivacion (nombre_institucion_derivacion) VALUES ('$nueva_derivacion')";
    if (mysqli_query($con, $sql_derivacion)) {
        $id_derivacion = mysqli_insert_id($con);
    } else {
        $_SESSION['error'] = "Error al agregar nueva derivación: " . mysqli_error($con);
        header("Location: nueva_prestacion.php");
        exit;
    }
}

if (empty($fecha_registro)) {
    $_SESSION['error'] = "No puedes dejar la fecha vacía";
    header('location: editar_prestaciones.php?id_evaluacion=' . $_POST['id_evaluacion']);
    exit();
}


$sql = "UPDATE evaluaciones SET 
        rut='$rut', 
        nombre='$nombre',
        apellido='$apellido',
        id_tipo_atencion='$id_tipo_atencion', 
        derivacion='$id_derivacion', 
        comentarios='$comentarios', 
        fecha_registro='$fecha_registro', 
        usuario='$usuario', 
        id_profesion='$id_profesion' 
        WHERE id_evaluacion='$id_paciente'";

$query = mysqli_query($con, $sql);

if($query) {
    // Si todo sale bien, vuelve a la lista de pacientes
    header("Location: prestaciones.php");
} else {
    // Si hay error de base de datos, lo mostramos
    echo "Error de SQL: " . mysqli_error($con);
}

?>