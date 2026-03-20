<?php
include("../clinica_psicologica/conexion/conexion.php");
$con = connection();

// Verificamos si viene el ID por la URL
if (isset($_GET['id_paciente'])) {
    $id_paciente = $_GET['id_paciente'];
    
    // Consultamos los datos de este paciente específico
    $sql = "SELECT * FROM pacientes WHERE id_paciente = '$id_paciente'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    
    // Si el paciente no existe, podrías redirigir
    if (!$row) {
        header("Location: pacientes.php");
    }
} else {
    // Si se intenta entrar sin ID, redirigimos a la lista
    header("Location: pacientes.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
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
                    <!-- Mensaje -->

                    <!-- Título -->
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-primary mb-2">
                            <i class="fas fa-user-edit"></i> Editar Paciente
                        </h2>
                        <p class="text-muted">Complete todos los campos requeridos</p>
                    </div>

                    <!-- FORMULARIO -->
                    <form action="edit_pacientes.php" method="POST" id="formPaciente">
                        <div class="row">
                            <!-- RUT -->
                            <input type="hidden" name="id_paciente" value="<?= $row['id_paciente'] ?>">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> RUT *
                                </label>
                                <input type="text" class="form-control" name="rut" value="<?= $row['rut'] ?>" required>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user text-primary"></i> Nombres *
                                </label>
                                <input type="text" class="form-control" name="nombres" 
                                value="<?= $row['nombres'] ?>" required>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user-tag text-primary"></i> Apellidos *
                                </label>
                                <input type="text" class="form-control" name="apellidos" value="<?= $row['apellidos'] ?>" required>
                            </div>

                            <!-- Celular -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-phone text-primary"></i> Celular
                                </label>
                                <input type="text" class="form-control" name="celular" value="<?= $row['celular'] ?>">
                            </div>

                            <!-- Email -->
                            <div class="col-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-envelope text-primary"></i> Email
                                </label>
                                <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>">
                            </div>

                            <!-- Fecha Registro -->
                            <div class="col-12 mb-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Fecha de Registro
                                </label>
                                <input type="date" class="form-control" name="fecha_registro" value="<?= $row['fecha_registro'] ?>">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="textarea-label">
                                <i class="fas fa-file-medical text-primary"></i> Comentarios</label>
                            <textarea class="form-control" name="comentarios" rows="3" maxlength="1000"><?= $row['comentarios'] ?></textarea>
                            <div class="textarea-counter">
                                <span id="contador2">0</span>/1000 caracteres
                            </div>
                        </div>  
                        <!-- Rango Etario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-users text-primary"></i> Rango Etario  
                                </label>
                                <select class="form-select" name="id_rango_etareo">
                                    <option value="">Seleccione un rango etario</option>
                                    <option value="1" <?php echo ($row['id_rango_etareo'] == '1') ? 'selected' : ''; ?>>Niño</option>
                                    <option value="2" <?php echo ($row['id_rango_etareo'] == '2') ? 'selected' : ''; ?>>Adulto</option>
                                    <option value="3" <?php echo ($row['id_rango_etareo'] == '3') ? 'selected' : ''; ?>>Adolescente</option>
                                </select>
                            </div>
    
                        <!-- Estado -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-toggle-on text-primary"></i> Estado
                                </label>
                                <select class="form-select" name="id_estado">
                                    <option value="1" <?php echo ($row['id_estado'] == '1') ? 'selected' : ''; ?>>En curso</option>
                                    <option value="2" <?php echo ($row['id_estado'] == '2') ? 'selected' : ''; ?>>Derivado</option>
                                    <option value="3" <?php echo ($row['id_estado'] == '3') ? 'selected' : ''; ?>>Deserción</option>
                                    <option value="4" <?php echo ($row['id_estado'] == '4') ? 'selected' : ''; ?>>Alta Terapéutica</option>
                                    <option value="5" <?php echo ($row['id_estado'] == '5') ? 'selected' : ''; ?>>Alta por deserción</option>
                                    <option value="6" <?php echo ($row['id_estado'] == '6') ? 'selected' : ''; ?>>Alta administrativa</option>
                                </select>
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
                                <input type="text" class="form-control" name="usuario" value="<?= $row['usuario'] ?>">
                            </div>

                        <!-- BOTONES -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button type="submit" class="btn btn-success btn-lg px-4">
                                <i class="fas fa-save"></i> Editar Paciente
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg px-4" onclick="window.location.href='pacientes.php'">
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