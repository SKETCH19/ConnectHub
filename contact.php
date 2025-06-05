<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Hotel</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/Contacto.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include("Templates/menu.php"); ?>
    
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Info -->
                <div class="contact-info">
                    <h2>Información de Contacto</h2>
                    <ul class="contact-details">
                        <li>
                            <span class="lnr lnr-map-marker"></span>
                            <p>1525 Boring Lane, Los Angeles, CA</p>
                        </li>
                        <li>
                            <span class="lnr lnr-phone-handset"></span>
                            <p>+1 (603) 535-4592</p>
                        </li>
                        <li>
                            <span class="lnr lnr-envelope"></span>
                            <p>hola@hotel.com</p>
                        </li>
                        <li>
                            <span class="lnr lnr-clock"></span>
                            <p>Abierto todos los días: 06:00 - 22:00</p>
                        </li>
                    </ul>
                    
                    <div class="social-media">
                        <h3>Síganos en:</h3>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Form -->
                <div class="contact-form">
                    <h2>Escríbanos</h2>
                    <form id="contact-form" method="POST">
                        <div class="form-group">
                            <label for="name">Nombre Completo</label>
                            <div class="input-with-icon">
                                <input type="text" id="name" name="name" required>
                                <span class="lnr lnr-user"></span>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group half">
                                <label for="email">Email</label>
                                <div class="input-with-icon">
                                    <input type="email" id="email" name="email" required>
                                    <span class="lnr lnr-envelope"></span>
                                </div>
                            </div>
                            
                            <div class="form-group half">
                                <label for="phone">Teléfono</label>
                                <div class="input-with-icon">
                                    <input type="tel" id="phone" name="phone">
                                    <span class="lnr lnr-phone-handset"></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <div class="textarea-with-icon">
                                <textarea id="message" name="message" rows="5" required></textarea>
                                <span class="lnr lnr-bubble"></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="submit-btn">
                            Enviar Mensaje <i class="lnr lnr-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Google Map -->
    <div class="contact-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d423283.4355676389!2d-118.69193052429003!3d34.02073049434915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c75ddc27da13%3A0xe22fdf6f254608f4!2sLos%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1568665689853!5m2!1sen!2sbd" 
                allowfullscreen="" loading="lazy"></iframe>
    </div>

    <!-- Footer -->
    <?php include("Templates/footer.php"); ?>

    <!-- JavaScript -->
    <script src="js/Contacto.js"></script>
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