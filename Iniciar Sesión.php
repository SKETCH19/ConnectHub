<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Hotel</title>
    
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
            <h2 class="auth-title"><span class="lnr lnr-enter"></span> Iniciar Sesión</h2>
            
            <form id="login-form" class="auth-form">
                <div class="form-group">
                    <label for="login-email"><span class="lnr lnr-envelope"></span> Email:</label>
                    <input type="email" id="login-email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="login-password"><span class="lnr lnr-lock"></span> Contraseña:</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="auth-btn">Iniciar Sesión</button>
                </div>
                
                <div class="auth-links">
                    <a href="Registrarse.php">¿No tienes cuenta? Regístrate</a>
                    <a href="#">¿Olvidaste tu contraseña?</a>
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