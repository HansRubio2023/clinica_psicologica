<?php
// Incluye tu conexión (asegúrate de que el nombre sea correcto)
include("../clinica_psicologica/conexion/conexion.php"); 
$con = connection();

if (isset($_GET['id_sesion'])) {
    $id = $_GET['id_sesion'];

    // Usamos una sentencia preparada para proteger la base de datos
    $sql = "DELETE FROM sesiones WHERE id_sesion = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    mysqli_stmt_bind_param($stmt, "i", $id); // "i" significa que el ID es un entero (integer)

    if (mysqli_stmt_execute($stmt)) {
    header("Location: sesiones.php"); 
    exit();
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($con);
    }
}
?>