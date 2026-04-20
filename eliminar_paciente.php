<?php
// Incluye tu conexión (asegúrate de que el nombre sea correcto)

include("../clinica_psicologica/conexion/conexion.php"); 
$con = connection();

if (isset($_GET['id_paciente'])) {
    $id = $_GET['id_paciente'];

    $verificador = mysqli_query($con, "SELECT COUNT(*) as total FROM sesiones WHERE rut =(SELECT rut FROM pacientes WHERE id_paciente ='$id')");
    $resultado = mysqli_fetch_assoc($verificador);

    if($resultado['total']> 0){
        header("location: pacientes.php?error=tiene_sesiones");

    }

    // Usamos una sentencia preparada para proteger la base de datos
    $sql = "DELETE FROM pacientes WHERE id_paciente = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    mysqli_stmt_bind_param($stmt, "i", $id); // "i" significa que el ID es un entero (integer)

    if (mysqli_stmt_execute($stmt)) {
    // Cambia index.php por el nombre real de tu archivo de lista
    header("Location: pacientes.php"); 
    exit(); // Siempre añade exit después de un header
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($con);
    }
}
?>