<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

// Verificamos si la petición es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recolectamos datos (el id_sesion suele ser auto_increment, por lo que podríamos omitirlo)
    $rut = $_POST['rut'] ?? '';
    $numero_sesion = $_POST['numero_sesion'] ?? '';
    $fecha_sesion = !empty($_POST['fecha_sesion']) ? $_POST['fecha_sesion'] : date("Y-m-d"); 
    $comentarios = $_POST['comentarios'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $asiste = $_POST['asiste'] ?? '';

    // Validamos que el RUT no venga vacío antes de hacer la consulta
    if(empty($rut)){
        die("Error: El campo RUT es obligatorio y no puede estar vacío.");
    }

    // Usamos sentencias preparadas (?) para evitar Inyección SQL
    $sql = "INSERT INTO sesiones (rut, numero_sesion, fecha_sesion, comentarios, usuario, asiste) 
            VALUES (?, ?, ?, ?, ?, ?)";
            
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        // Vinculamos los parámetros: 'sissss' significa String, Integer, String, String, String, String
        mysqli_stmt_bind_param($stmt, "sissss", $rut, $numero_sesion, $fecha_sesion, $comentarios, $usuario, $asiste);
        
        // Ejecutamos la consulta
        if(mysqli_stmt_execute($stmt)) {
            header("Location: sesiones.php");
            exit(); 
        } else {
            // Si falla al ejecutar, mostramos el error (probablemente aquí vuelva a salir el de la Foreign Key si el RUT es inválido)
            echo "Error al guardar la sesión: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error en la preparación de la consulta: " . mysqli_error($con);
    }
}
?>