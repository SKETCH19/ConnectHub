<?php
include 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar registro
    $userData = [
        'full_name' => $_POST['full_name'],
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'birth_date' => $_POST['birth_date'],
        'country' => $_POST['country'],
        'phone' => $_POST['phone'],
        'profile_pic' => 'default.png' // Por defecto
    ];
    
    $result = registerUser($userData);
    
    if ($result['success']) {
        // Iniciar sesión automáticamente
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['username'] = $userData['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = $result['message'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sonder</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="welcome-page">
    <div class="stars"></div>
    <div class="form-container">
        <h1 class="form-title">Unirse a Sonder</h1>
        
        <?php if (isset($error)): ?>
            <div class="error-message" style="color: #ff6b6b; margin-bottom: 1rem; text-align: center;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" id="register-form">
            <div class="form-group">
                <label class="form-label">Nombre completo</label>
                <input type="text" name="full_name" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Correo electrónico</label>
                <input type="email" name="email" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Fecha de nacimiento</label>
                <input type="date" name="birth_date" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">País</label>
                <select name="country" class="form-select" required>
                    <option value="">Selecciona tu país</option>
                    <option value="ES">España</option>
                    <option value="MX">México</option>
                    <option value="AR">Argentina</option>
                    <option value="CO">Colombia</option>
                    <option value="US">Estados Unidos</option>
                    <option value="DR">Republica Dominica</option>
                    <!-- Más países -->
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">Número de teléfono</label>
                <input type="tel" name="phone" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nombre de usuario</label>
                <input type="text" name="username" class="form-input" required>
                <small style="opacity: 0.7;">Este será tu identificador único en Sonder</small>
            </div>
            
            <div class="form-group">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-input" required>
                <small style="opacity: 0.7;">Mínimo 8 caracteres con números y símbolos</small>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Registrarse</button>
        </form>
        
        <p style="text-align: center; margin-top: 1rem;">
            ¿Ya tienes cuenta? <a href="login.php" style="color: var(--electric-blue);">Inicia sesión</a>
        </p>
    </div>
    
    <script src="js/script.js"></script>
</body>
</html>