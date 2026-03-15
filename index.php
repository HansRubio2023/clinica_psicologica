<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="icon" href="imagenes/inicio/favicon-32x32.png" type="image/x-icon">
</head>
<body class="login-background">
    <div class="clearfix-padding"></div>
    <div class="clearfix-padding"></div>
    <div class="login-container">
      <h1>Iniciar Sesión</h1>
      <form id="loginForm" action="conexion/conexion.php" method="POST">
        <div class="input-group">
          <label for="user">Usuario</label>
          <input
            type="text"
            id="user"
            name="user"
            placeholder="Tu nombre de usuario"
            required
          />
        </div>
        <div class="input-group">
          <label for="pass">Contraseña</label>
          <input type="password" id="pass" name="pass" placeholder="Tu contraseña" required />
        </div>
        <button type="submit" class="btn btn-success btn-lg px-4" onclick="location.href='menu.php'">Iniciar Sesión</button>
      </form>
    
    </div>
    <div class="clearfix-padding"></div>
    <div class="clearfix-padding"></div>
    <div class="clearfix-padding"></div>
    <div id="qr-overlay">
      <div id="qr-container">
        <div id="qr-message">Escanea el código QR para descubrir nuestra carta</div>
        <img id="qrcode" src="" alt="Código QR" />
        <button onclick="hideQRCode()">Cerrar</button>
      </div>
    </div>
    <script>
      function showQRCode() {
        const qrOverlay = document.getElementById('qr-overlay');
        const qrContainer = document.getElementById('qr-container');
        const qrCode = document.getElementById('qrcode');
        QRCode.toDataURL('https://drive.google.com/file/d/1iuBKiy9Hu_XKmNbnSOZjXs5MBrUHYniI/view?usp=drive_link', { width: 300 }, function (err, url) {
          if (err) {
            console.error(err);
            return;
          }
          qrCode.src = url;
          qrOverlay.style.display = 'block';
          qrContainer.style.display = 'block';
        });
      }
      function hideQRCode() {
        const qrOverlay = document.getElementById('qr-overlay');
        qrOverlay.style.display = 'none';
      }
    </script>
    <script>
      document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const username = document.getElementById('user').value;
        const password = document.getElementById('pass').value;
        fetch('conexionbase/autenticar.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: `user=${encodeURIComponent(username)}&pass=${encodeURIComponent(password)}`
        })
        .then(response => response.json())
        .then(data => {
          console.log('Respuesta del servidor:', data); 
          if (data.success) {
            switch(data.role) {
              case 'admin':
                window.location.href = 'htmlredireccion/paneladmin.html';
                break;
              case 'empleado':
                window.location.href = 'htmlredireccion/paneltrabajador.html';
                break;
              case 'cliente':
                window.location.href = 'htmlredireccion/panelcliente.html';
                break;
              default:
                console.error('Rol desconocido:', data.role);
                alert('Error: Rol de usuario desconocido');
            }
          } else {
            alert(data.message || "Error de autenticación");
          }
        })
        .catch(error => {
          console.error('Error:', error);
          alert("Ocurrió un error durante la autenticación. Por favor, revisa la consola para más detalles.");
        });
      });
    </script>
</body>
</html>