<?php
header('Content-Type: application/json');


ini_set('display_errors', 1);
error_reporting(E_ALL);


$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "clinica_psicologica";

try {
 
    $conn = new mysqli($servername, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        throw new Exception("Conexión fallida: " . $conn->connect_error);
    }

   
    $username = $_POST['user'];
    $password = $_POST['pass'];

   
    $stmt = $conn->prepare("SELECT p.contrasena_usuario, p.id_perfil 
                            FROM perfiles p 
                            WHERE p.nombre_usuario = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contrasena_usuario'])) {
            switch ($row['id_perfil']) {
                case 1:
                    $role = 'cliente';
                    break;
                case 2:
                    $role = 'empleado';
                    break;
                case 3:
                    $role = 'admin';
                    break;
                default:
                    $role = 'desconocido';
            }
            echo json_encode(["success" => true, "role" => $role]);
        } else {
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
    }

    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error en el servidor: " . $e->getMessage()]);
}
?>