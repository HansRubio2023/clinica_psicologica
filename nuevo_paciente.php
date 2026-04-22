<?php
session_start();

include("../clinica_psicologica/conexion/conexion.php");

$con = connection();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

$sql = "SELECT * FROM pacientes";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pacientes</title>
    <link rel="stylesheet" href="css/nuevo_pacientes.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        .flatpickr-day.feriado {
            background-color: #dc3545 !important;
            color: white !important;
        }
        .flatpickr-day.feriado:hover {
            background-color: #bb2d3b !important;
        }
    </style>
</head>
<body>
    <form action="insert_paciente.php" method="POST">
   <div class="menu-container">
            <a id="inicio" href="menu.php" class="btn btn-inicio menu-btn">
                <i class="fas fa-home btn-icon"></i>
                Inicio
            </a>
                        
            <a id= "cerrar_sesion" href="logout.php" class="btn btn-logout menu-btn">
                <i class="fas fa-sign-out-alt btn-icon"></i>
                Cerrar Sesión
            </a>
    </div>    
        <div class="menu-card">
            <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                    <!-- Mensaje -->

                    <?php
            if(isset($_GET['error'])) {
                if($_GET['error'] == 'rut_exists') {
                    echo '<div class="alert alert-danger text-center" role="alert">Error: El rut ya está registrado</div>';
                } elseif($_GET['error'] == 'insert_failed') {
                    echo '<div class="alert alert-danger text-center" role="alert">Error al insertar el usuario</div>';
                }
            } ?>
            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-danger"> <?= $_SESSION['error']; ?>
                 </div>
                 <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                    <!-- Título -->
                    <div class="text-center mb-4 ">
                        <h2 class="fw-bold text-primary mb-2">
                            <i class="fas fa-user-plus" ></i> Nuevo Paciente
                        </h2>
                        <p class="text-muted">Complete todos los campos requeridos *</p>
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
                                <input type="text" class="form-control" id="rut" name="rut" 
                                    value="<?php echo isset($_POST['rut']) ? $_POST['rut'] : ''; ?>"
                                    placeholder="12.345.678-7" maxlength="12" required>
                                <div id="rut-error" class="invalid-feedback">RUT inválido.</div>
                            </div>
                            <script>
                         document.getElementById('rut').addEventListener('input', function(e) {
                                let value = e.target.value.replace(/\./g, '').replace('-', '');
                                
                                if(/^\d{7,8}[0-9kk]$/.test(value)) {
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
                                <input type="text" class="form-control" name="nombres" 
                                       maxlength="50" required>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-user-tag text-primary"></i> Apellidos *
                                </label>
                                <input type="text" class="form-control" name="apellidos" 
                                       value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : ''; ?>"
                                       maxlength="50" required>
                            </div>

                            <!-- Teléfono -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">
                                    <i class="fas fa-phone text-primary"></i> Celular *
                                
                                </label>
                                <input type="tel" class="form-control" name="celular" 
                                       value="<?php echo isset($_POST['celular']) ? $_POST['celular'] : ''; ?>"
                                       placeholder="987654321" maxlength="15"required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
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
                            <div class="col-6 mb-4">
                            <label class="form-label fw-bold">
                                <i class="fas fa-calendar-alt text-primary"></i> Fecha de Registro *
                            </label>
                            <input type="text" class="form-control" name="fecha_registro" id="fecha_registro"
                            value="<?= isset($_SESSION['fecha_registro']) ? $_SESSION['fecha_registro'] : date('Y-m-d') ?>"required>
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

                        <!-- Rango Etario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-users text-primary"></i> Rango Etario  
                                </label>
                                <select class="form-select" name="id_rango_etareo">
                                    <option value="1" <?php echo (isset($_POST['id_rango_etareo']) && $_POST['id_rango_etareo'] == '1') ? 'selected' : ''; ?>>Niño</option>
                                    <option value="2" <?php echo (isset($_POST['id_rango_etareo']) && $_POST['id_rango_etareo'] == '2') ? 'selected' : ''; ?>>Adulto</option>
                                    <option value="3" <?php echo (isset($_POST['id_rango_etareo']) && $_POST['id_rango_etareo'] == '3') ? 'selected' : ''; ?>>Adolescente</option>
                                </select>
                            </div>
    
                        <!-- Estado -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label
">
                                    <i class="fas fa-toggle-on text-primary"></i> Estado
                                </label>
                                <select class="form-select" name="id_estado">
                                    <option value="1" <?php echo (isset($_POST['id_estado']) && $_POST['id_estado'] == '1') ? 'selected' : ''; ?>>En curso</option>
                                    <option value="2" <?php echo (isset($_POST['id_estado']) && $_POST['id_estado'] == '2') ? 'selected' : ''; ?>>Derivado</option>
                                    <option value="3" <?php echo (isset($_POST['id_estado']) && $_POST['id_estado'] == '3') ? 'selected' : ''; ?>>Deserción</option>
                                    <option value="4" <?php echo (isset($_POST['id_estado']) && $_POST['id_estado'] == '4') ? 'selected' : ''; ?>>Alta Terapéutica</option>
                                    <option value="5" <?php echo (isset($_POST['id_estado']) && $_POST['id_estado'] == '5') ? 'selected' : ''; ?>>Alta por deserción</option>
                                    <option value="6" <?php echo (isset($_POST['id_estado']) && $_POST['id_estado'] == '6') ? 'selected' : ''; ?>>Alta administrativa</option>
                                </select>
                            </div>  
                        <!-- Usuario -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-user-tag text-primary"></i> Usuario
                                </label>
                                <input type="text" class="form-control" name="usuario" 
                                       value="<?php echo $_SESSION['email']; ?>"
                                       placeholder="caespinozar" maxlength="50">
                            </div>

                        <!-- BOTONES -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button type="submit" class="btn btn-success btn-lg px-4"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                                <i class="fas fa-save"></i> Guardar 
                            </button>
                            <button type="button" class="btn btn-secondary btn-lg px-4" onclick="window.location.href='pacientes.php'"style=" font-family: 'poppins', sans-serif;
    font-size: 20px;">
                                <i class="fas fa-times"></i> Cancelar
                            </button>
                        </div>
                    </form>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
    <script>
        async function init() {
            let feriados = {};
            const y = new Date().getFullYear();
            try {
                for (const año of [y, y + 1]) {
                    const data = await (await fetch(`https://feriados-cl.netlify.app/api/holidays/${año}`)).json();
                    Object.values(data.feriados).flat().forEach(f => {
                        feriados[`${año}-${String(f.mes).padStart(2,'0')}-${String(f.dia).padStart(2,'0')}`] = f.descripcion;
                    });
                }
            } catch(e) {}

            flatpickr("#fecha_registro", {
                locale: "es",
                dateFormat: "Y-m-d",
                disable: Object.keys(feriados),
                onDayCreate: (_, __, ___, day) => {
                    const fecha = day.dateObj.toISOString().split('T')[0];
                    if (feriados[fecha]) {
                        day.classList.add('feriado');
                        day.title = feriados[fecha];
                    }
                }
            });
        }
        init();
    </script>
                </div>
            </div>
        </div>
        </div>
        


    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>