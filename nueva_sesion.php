<?php
include("../clinica_psicologica/conexion/conexion.php");

$con = connection();

$sql = "SELECT * FROM sesiones";
$query = mysqli_query($con, $sql);
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
    <form action="insert_sesion.php" method="POST">
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
                            <i class="fas fa-user-plus"></i> Nueva Sesión
                        </h2>
                        <p class="text-muted">Complete todos los campos requeridos *</p>
                    </div>
                    <!-- FORMULARIO -->
                    <form method="POST" id="formSesion">
                        <div class="row">
                            <!-- ID Sesión (oculto) -->
                            <input type="hidden" name="id_sesion" value="<?php echo isset($_POST['id_sesion']) ? $_POST['id_sesion'] : ''; ?>">   
                            
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

                            <!-- Nombre -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user text-primary"></i> Nombres *
                                </label>
                                <input type="text" class="form-control" id="nombres" name="nombres" 
                                       placeholder="Marcos Andrés" maxlength="50" required>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user-tag text-primary"></i> Apellidos *
                                </label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" 
                                       value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : ''; ?>"
                                       placeholder="Cuevas Rubio" maxlength="50" required>
                            </div>
                            <script>
                                document.getElementById('rut').addEventListener('blur', function() {
                                    let rutValor = this.value;

                                    // Solo busca si el RUT es válido según tu función existente
                                    if (fnValidarRut(rutValor)) {
                                        fetch('buscar_paciente.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded',
                                            },
                                            body: 'rut=' + encodeURIComponent(rutValor)
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data) {
                                                // Rellenar los campos con la información encontrada
                                                document.getElementById('nombres').value = data.nombres;
                                                document.getElementById('apellidos').value = data.apellidos;
                                                
                                                // Opcional: marcar como solo lectura si ya existe
                                                document.getElementById('nombres').readOnly = true;
                                                document.getElementById('apellidos').readOnly = true;
                                            } else {
                                                // Si no existe, limpiar y permitir escribir
                                                document.getElementById('nombres').value = "";
                                                document.getElementById('apellidos').value = "";
                                                document.getElementById('nombres').readOnly = false;
                                                document.getElementById('apellidos').readOnly = false;
                                            }
                                        })
                                        .catch(error => console.error('Error:', error));
                                    }
                                });
                            </script>

                            <!-- Num Sesión -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-id-card text-primary"></i> Número de Sesión *
                                </label>
                                <input type="number" class="form-control" id="numero_sesion" name="numero_sesion" 
                                       min="1" required>
                            </div>

                            <!-- Fecha Sesión -->
                            <div class="col-12 mb-4">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Fecha de Sesión
                                </label>
                                <input type="date" class="form-control" name="fecha_sesion" 
                                       value="<?php echo isset($_POST['fecha_sesion']) ? $_POST['fecha_sesion'] : ''; ?>">
                            </div>
                        </div>
                        
                        <script>
                            document.getElementById('rut').addEventListener('blur', function() {
                                let rutValor = this.value;

                                // Solo hacemos la consulta si el RUT es válido
                                if (fnValidarRut(rutValor)) {
                                    fetch('buscar_numero_sesion.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: 'rut=' + encodeURIComponent(rutValor)
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data && data.siguiente_sesion) {
                                            // Rellenar la caja de texto con el número calculado
                                            document.getElementById('numero_sesion').value = data.siguiente_sesion;
                                        }
                                    })
                                    .catch(error => console.error('Error en la petición:', error));
                                } else {
                                    // Si el RUT es inválido o se borra, limpiamos el campo
                                    document.getElementById('numero_sesion').value = '';
                                }
                            });
                            </script>

                        <!-- Comentarios -->
                        <div class="mb-3">
                            <label class="textarea-label">
                                <i class="fas fa-file-medical text-primary"></i> Comentarios</label>
                            <textarea class="form-control" name="comentarios"
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

                        <!-- Usuario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-tag text-primary"></i> Usuario
                                </label>
                                <input type="text" class="form-control" name="usuario" 
                                       value="<?php echo isset($_POST['usuario']) ? $_POST['usuario'] : ''; ?>"
                                       placeholder="juanperez" maxlength="50">
                            </div>
                        <!--Crear una lista desplegable para el campo "Asiste" con opciones "Sí" y "No"-->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-check text-primary"></i> Asiste    
                            </label>
                            <select class="form-select" name="asiste">
                                <option value="Sí" <?php echo (isset($_POST['asiste']) && $_POST['asiste'] == 'Sí') ? 'selected' : ''; ?>>Sí</option>
                                <option value="No" <?php echo (isset($_POST['asiste']) && $_POST['asiste'] == 'No') ? 'selected' : ''; ?>>No</option>
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