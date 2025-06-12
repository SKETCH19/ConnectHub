<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios - Hotel</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/Servicios.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include("Templates/menu.php"); ?>

    <!-- Servicios Section -->
    <section class="services-section">
        <div class="container">
            <!-- Pestañas de Servicios -->
            <div class="services-tabs">
                <button class="tab-btn active" data-tab="spa">Spa & Wellness</button>
                <button class="tab-btn" data-tab="restaurante">Restaurante</button>
                <button class="tab-btn" data-tab="transporte">Transporte</button>
            </div>
            
            <!-- Contenido de Pestañas -->
            <div class="tab-content active" id="spa">
                <div class="service-grid">
                    <div class="service-info">
                        <h2><i class="fas fa-spa"></i> Spa & Centro Wellness</h2>
                        <p>Relájese en nuestro spa de 5 estrellas con tratamientos personalizados y instalaciones de lujo.</p>
                        
                        <div class="service-schedule">
                            <h3>Horarios:</h3>
                            <ul>
                                <li><strong>Lunes-Viernes:</strong> 9:00 - 21:00</li>
                                <li><strong>Sábado-Domingo:</strong> 10:00 - 20:00</li>
                            </ul>
                        </div>
                        
                        <div class="service-pricing">
                            <h3>Tratamientos Destacados:</h3>
                            <ul class="price-list">
                                <li>
                                    <span>Masaje Relajante (60 min)</span>
                                    <span>$120</span>
                                </li>
                                <li>
                                    <span>Tratamiento Facial Premium</span>
                                    <span>$90</span>
                                </li>
                                <li>
                                    <span>Día Completo Wellness</span>
                                    <span>$250</span>
                                </li>
                            </ul>
                        </div>
                        
                        <a href="Reservas.php?service=spa" class="book-service-btn">
                            Reservar Tratamiento <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    
                    <div class="service-gallery">
                        <div class="main-image">
                            <img src="img/spa-1.jpg" alt="Spa del Hotel" id="main-spa-image">
                        </div>
                        <div class="thumbnail-container">
                            <img src="img/spa-1.jpg" alt="Miniatura 1" class="thumbnail active">
                            <img src="img/spa-2.jpg" alt="Miniatura 2" class="thumbnail">
                            <img src="img/spa-3.jpg" alt="Miniatura 3" class="thumbnail">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-content" id="restaurante">
                <div class="service-grid">
                    <div class="service-info">
                        <h2><i class="fas fa-utensils"></i> Restaurante "Gourmet Experience"</h2>
                        <p>Disfrute de nuestra gastronomía premiada con ingredientes locales y menús estacionales.</p>
                        
                        <div class="service-schedule">
                            <h3>Horarios:</h3>
                            <ul>
                                <li><strong>Desayuno:</strong> 7:00 - 11:00</li>
                                <li><strong>Almuerzo:</strong> 12:30 - 16:00</li>
                                <li><strong>Cena:</strong> 19:00 - 23:00</li>
                            </ul>
                        </div>
                        
                        <div class="menu-highlights">
                            <h3>Menú del Día:</h3>
                            <div class="menu-item">
                                <h4>Entrada</h4>
                                <p>Carpaccio de res con rúcula y parmesano</p>
                            </div>
                            <div class="menu-item">
                                <h4>Plato Principal</h4>
                                <p>Salmon al horno con vegetales de temporada</p>
                            </div>
                            <div class="menu-item">
                                <h4>Postre</h4>
                                <p>Soufflé de chocolate con helado de vainilla</p>
                            </div>
                            <p class="menu-price">Precio fijo: $45 por persona</p>
                        </div>
                        
                        <a href="Reservas.php?service=restaurante" class="book-service-btn">
                            Reservar Mesa <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    
                    <div class="service-gallery">
                        <div class="main-image">
                            <img src="img/restaurant-1.jpg" alt="Restaurante del Hotel" id="main-restaurant-image">
                        </div>
                        <div class="thumbnail-container">
                            <img src="img/restaurant-1.jpg" alt="Miniatura 1" class="thumbnail active">
                            <img src="img/restaurant-2.jpg" alt="Miniatura 2" class="thumbnail">
                            <img src="img/restaurant-3.jpg" alt="Miniatura 3" class="thumbnail">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="tab-content" id="transporte">
                <div class="service-grid">
                    <div class="service-info">
                        <h2><i class="fas fa-shuttle-van"></i> Servicio de Transporte</h2>
                        <p>Ofrecemos traslados premium desde/hacia el aeropuerto y otros destinos importantes.</p>
                        
                        <div class="transport-options">
                            <div class="transport-card">
                                <h3><i class="fas fa-plane"></i> Aeropuerto</h3>
                                <ul>
                                    <li><strong>Horario:</strong> 24/7 según llegadas</li>
                                    <li><strong>Vehículo:</strong> Mercedes-Benz Clase S</li>
                                    <li><strong>Precio:</strong> $60 por trayecto</li>
                                </ul>
                            </div>
                            
                            <div class="transport-card">
                                <h3><i class="fas fa-city"></i> City Tour</h3>
                                <ul>
                                    <li><strong>Duración:</strong> 4 horas</li>
                                    <li><strong>Incluye:</strong> Guía bilingüe</li>
                                    <li><strong>Precio:</strong> $120 por grupo</li>
                                </ul>
                            </div>
                        </div>
                        
                        <form id="transport-form" class="service-form">
                            <div class="form-group">
                                <label for="transport-type">Tipo de Servicio</label>
                                <select id="transport-type" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="aeropuerto">Traslado Aeropuerto</option>
                                    <option value="city-tour">City Tour</option>
                                    <option value="personalizado">Servicio Personalizado</option>
                                </select>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="transport-date">Fecha</label>
                                    <input type="date" id="transport-date" required>
                                </div>
                                <div class="form-group">
                                    <label for="transport-time">Hora</label>
                                    <input type="time" id="transport-time" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="transport-notes">Notas Especiales</label>
                                <textarea id="transport-notes" rows="3"></textarea>
                            </div>
                            
                            <button type="submit" class="book-service-btn">
                                Solicitar Transporte <i class="fas fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                    
                    <div class="service-gallery">
                        <div class="main-image">
                            <img src="img/transport-1.jpg" alt="Flota del Hotel" id="main-transport-image">
                        </div>
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423283.4355504763!2d-118.6919154!3d34.0207305!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s" 
                                    allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include("Templates/footer.php"); ?>

    <!-- JavaScript -->
    <script src="js/Servicios.js"></script>
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