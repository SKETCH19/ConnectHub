<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones - Hotel</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Taviraj:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/Habitaciones.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header -->
    <?php include("Templates/menu.php"); ?>
    
    <!-- Rooms Section -->
    <section class="rooms-section">
        <div class="container">
            <div class="section-header">
                <h2>Categorías de Habitaciones</h2>
                <p>Seleccione la que mejor se adapte a sus necesidades</p>
            </div>
            
            <!-- Filtros -->
            <div class="rooms-filters">
                <div class="search-box">
                    <input type="text" id="room-search" placeholder="Buscar habitación...">
                    <i class="lnr lnr-magnifier"></i>
                </div>
                <select id="price-filter">
                    <option value="all">Todos los precios</option>
                    <option value="0-100">$0 - $100</option>
                    <option value="100-200">$100 - $200</option>
                    <option value="200-300">$200 - $300</option>
                    <option value="300+">$300+</option>
                </select>
                <select id="type-filter">
                    <option value="all">Todas las categorías</option>
                    <option value="standard">Standard</option>
                    <option value="double">Double</option>
                    <option value="suite">Suite</option>
                </select>
            </div>
            
            <!-- Grid de Habitaciones -->
            <div class="rooms-grid" id="rooms-grid">
                <!-- Las habitaciones se cargarán dinámicamente con JS -->
            </div>
            
            <!-- Tabla de Precios -->
            <div class="pricing-table">
                <h3>Tarifas por Temporada</h3>
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Temporada Baja</th>
                                <th>Temporada Media</th>
                                <th>Temporada Alta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Los datos se cargarán con JS -->
                        </tbody>
                    </table>
                </div>
                <p class="note">* Precios por noche, sujetos a disponibilidad</p>
            </div>
        </div>
    </section>

    <!-- Modal Galería 360° -->
    <div class="modal" id="galleryModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3 id="modal-room-title"></h3>
            <div class="360-view-container" id="360-view-container">
                <!-- Contenido dinámico -->
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include("Templates/footer.php"); ?>

    <!-- JavaScript -->
    <script src="js/Habitaciones.js"></script>
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