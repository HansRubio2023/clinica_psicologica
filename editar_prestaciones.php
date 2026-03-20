<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

if (isset($_GET['id_evaluacion'])) {
    $id_evaluacion = $_GET['id_evaluacion'];
    
    $sql = "SELECT * FROM evaluaciones WHERE id_evaluacion = '$id_evaluacion'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    
    // Si el paciente no existe, podrías redirigir
    if (!$row) {
        header("Location: prestaciones.php");
    }
} else {
    // Si se intenta entrar sin ID, redirigimos a la lista
    header("Location: prestaciones.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestaciones</title>
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
                            <i class="fas fa-user-edit"></i> Editar Prestación
                        </h2>
                        <p class="text-muted">Complete todos los campos requeridos *</p>
                    </div>

                    <!-- FORMULARIO -->
                    <form action="edit_prestaciones.php" method="POST" id="formPrestacion">
                        <div class="row">
                            <!-- RUT -->
                            <input type="hidden" name="id_evaluacion" value="<?= $row['id_evaluacion'] ?>">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> RUT *
                                </label>
                                <input type="text" class="form-control" name="rut" value="<?= $row['rut'] ?>" required>
                            </div>
                            
                            <!-- Rango Etario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-users text-primary"></i> Tipo Atención 
                                </label>
                                <select class="form-select" name="id_tipo_atencion">
                                    <option value="">Seleccione un rango etario</option>
                                    <option value="1" <?php echo ($row['id_tipo_atencion'] == '1') ? 'selected' : ''; ?>>Terapia individual</option>
                                    <option value="2" <?php echo ($row['id_tipo_atencion'] == '2') ? 'selected' : ''; ?>>Acompañamiento terapéutico</option>
                                </select>
                            </div>

                            <!-- Derivación -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user text-primary"></i> Derivación
                                </label>
                                <input type="text" class="form-control" name="derivacion" 
                                value="<?= $row['derivacion'] ?>" required>
                            </div>
                            
                            <!--Comentarios -->
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
    

                            <!-- Fecha Registro -->
                            <div class="col-12 mb-4">
                                    <label class="form-label">
                                        <i class="fas fa-calendar-alt text-primary"></i> Fecha de Registro
                                    </label>
                                    <input type="date" class="form-control" name="fecha_registro" value="<?= $row['fecha_registro'] ?>">
                                </div>
                            </div>

                            
                        <!-- Usuario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-tag text-primary"></i> Usuario
                                </label>
                                <input type="text" class="form-control" name="usuario" value="<?= $row['usuario'] ?>">
                            </div>
                        
                        <!-- Estado -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-toggle-on text-primary"></i> Profesión
                                </label>
                                <select class="form-select" name="id_profesion">
                                    <option value="1" <?php echo ($row['id_profesion'] == '1') ? 'selected' : ''; ?>>Pre-Práctica</option>
                                    <option value="2" <?php echo ($row['id_profesion'] == '2') ? 'selected' : ''; ?>>Práctica</option>
                                </select>
                            </div> 

                    


                        <!-- BOTONES -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-save"></i> Editar Paciente
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg px-4" onclick="window.location.href='prestaciones.php'">
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