<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
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
        <h1 class="menu-title text-center mb-4">Pacientes</h1>   
        
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
                               placeholder="Buscar por RUT, nombre, correo..."
                               autocomplete="off">
                        <button class="btn btn-outline-danger" type="button" id="btn-limpiar" style="display: none;">
                            <i class="fas fa-times"></i> Limpiar
                        </button>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <a href="nuevo_paciente.php" class="btn btn-success btn-lg">
                        <i class="fas fa-plus"></i> Nuevo Paciente
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
                            <th>Cantidad</th>
                            <th>RUT</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Celular</th>
                            <th>Comentarios</th>
                            <th>Fecha Registro</th>
                            <th>Usuario Registro</th>
                            <th>Tipo Estado</th>
                            <th>Rango</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="paciente-row">
                            <td>1</td>
                            <td>12.345.678-9</td>
                            <td>Alonso Ignacio</td>
                            <td>Pérez Díaz</td>
                            <td>alonso@gmail.com</td>
                            <td>912345678</td>
                            <td>Paciente en buen estado</td>
                            <td>14-03-2026</td>
                            <td>admin</td>
                            <td>Alta Terapéutica</td>
                            <td>Niño</td>
                            <td>
                                <a href="editar_paciente.php?id=1" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm eliminar-btn me-1" 
                                   data-id="1" data-nombre="Alonso Ignacio Pérez Díaz">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="paciente-row">
                            <td>2</td>
                            <td>16.345.678-9</td>
                            <td>Hans Ignacio</td>
                            <td>Pérez Díaz</td>
                            <td>hans@gmail.com</td>
                            <td>923456789</td>
                            <td>Control post operatorio</td>
                            <td>15-03-2026</td>
                            <td>doctor1</td>
                            <td>En observación</td>
                            <td>Adulto</td>
                            <td>
                                <a href="editar_paciente.php?id=2" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm eliminar-btn me-1" 
                                   data-id="2" data-nombre="Hans Ignacio Pérez Díaz">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="paciente-row">
                            <td>2</td>
                            <td>16.345.678-9</td>
                            <td>Hans Ignacio</td>
                            <td>Pérez Díaz</td>
                            <td>hans@gmail.com</td>
                            <td>923456789</td>
                            <td>Control post operatorio</td>
                            <td>15-03-2026</td>
                            <td>doctor1</td>
                            <td>En observación</td>
                            <td>Adulto</td>
                            <td>
                                <a href="editar_paciente.php?id=2" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm eliminar-btn me-1" 
                                   data-id="2" data-nombre="Hans Ignacio Pérez Díaz">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <tr class="paciente-row">
                            <td>2</td>
                            <td>16.345.678-9</td>
                            <td>Hans Ignacio</td>
                            <td>Pérez Díaz</td>
                            <td>hans@gmail.com</td>
                            <td>923456789</td>
                            <td>Control post operatorio</td>
                            <td>15-03-2026</td>
                            <td>doctor1</td>
                            <td>En observación</td>
                            <td>Adulto</td>
                            <td>
                                <a href="editar_paciente.php?id=2" class="btn btn-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm eliminar-btn me-1" 
                                   data-id="2" data-nombre="Hans Ignacio Pérez Díaz">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ===== BUSCADOR AUTOMÁTICO =====
        const buscador = document.getElementById('buscador');
        const btnLimpiar = document.getElementById('btn-limpiar');
        const filas = document.querySelectorAll('.paciente-row');
        
        function buscarAutomatico() {
            const termino = buscador.value.trim().toLowerCase();
            
            filas.forEach(fila => {
                const textoFila = fila.textContent.toLowerCase();
                if (termino === '' || textoFila.includes(termino)) {
                    fila.style.display = ''; // Mostrar
                } else {
                    fila.style.display = 'none'; // Ocultar
                }
            });
            
            // Mostrar/ocultar botón limpiar
            btnLimpiar.style.display = termino ? 'block' : 'none';
        }
        
        // BÚSQUEDA EN TIEMPO REAL
        let timeout;
        buscador.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(buscarAutomatico, 200); // 200ms debounce
        });
        
        // Botón limpiar
        btnLimpiar.addEventListener('click', function() {
            buscador.value = '';
            buscarAutomatico();
            buscador.focus();
        });
        
        // ELIMINAR 
        document.querySelectorAll('.eliminar-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const nombre = this.dataset.nombre;
                if (confirm(`¿Eliminar a "${nombre}"?`)) {
                    // Aquí tu lógica de eliminación
                    alert('Paciente eliminado (simulación)');
                }
            });
        });
    });
    </script>
</body>
</html>