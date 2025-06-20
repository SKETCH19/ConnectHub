<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Hotel</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/Perfil.css">
    <link rel="stylesheet" href="css/menu-footer.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include("Templates/menu.php"); ?>

    <!-- Main Content -->
    <section class="profile-section">
        <div class="container">
            <div class="profile-grid">
                <!-- Sidebar -->
                <aside class="profile-sidebar">
                    <div class="profile-card">
    <div class="profile-avatar">
        <img src="img/avatar-default.png" alt="Avatar" id="profile-avatar-img">
        <button class="avatar-upload-btn" id="upload-avatar">
            <i class="fas fa-camera"></i>
        </button>
    </div>
    <h3><?php echo htmlspecialchars($usuario['nombre'] . ' ' . htmlspecialchars($usuario['apellido'])); ?></h3>
    <p class="profile-email"><?php echo htmlspecialchars($usuario['email']); ?></p>
    <p class="profile-member-since">Miembro desde: <?php echo date('M Y', strtotime($usuario['fecha_registro'])); ?></p>
</div>
                    
                    <nav class="profile-nav">
                        <ul>
                            <li class="active"><a href="#personal-info"><i class="fas fa-user-circle"></i> Información Personal</a></li>
                            <li><a href="#reservations"><i class="fas fa-calendar-alt"></i> Mis Reservas</a></li>
                            <li><a href="#security"><i class="fas fa-lock"></i> Seguridad</a></li>
                            <li><a href="#preferences"><i class="fas fa-cog"></i> Preferencias</a></li>
                        </ul>
                    </nav>
                </aside>
                
                <!-- Main Content -->
                <main class="profile-content">
                    <!-- Sección Información Personal -->
                    <section id="personal-info" class="profile-tab active">
                        <h2><i class="fas fa-user-circle"></i> Información Personal</h2>
                        <form id="personal-info-form" class="profile-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="first-name">Nombre</label>
                                    <input type="text" id="first-name" name="first-name" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="last-name">Apellido</label>
                                    <input type="text" id="last-name" name="last-name" value="<?php echo htmlspecialchars($usuario['apellido']); ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-cancel">Cancelar</button>
                                <button type="submit" class="btn btn-save">Guardar Cambios</button>
                            </div>
                        </form>
                    </section>
                    
                    <!-- Sección Mis Reservas -->
                    <section id="reservations" class="profile-tab">
                        <h2><i class="fas fa-calendar-alt"></i> Mis Reservas</h2>
                        
                        <?php if (empty($reservas)): ?>
                            <div class="empty-reservations">
                                <i class="fas fa-calendar-times"></i>
                                <p>No tienes reservas aún</p>
                                <a href="habitaciones.php" class="btn btn-primary">Reservar Ahora</a>
                            </div>
                        <?php else: ?>
                            <div class="reservations-list">
                                <?php foreach ($reservas as $reserva): ?>
                                    <div class="reservation-card <?php echo $reserva['estado']; ?>">
                                        <div class="reservation-header">
                                            <h3>Reserva #<?php echo $reserva['id']; ?></h3>
                                            <span class="reservation-status"><?php echo ucfirst($reserva['estado']); ?></span>
                                        </div>
                                        <div class="reservation-details">
                                            <div class="detail">
                                                <span class="label">Habitación:</span>
                                                <span class="value"><?php echo $reserva['habitacion']; ?></span>
                                            </div>
                                            <div class="detail">
                                                <span class="label">Fechas:</span>
                                                <span class="value">
                                                    <?php echo date('d M Y', strtotime($reserva['fecha_entrada'])); ?> - 
                                                    <?php echo date('d M Y', strtotime($reserva['fecha_salida'])); ?>
                                                </span>
                                            </div>
                                            <div class="detail">
                                                <span class="label">Total:</span>
                                                <span class="value">$<?php echo number_format($reserva['total'], 2); ?></span>
                                            </div>
                                        </div>
                                        <div class="reservation-actions">
                                            <button class="btn btn-details">Ver Detalles</button>
                                            <?php if ($reserva['estado'] == 'confirmada'): ?>
                                                <button class="btn btn-cancel">Cancelar Reserva</button>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                    
                    <!-- Sección Seguridad -->
                    <section id="security" class="profile-tab">
                        <h2><i class="fas fa-lock"></i> Seguridad</h2>
                        <form id="security-form" class="profile-form">
                            <div class="form-group">
                                <label for="current-password">Contraseña Actual</label>
                                <input type="password" id="current-password" name="current-password" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="new-password">Nueva Contraseña</label>
                                <input type="password" id="new-password" name="new-password" required>
                                <div class="password-strength">
                                    <span class="strength-bar"></span>
                                    <span class="strength-text">Seguridad: Baja</span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm-password">Confirmar Nueva Contraseña</label>
                                <input type="password" id="confirm-password" name="confirm-password" required>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-cancel">Cancelar</button>
                                <button type="submit" class="btn btn-save">Cambiar Contraseña</button>
                            </div>
                        </form>
                    </section>
                    
                    <!-- Sección Preferencias -->
                    <section id="preferences" class="profile-tab">
                        <h2><i class="fas fa-cog"></i> Preferencias</h2>
                        <form id="preferences-form" class="profile-form">
                            <div class="form-group">
                                <label>Idioma Preferido</label>
                                <select name="language">
                                    <option value="es">Español</option>
                                    <option value="en">English</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Tema</label>
                                <div class="theme-options">
                                    <label class="radio-option">
                                        <input type="radio" name="theme" value="light" checked>
                                        <span class="radio-label">Claro</span>
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="theme" value="dark">
                                        <span class="radio-label">Oscuro</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="checkbox-option">
                                    <input type="checkbox" name="newsletter" checked>
                                    <span>Recibir ofertas y promociones por correo</span>
                                </label>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn btn-cancel">Cancelar</button>
                                <button type="submit" class="btn btn-save">Guardar Preferencias</button>
                            </div>
                        </form>
                    </section>
                </main>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include("Templates/footer.php"); ?>

    <!-- JavaScript -->
    <script src="js/Perfil.js"></script>
    <script>
        // Preloder
        window.addEventListener('load', function() {
            document.getElementById('preloder').style.display = 'none';
        });

        // Hero Background
        if(document.querySelector('.set-bg')) {
            document.querySelector('.set-bg').style.backgroundImage = 
                "url('" + document.querySelector('.set-bg').getAttribute('data-setbg') + "')";
        }
    </script>
</body>
</html>