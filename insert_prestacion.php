<?php
session_start();

include("conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

//$id_evaluacion = $_POST['id_evaluacion'] ?? null;
$rut = $_POST['rut'] ?? '';
$nombre= $_POST['nombre']?? '';
$apellido= $_POST['apellido']?? '';
$id_tipo_atencion = $_POST['id_tipo_atencion'] ?? '';
$id_derivacion = $_POST['id_derivacion'] ?? '';
$nueva_derivacion = $_POST['nueva_derivacion'] ?? '';
$comentarios = $_POST['comentarios'];
$fecha_registro = $_POST['fecha_registro'] ?? date("Y-m-d"); 
$usuario = $_POST['usuario'] ?? '';
$id_profesion = $_POST['id_profesion'] ?? '';

if (empty($fecha_registro)) {
    $_SESSION['error'] = "La fecha de registro es obligatoria";
    header("Location: nueva_prestacion.php");
    exit;
}
    
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

$sql = "INSERT INTO evaluaciones ( rut, nombre, apellido, id_tipo_atencion, derivacion, comentarios, fecha_registro, usuario, id_profesion) 
        VALUES ( '$rut', '$nombre', '$apellido', '$id_tipo_atencion', '$id_derivacion', '$comentarios', '$fecha_registro', '$usuario', '$id_profesion')";

$query = mysqli_query($con, $sql);

if($query) {
    header("Location: prestaciones.php");
    exit(); 
} else {
    
    echo "Error en la base de datos: " . mysqli_error($con);
}
?>