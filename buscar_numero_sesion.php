<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (isset($_POST['rut'])) {
    $rut = mysqli_real_escape_string($con, $_POST['rut']);
    
    // Buscar el número de sesión más alto registrado para este RUT
    $sql = "SELECT MAX(numero_sesion) as ultima_sesion FROM sesiones WHERE rut = '$rut'";
    $result = mysqli_query($con, $sql);
    
    $siguiente_sesion = 1; // Por defecto, si no hay registros, será la sesión 1
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['ultima_sesion'] != null) {
            $siguiente_sesion = $row['ultima_sesion'] + 1; // Sumamos 1 a la última sesión
        }
    }
    
    // Devolvemos el resultado en formato JSON
    echo json_encode(['siguiente_sesion' => $siguiente_sesion]);
}
?>