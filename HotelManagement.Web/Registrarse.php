<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Hotel</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    
    <!-- CSS -->
     <link rel="stylesheet" href="css/Iniciar Sesion & Registrarse.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include("Templates/menu.php"); ?>
    
    <!-- Contenido Principal -->
    <div class="auth-container">
        <div class="auth-card">
            <h2 class="auth-title"><span class="lnr lnr-user"></span> Registrarse</h2>
            
            <form id="register-form" class="auth-form">
                <div class="form-group">
                    <label for="register-name"><span class="lnr lnr-user"></span> Nombre Completo:</label>
                    <input type="text" id="register-name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="register-email"><span class="lnr lnr-envelope"></span> Email:</label>
                    <input type="email" id="register-email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="register-phone"><span class="lnr lnr-phone-handset"></span> Teléfono:</label>
                    <input type="tel" id="register-phone" name="phone" required>
                </div>
                
                <div class="form-group">
                    <label for="register-password"><span class="lnr lnr-lock"></span> Contraseña:</label>
                    <input type="password" id="register-password" name="password" required>
                    <small class="form-text">Mínimo 8 caracteres, incluir números y símbolos</small>
                </div>
                
                <div class="form-group">
                    <label for="register-confirm"><span class="lnr lnr-lock"></span> Confirmar Contraseña:</label>
                    <input type="password" id="register-confirm" name="confirm" required>
                </div>
                
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="register-newsletter" name="newsletter">
                    <label for="register-newsletter">Deseo recibir ofertas y promociones</label>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="auth-btn">Registrarse</button>
                </div>
                
                <div class="auth-links">
                    <a href="Iniciar Sesión.php">¿Ya tienes cuenta? Inicia Sesión</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <?php include("Templates/footer.php"); ?>

    <!-- JavaScript -->
    <script src="js/Iniciar Sesion & Registrarse.js"></script>
    <script>
        // Preloder
        window.addEventListener('load', function() {
            document.getElementById('preloder').style.display = 'none';
        });
    </script>
</body>
</html>