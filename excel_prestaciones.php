<?php 
header('Content-type:application/xls; charset=UTF-8');
header('Content-Disposition: attachment; filename=prestaciones.xls');


require_once('conexion/conexion.php');
$con = connection();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
mysqli_set_charset($con,'utf8');
mysqli_query($con, "SET NAMES 'utf8'");

$sql = "SELECT 
            p.id_evaluacion, 
            p.rut, 
            p.nombre,
            p.apellido,
            p.derivacion, 
            p.comentarios, 
            p.fecha_registro, 
            p.usuario,
            r.nombre_tipo_atencion AS tipo_atencion, 
            z.Profesion AS tipo_profesion
        FROM evaluaciones p
        LEFT JOIN pacientes e ON p.rut = e.rut
        LEFT JOIN tipo_atencion r ON p.id_tipo_atencion = r.id_atencion 
        LEFT JOIN tipo_profesion z ON p.id_profesion = z.id_profesion
        ORDER BY p.id_evaluacion DESC";

$result=mysqli_query($con,$sql);

echo "\xEF\xBB\xBF";

?>

<table>
    <tr>
        <th>Rut</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Tipo Atencion</th>
        <th>Derivación</th>
        <th>Comentarios</th>
        <th>Fecha Registro</th>
        <th>Profesión</th>
        <th>Usuario Registro</th>
    </tr>
    <?php 
    while ($row=mysqli_fetch_assoc($result)){?>
     
    
    <tr>
         <td><?=$row['rut']?></td>
                        <td><?=$row['nombre']?></td>
                        <td><?=$row['apellido']?></td>
                        <td><?=$row['tipo_atencion']?></td>
                        <td><?=$row['derivacion']?></td>
                        <td><?=$row['comentarios']?></td>
                        <td><?=$row['fecha_registro']?></td>
                        <td><?=$row['tipo_profesion']?></td>
                        <td><?=$row['usuario']?></td>
                   

    </tr>
    <?php } ?>