<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (isset($_GET['id_sesion'])) {
    $id_sesion = $_GET['id_sesion'];
    
    $sql = "SELECT * FROM sesiones WHERE id_sesion = '$id_sesion'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    
    // Si el paciente no existe, podrías redirigir
    if (!$row) {
        header("Location: sesiones.php");
    }
} else {
    // Si se intenta entrar sin ID, redirigimos a la lista
    header("Location: sesiones.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesiones</title>
    <link rel="stylesheet" href="css/nuevo_pacientes.css">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="menu-container">
            <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
                <i class="fas fa-home btn-icon"></i>
                Inicio
            </a>
                        
            <a id= "cerrar_sesion" href="index.php" class="btn btn-logout menu-btn">
                <i class="fas fa-sign-out-alt btn-icon"></i>
                Cerrar Sesión
            </a>
    </div>    
        <div class="menu-card">
            <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary mb-2">
                            <i class="fas fa-user-plus"></i> Editar Sesión
                        </h2>
                        <p class="text-muted">Complete todos los campos requeridos *</p>
                    </div>
                    <!-- FORMULARIO -->
                    <form action="edit_sesion.php" method="POST" id="formSesion">
                        <div class="row">
                            <!-- ID Sesión (oculto) -->
                            <input type="hidden" name="id_sesion" value="<?= $row['id_sesion'] ?>"> 

                            <!-- RUT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> RUT *
                                </label>
                                <input type="text" class="form-control" name="rut" value="<?= $row['rut'] ?>" required>
                            </div>
                        </div>
                            <!-- Num Sesión -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> Número de Sesión *
                                </label>
                                <input type="number" class="form-control" id="numero_sesion" name="numero_sesion" 
                                       min="1"  value="<?= $row['numero_sesion'] ?>" required>
                            </div>

                            <!-- Fecha Sesión -->
                            <div class="col-12 mb-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Fecha de Sesión
                                </label>
                                <input type="date" class="form-control" name="fecha_sesion" value="<?= $row['fecha_sesion'] ?>">
                            </div>
                        

                        <!-- Comentarios -->
                        <div class="mb-3">
                            <label class="textarea-label">
                                <i class="fas fa-file-medical text-primary"></i> Comentarios</label>
                            <textarea class="form-control" name="comentarios" rows="3" maxlength="1000"><?= $row['comentarios'] ?></textarea>
                            <div class="textarea-counter">
                                <span id="contador2">0</span>/1000 caracteres
                            </div>
                        </div>  
                        <script>
                            // Contador de caracteres
                            document.querySelectorAll('textarea').forEach(textarea => {
                                const contador = textarea.parentElement.querySelector('.textarea-counter span');
                                const max = textarea.maxLength;
                                
                                textarea.addEventListener('input', function() {
                                    let len = this.value.length;
                                    contador.textContent = len;
                                    
                                    if (len > max * 0.9) {
                                        contador.parentElement.style.color = '#dc3545';
                                    } else {
                                        contador.parentElement.style.color = '#6c757d';
                                    }
                                });
                            });
                        </script>

                        <!-- Usuario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-tag text-primary"></i> Usuario
                                </label>
                                <input type="text" class="form-control" name="usuario" value="<?= $row['usuario'] ?>"  maxlength="50">
                            </div>
                        <!--Crear una lista desplegable para el campo "Asiste" con opciones "Sí" y "No"-->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-check text-primary"></i> Asiste    
                            </label>
                            <select class="form-select" name="asiste">
                                    <option value="1" <?php echo ($row['asiste'] == '1') ? 'selected' : ''; ?>>Sí</option>
                                    <option value="2" <?php echo ($row['asiste'] == '2') ? 'selected' : ''; ?>>No</option>
                                </select>
                        </div>

                        <!-- BOTONES -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-save"></i> Guardar Paciente
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg px-4" onclick="window.location.href='sesiones.php'">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
        


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>