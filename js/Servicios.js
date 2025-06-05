document.addEventListener('DOMContentLoaded', function() {
    // Cambiar pestañas
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover clase active de todos los botones y contenidos
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Agregar active al botón clickeado
            this.classList.add('active');
            
            // Mostrar el contenido correspondiente
            const tabId = this.dataset.tab;
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // Galería de imágenes (para el spa)
    const spaThumbnails = document.querySelectorAll('#spa .thumbnail');
    const mainSpaImage = document.getElementById('main-spa-image');
    
    spaThumbnails.forEach(thumb => {
        thumb.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover active de todas las miniaturas
            spaThumbnails.forEach(t => t.classList.remove('active'));
            
            // Agregar active a la miniatura clickeada
            this.classList.add('active');
            
            // Cambiar la imagen principal
            mainSpaImage.src = this.src;
        });
    });
    
    // Galería de imágenes (para el restaurante)
    const restaurantThumbnails = document.querySelectorAll('#restaurante .thumbnail');
    const mainRestaurantImage = document.getElementById('main-restaurant-image');
    
    restaurantThumbnails.forEach(thumb => {
        thumb.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover active de todas las miniaturas
            restaurantThumbnails.forEach(t => t.classList.remove('active'));
            
            // Agregar active a la miniatura clickeada
            this.classList.add('active');
            
            // Cambiar la imagen principal
            mainRestaurantImage.src = this.src;
        });
    });
    
    // Galería de imágenes (para el transporte)
    const transportThumbnails = document.querySelectorAll('#transporte .thumbnail');
    const mainTransportImage = document.getElementById('main-transport-image');
    
    if (transportThumbnails.length > 0 && mainTransportImage) {
        transportThumbnails.forEach(thumb => {
            thumb.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remover active de todas las miniaturas
                transportThumbnails.forEach(t => t.classList.remove('active'));
                
                // Agregar active a la miniatura clickeada
                this.classList.add('active');
                
                // Cambiar la imagen principal
                mainTransportImage.src = this.src;
            });
        });
    }
    
    // Formulario de transporte
    const transportForm = document.getElementById('transport-form');
    
    if (transportForm) {
        transportForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validar formulario
            const transportType = document.getElementById('transport-type');
            const transportDate = document.getElementById('transport-date');
            const transportTime = document.getElementById('transport-time');
            let isValid = true;
            
            if (!transportType.value) {
                transportType.style.borderColor = '#e74c3c';
                isValid = false;
            }
            
            if (!transportDate.value) {
                transportDate.style.borderColor = '#e74c3c';
                isValid = false;
            }
            
            if (!transportTime.value) {
                transportTime.style.borderColor = '#e74c3c';
                isValid = false;
            }
            
            if (isValid) {
                // Simular envío (en producción sería una petición AJAX)
                const submitBtn = transportForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Procesando... <i class="fas fa-spinner fa-spin"></i>';
                
                setTimeout(() => {
                    alert('Solicitud de transporte enviada. Nos pondremos en contacto para confirmar los detalles.');
                    transportForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            }
        });
    }
    
    // Resetear estilos de validación al cambiar
    const formInputs = document.querySelectorAll('#transport-form input, #transport-form select');
    formInputs.forEach(input => {
        input.addEventListener('change', function() {
            this.style.borderColor = '#ddd';
        });
    });
});