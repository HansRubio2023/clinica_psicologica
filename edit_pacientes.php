<?php
session_start();

include("conexion/conexion.php");
$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$id_paciente = $_POST['id_paciente'];
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

if (empty($fecha_registro)) {
    $_SESSION['error'] = "No puedes dejar la fecha vacía";
    header("Location: editar_paciente.php?id_paciente=" . $id_paciente);
    exit();
}

// Obtenemos el RUT actual del paciente
$sql_rut_actual = "SELECT rut FROM pacientes WHERE id_paciente='$id_paciente'";
$res_rut = mysqli_query($con, $sql_rut_actual);
$row_rut = mysqli_fetch_assoc($res_rut);
$rut_actual = $row_rut['rut'];

// Si el RUT cambió, verificamos si tiene sesiones asociadas
if ($rut !== $rut_actual) {
    $sql_sesiones = "SELECT COUNT(*) as total FROM sesiones WHERE rut='$rut_actual'";
    $res_sesiones = mysqli_query($con, $sql_sesiones);
    $row_sesiones = mysqli_fetch_assoc($res_sesiones);
    if ($row_sesiones['total'] > 0) {
        $_SESSION['error'] = "No se puede modificar el RUT del paciente porque tiene sesiones asociadas.";
        header("Location: editar_paciente.php?id_paciente=" . $id_paciente);
        exit();
    }
}

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
    header("Location: pacientes.php");
    exit();
} else {
    echo "Error de SQL: " . mysqli_error($con);
}
?>
