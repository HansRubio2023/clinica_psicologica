<?php 
header('Content-type:application/xls; charset=UTF-8');
header('Content-Disposition: attachment; filename=pacientes.xls');


require_once('conexion/conexion.php');
$con = connection();
mysqli_set_charset($con,'utf8');
mysqli_query($con, "SET NAMES 'utf8'");

$query= "SELECT * FROM pacientes";
$result=mysqli_query($con,$query);

echo"\xEF\xBB\xBF";
?>

<table>
    <tr>
        <th>Rut</th>
        <th>Nombres</th>
        <th>Apellidos</th>
    </tr>
    <?php 
    while ($row=mysqli_fetch_assoc($result)){?>
     
    
    <tr>
        <td><?php echo $row['rut']; ?></td>
        <td><?php echo $row['nombres']; ?></td>
        <td><?php echo $row['apellidos']; ?></td>
    </tr>
    <?php } ?>
</table>