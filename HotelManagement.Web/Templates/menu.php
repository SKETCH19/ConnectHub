<link rel="stylesheet" href="css/Menu & Footer.css" type="text/css">

<style>
    /* Logo de texto */
    .logo-text {
        font-size: 32px;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
        font-family: 'Arial', sans-serif;
        letter-spacing: 2px;
    }

    .logo-text:hover {
        color: #ffffff;
        text-decoration: none;
    }
</style>

<header class="header-section" id="header">
    <div class="container-fluid">
        <div class="inner-header">
            <div class="logo">
                <a href="./index.php" class="logo-text">HOTEL</a>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <nav class="main-menu mobile-menu" id="mainMenu">
                            <ul>
                                <li><a href="./index.php"><i class="fas fa-home"></i> Inicio</a></li>
                                <li><a href="./Habitaciones.php"><i class="fas fa-bed"></i> Habitaciones</a></li>
                                <li><a href="./Servicios.php"><i class="fas fa-concierge-bell"></i> Servicios</a></li>
                                <li><a href="./Reservas.php"><i class="fas fa-calendar-check"></i> Reservas</a></li>
                                <li><a href="#"><i class="fas fa-user"></i> Mi Cuenta</a>
                                    <ul class="drop-menu">
                                        <li><a href="Iniciar Sesión.php"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a></li>
                                        <li><a href="Registrarse.php"><i class="fas fa-user-plus"></i> Registrarse</a></li>
                                    </ul>
                                </li>
                                <li><a href="./admin.php"><i class="fas fa-cog"></i> Admin</a></li>
                                <li><a href="./contact.php"><i class="fas fa-envelope"></i> Contacto</a></li>
                                <li><a href="./Perfil.php"><i class="fas fa-user"></i> Perfil</a></li>
                            </ul>
                        </nav>

                        <div class="top-info"></div>
                    </div>
                </div>
            </div>

            <button class="mobile-menu-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </button>

            <div id="mobile-menu-wrap"></div>
        </div>
    </div>
</header>

<script src="js/Menu & Footer.js"></script>
