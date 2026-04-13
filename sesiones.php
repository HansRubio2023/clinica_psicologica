<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

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

$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
    <link rel="stylesheet" href="css/pacientes.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* CSS necesario para el buscador */
        .search-section {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            background: rgba(255,255,255,0.9);
        }
        #buscador:focus {
            box-shadow: 0 0 0 0.25rem rgba(0,123,255,0.25);
            border-color: #007bff;
        }
        .paciente-row {
            transition: all 0.3s ease;
        }
        .paciente-row:hover {
            background-color: #f8f9fd;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
            <i class="fas fa-home btn-icon"></i> Inicio
        </a>
        <a id="cerrar_sesion" href="index.php" class="btn btn-logout menu-btn">
            <i class="fas fa-sign-out-alt btn-icon"></i> Cerrar Sesión
        </a>
    </div>    
    
    <div class="menu-card mx-auto" style="max-width: 1400px;">
        <h1 class="menu-title text-center mb-4">Sesiones12</h1>   
        
        <!-- BUSCADOR -->
        <div class="search-section mb-4 p-4 mx-3">
            <div class="row align-items-center g-3">
                <div class="col-md-8">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text" 
                        class="form-control border-start-0 ps-0 shadow-none" 
                        id="buscador" 
                        placeholder="Buscador de sesiones..."
                        autocomplete="off">
                        <button class="btn btn-outline-danger" type="button" id="btn-limpiar" style="display: none;">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="../clinica_psicologica/nueva_sesion.php" class="btn btn-success btn-lg">
                        <i class="fas fa-plus"></i> Nueva Sesión
                    </a>
                </div>
            </div>
        </div>
        
        <!-- TABLA -->
        <div class="card-body p-4">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Número sesión</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha sesión</th>
                    <th>Comentarios</th>
                    <th>Asiste</th>
                    <th>Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($query)): ?>
                <tr class="sesiones-row">
                <td><?=$row['numero_sesion']?></td>
                <td><?=$row['rut']?></td>
                <td><?=$row['nombres']?></td>
                <td><?=$row['apellidos']?></td>
                <td><?=$row['fecha_sesion']?></td>
                <td><?=$row['comentarios']?></td>                
                <td>
                    <?php if($row['asiste'] == '1'): ?>
                        <span class="badge bg-success">Sí</span>
                    <?php else: ?>
                        <span class="badge bg-danger">No</span>
                    <?php endif; ?>
                </td>
                <td><?=$row['usuario']?></td>

                <td>
                    <a href="editar_sesion.php?id_sesion=<?= $row['id_sesion']?>" 
                    class="btn btn-warning btn-sm me-1">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-danger btn-sm me-1" href="eliminar_sesion.php?id_sesion=<?= $row['id_sesion']?>" 
                    onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                        <i class="fas fa-trash"></i>
                    </a>                        
                </td>
            </tr> 
            <?php endwhile; ?> 
        </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const buscador = document.getElementById('buscador');
    const btnLimpiar = document.getElementById('btn-limpiar');

    function buscarAutomatico() {
        const termino = buscador.value.trim().toLowerCase();
        // Buscamos las filas justo en el momento de escribir
        const filas = document.querySelectorAll('.sesiones-row');
        
        filas.forEach(fila => {
            // Obtenemos todo el texto de la fila (RUT, Nombre, Apellido, etc.)
            const textoFila = fila.innerText.toLowerCase();
            
            if (termino === '' || textoFila.includes(termino)) {
                fila.style.setProperty('display', '', 'important'); 
            } else {
                fila.style.setProperty('display', 'none', 'important');
            }
        });
        
        // Mostrar/ocultar botón limpiar
        if(btnLimpiar) {
            btnLimpiar.style.display = termino ? 'block' : 'none';
        }
    }

        // BÚSQUEDA EN TIEMPO REAL
        if (buscador) {
            buscador.addEventListener('input', buscarAutomatico);
        }

        // BOTÓN LIMPIAR
        if (btnLimpiar) {
            btnLimpiar.addEventListener('click', function() {
                buscador.value = '';
                buscarAutomatico();
                buscador.focus();
            });
        }
    });
    </script>
</body>
</html>