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
                        <p class="text-muted">hans</p>
                    </div>

                    <!-- FORMULARIO -->
                    <form method="POST" id="formPaciente">
                        <div class="row">
                            <!-- ID Paciente (oculto) -->
                            <input type="hidden" name="id_paciente" value="<?php echo isset($_POST['id_paciente']) ? $_POST['id_paciente'] : ''; ?>">   
                            
                            <!-- RUT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> RUT *
                                </label>
                                <input type="text" class="form-control" name="rut" 
                                       value="<?php echo isset($_POST['rut']) ? $_POST['rut'] : ''; ?>"
                                       placeholder="12345678-7" maxlength="20" required>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user text-primary"></i> Nombres *
                                </label>
                                <input type="text" class="form-control" name="nombre" 
                                       value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>"
                                       placeholder="Juan" maxlength="50" required>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user-tag text-primary"></i> Apellidos *
                                </label>
                                <input type="text" class="form-control" name="apellido" 
                                       value="<?php echo isset($_POST['apellido']) ? $_POST['apellido'] : ''; ?>"
                                       placeholder="Pérez" maxlength="50" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-phone text-primary"></i> Teléfono
                                </label>
                                <input type="tel" class="form-control" name="telefono" 
                                       value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>"
                                       placeholder="987654321" maxlength="15">
                            </div>

                            <!-- Email -->
                            <div class="col-12 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-envelope text-primary"></i> Email
                                </label>
                                <input type="email" class="form-control" name="email" 
                                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>"
                                       placeholder="paciente@email.com">
                            </div>

                            <!-- Fecha Registro -->
                            <div class="col-12 mb-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Fecha de Registro
                                </label>
                                <input type="date" class="form-control" name="fecha_registro" 
                                       value="<?php echo isset($_POST['fecha_registro']) ? $_POST['fecha_registro'] : ''; ?>">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="textarea-label">
                                <i class="fas fa-file-medical text-primary"></i> Comentarios</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            value="<?php echo isset($_POST['comentario']) ? $_POST['comentario'] : ''; ?>"
                            maxlength="1000"    ></textarea>
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
                                <input type="text" class="form-control" name="usuario" 
                                       value="<?php echo isset($_POST['usuario']) ? $_POST['usuario'] : ''; ?>"
                                       placeholder="juanperez" maxlength="50">
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