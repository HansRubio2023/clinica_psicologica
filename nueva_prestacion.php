<?php
include("../clinica_psicologica/conexion/conexion.php");

$con = connection();

$sql = "SELECT * FROM evaluaciones";
$query = mysqli_query($con, $sql);
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
    <form action="insert_prestacion.php" method="POST">
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
                            <i class="fas fa-plus"></i> Nueva Prestación
                        </h2>
                        <p class="text-muted">Complete todos los campos requeridos *</p>
                    </div>
                    <!-- FORMULARIO -->
                    <form method="POST" id="formPrestacion">
                        
                            <!-- ID Prestacion (oculto) -->
                            <input type="hidden" name="id_evaluacion" value="<?php echo isset($_POST['id_evaluacion']) ? $_POST['id_evaluacion'] : ''; ?>">   
                            
                            <!-- RUT -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> RUT *
                                </label>
                                <input type="text" class="form-control" id="rut" name="rut" 
                                    value="<?php echo isset($_POST['rut']) ? $_POST['rut'] : ''; ?>"
                                    placeholder="12.345.678-7" maxlength="12" required>
                                <div id="rut-error" class="invalid-feedback">RUT inválido.</div>
                            </div>
                            <script>
                                document.getElementById('rut').addEventListener('input', function(e) {
                                let value = e.target.value.replace(/\./g, '').replace('-', '');
                                
                                if (value.match(/^(\d{2})(\d{3}){2}(\w{1})$/)) {
                                    value = value.replace(/^(\d+)(\d{3})(\d{3})(\w{1})$/, '$1.$2.$3-$4');
                                }
                                e.target.value = value;

                                if (fnValidarRut(value)) {
                                    e.target.setCustomValidity("");
                                    e.target.classList.remove('is-invalid');
                                    e.target.classList.add('is-valid');
                                } else {
                                    e.target.setCustomValidity("RUT Inválido");
                                    e.target.classList.add('is-invalid');
                                    e.target.classList.remove('is-valid');
                                }
                            });

                                function fnValidarRut(rutCompleto) {
                                    if (!/^[0-9]+[-|‐][0-9kK]{1}$/.test(rutCompleto.replace(/\./g, ''))) return false;
                                    
                                    let tmp = rutCompleto.split('-');
                                    let digv = tmp[1]; 
                                    let rut = tmp[0].replace(/\./g, '');
                                    if (digv == 'K') digv = 'k';
                                    
                                    return (fnDv(rut) == digv);
                                }

                                function fnDv(T) {
                                    let M = 0, S = 1;
                                    for (; T; T = Math.floor(T / 10)) {
                                        S = (S + T % 10 * (9 - M++ % 6)) % 11;
                                    }
                                    return S ? S - 1 : 'k';
                                }
                            </script>


                            <!-- Tipo Atencion  -->
                            <div class="col-9 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-users text-primary"></i> Tipo Atención *
                                </label>
                                <select class="form-select" name="id_tipo_atencion" required>
                                    <option value="1" <?php echo (isset($_POST['id_atencion']) && $_POST['id_atencion'] == '1') ? 'selected' : ''; ?>>Terapia individual</option>
                                    <option value="2" <?php echo (isset($_POST['id_atencion']) && $_POST['id_atencion'] == '2') ? 'selected' : ''; ?>>Acompañamiento terapéutico</option>
                                </select>
                            </div>

                            <!-- Derivación -->
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user-tag text-primary"></i> Derivación *
                                </label>
                                <input type="text" class="form-control" name="derivacion" 
                                        value="<?php echo isset($_POST['derivacion']) ? $_POST['derivacion'] : ''; ?>"
                                        maxlength="200" required>
                            </div>
                        
                            <!-- Comentarios -->
                        <div class="mb-3">
                            <label class="textarea-label">
                                <i class="fas fa-file-medical text-primary"></i> Comentarios</label>
                            <textarea class="form-control" name="comentarios" rows="3"
                            value="<?php echo isset($_POST['comentarios']) ? $_POST['comentarios'] : ''; ?>"
                            maxlength="250"    ></textarea>
                            <div class="textarea-counter">
                                <span id="contador2">0</span>/250 caracteres
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
                            <div class="col-6 mb-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Fecha de Registro
                                </label>
                                <input type="date" class="form-control" name="fecha_registro" 
                                       value="<?php echo isset($_POST['fecha_registro']) ? $_POST['fecha_registro'] : ''; ?>">
                            </div>                       

                        <!-- Profesión -->
                            <div class="col-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-toggle-on text-primary"></i> Profesión
                                </label>
                                <select class="form-select" name="id_profesion">
                                    <option value="1" <?php echo (isset($_POST['id_profesion']) && $_POST['id_profesion'] == '1') ? 'selected' : ''; ?>>Pre-Práctica</option>
                                    <option value="2" <?php echo (isset($_POST['id_profesion']) && $_POST['id_profesion'] == '2') ? 'selected' : ''; ?>>Práctica</option>
                                </select>
                            </div>  
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
                                <i class="fas fa-save"></i> Guardar Paciente
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