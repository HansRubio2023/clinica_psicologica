<?php
session_start();
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

// Cambiamos INNER JOIN por LEFT JOIN para asegurar que se muestren los datos
$sql = "SELECT 
            p.id_evaluacion, 
            p.rut, 
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

$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestaciones</title>
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
        <a id="cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
            <i class="fas fa-sign-out-alt btn-icon"></i> Cerrar Sesión
        </a>
    </div>    
    
    <div class="menu-card mx-auto" style="max-width: 1400px;">
        <h1 class="menu-title text-center mb-4">Prestaciones</h1>   
        
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
                        placeholder="Buscador de prestaciones..."
                        autocomplete="off">
                        <button class="btn btn-outline-danger" type="button" id="btn-limpiar" style="display: none;">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="../clinica_psicologica/nueva_prestacion.php" class="btn btn-success btn-lg"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                        <i class="fas fa-plus"></i> Nueva Prestación
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
                    <th>Rut</th>
                    <th>Tipo Atención</th>
                    <th>Derivación</th>
                    <th>Comentarios</th>
                    <th>Fecha Registro</th>
                    <th>Profesión</th>
                    <th>Usuario Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($query)): ?>
                <tr class="paciente-row">
                    <td><?=$row['rut']?></td>
                    <td><?=$row['tipo_atencion']?></td>
                    <td><?=$row['derivacion']?></td>
                    <td><?=$row['comentarios']?></td>
                    <td><?=$row['fecha_registro']?></td>
                    <td><?=$row['tipo_profesion']?></td>
                    <td><?=$row['usuario']?></td>
                    <td>
                        <a href="editar_prestaciones.php?id_evaluacion=<?= $row['id_evaluacion']?>" 
                        class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm me-1" href="eliminar_prestaciones.php?id_evaluacion=<?= $row['id_evaluacion']?>" 
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
        const filas = document.querySelectorAll('.paciente-row');
        
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