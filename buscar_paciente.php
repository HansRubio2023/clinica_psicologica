<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (isset($_POST['rut'])) {
    $rut = mysqli_real_escape_string($con, $_POST['rut']);
    
    // Ajusta 'pacientes' al nombre real de tu tabla de personas
    $sql = "SELECT nombres, apellidos FROM pacientes WHERE rut = '$rut' LIMIT 1";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    } else {
        echo json_encode(null);
    }
}
?>



