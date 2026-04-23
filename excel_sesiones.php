<?php 
header('Content-type:application/xls; charset=UTF-8');
header('Content-Disposition: attachment; filename=sesiones.xls');


require_once('conexion/conexion.php');
$con = connection();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
mysqli_set_charset($con,'utf8');
mysqli_query($con, "SET NAMES 'utf8'");

$sql = "SELECT 
    s.id_sesion,
    s.rut,
    p.nombres,
    p.apellidos,
    s.numero_sesion,
    s.fecha_sesion,
    s.comentarios,
    s.usuario,
    s.asiste
    FROM 
        sesiones s
    INNER JOIN 
        pacientes p ON s.rut = p.rut
        ORDER BY s.id_sesion DESC";


$result=mysqli_query($con,$sql);

echo "\xEF\xBB\xBF";

?>


<table>
    <tr>
        <th>Numero sesión</th>
        <th>Rut</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Fecha sesión</th>
        <th>Comentarios</th>
        <th>Asiste</th>
        <th>Usuario</th>
        
    </tr>
    <?php 
    while ($row=mysqli_fetch_assoc($result)){?>
     
    
    <tr>
            <td><?=$row['numero_sesion']?></td>
         <td><?=$row['rut']?></td>
                      <td><?=$row['nombres']?></td>
                      <td><?=$row['apellidos']?></td>
                      <td><?=$row['fecha_sesion']?></td>
                      <td><?=$row['comentarios']?></td>
                      <td><?=$row['asiste']?></td>
                      <td><?=$row['usuario']?></td>

    </tr>
    <?php } ?>
</table>