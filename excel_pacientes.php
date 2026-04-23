<?php 
header('Content-type:application/xls; charset=UTF-8');
header('Content-Disposition: attachment; filename=pacientes.xls');


require_once('conexion/conexion.php');
$con = connection();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
mysqli_set_charset($con,'utf8');
mysqli_query($con, "SET NAMES 'utf8'");


$sql = "SELECT p.*, e.tipo_estado AS nombre_estado, 
        r.nombre_rango_etareo AS nombre_rango 
        FROM pacientes p
        INNER JOIN tipo_estado e ON p.id_estado = e.id_estado
        INNER JOIN tipo_rango_etareo r ON p.id_rango_etareo = r.id_rango_etareo 
        order by p.id_paciente DESC";


$result=mysqli_query($con,$sql);

echo "\xEF\xBB\xBF";

?>


<table>
    <tr>
        <th>Rut</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
        <th>Celular</th>
        <th>Comentarios</th>
        <th>Fecha Registro</th>
        <th>Estado</th>
        <th>Rango de edad</th>
        <th>Usuario Registro</th>
    </tr>
    <?php 
    while ($row=mysqli_fetch_assoc($result)){?>
     
    
    <tr>
         <td><?=$row['rut']?></td>
                      <td><?=$row['nombres']?></td>
                      <td><?=$row['apellidos']?></td>
                      <td><?=$row['email']?></td>
                      <td><?=$row['celular']?></td>
                      <td><?=$row['comentarios']?></td>
                      <td><?=$row['fecha_registro']?></td>
                      <td><?=$row['nombre_estado']?></td>
                      <td><?=$row['nombre_rango']?></td>
                      <td><?=$row['usuario']?></td>

    </tr>
    <?php } ?>
</table>