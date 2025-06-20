document.addEventListener('DOMContentLoaded', function() {
    // Navegación entre pestañas
    const navLinks = document.querySelectorAll('.profile-nav a');
    const tabs = document.querySelectorAll('.profile-tab');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover active de todos los links y tabs
            navLinks.forEach(navLink => {
                navLink.parentElement.classList.remove('active');
            });
            
            tabs.forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Agregar active al link clickeado
            this.parentElement.classList.add('active');
            
            // Mostrar el tab correspondiente
            const target = this.getAttribute('href');
            document.querySelector(target).classList.add('active');
        });
    });
    
    // Cambiar avatar
    const uploadBtn = document.getElementById('upload-avatar');
    const avatarImg = document.getElementById('profile-avatar-img');
    
    uploadBtn.addEventListener('click', function(e) {
        e.preventDefault();
        // En una implementación real, esto abriría un selector de archivos
        alert('En una implementación real, esto permitiría subir una nueva foto de perfil');
    });
    
    // Validación de formularios
    const personalForm = document.getElementById('personal-info-form');
    if (personalForm) {
        personalForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Información personal actualizada con éxito');
            // Aquí iría la lógica para guardar los cambios
        });
    }
    
    const securityForm = document.getElementById('security-form');
    if (securityForm) {
        securityForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const currentPass = document.getElementById('current-password').value;
            const newPass = document.getElementById('new-password').value;
            const confirmPass = document.getElementById('confirm-password').value;
            
            if (newPass !== confirmPass) {
                alert('Las contraseñas no coinciden');
                return;
            }
            
            if (newPass.length < 8) {
                alert('La contraseña debe tener al menos 8 caracteres');
                return;
            }
            
            alert('Contraseña cambiada con éxito');
            securityForm.reset();
            // Aquí iría la lógica para cambiar la contraseña
        });
        
        // Indicador de fortaleza de contraseña
        const newPassInput = document.getElementById('new-password');
        const strengthBar = document.querySelector('.strength-bar');
        const strengthText = document.querySelector('.strength-text');
        
        newPassInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Longitud mínima
            if (password.length >= 8) strength += 1;
            
            // Contiene números
            if (/\d/.test(password)) strength += 1;
            
            // Contiene mayúsculas
            if (/[A-Z]/.test(password)) strength += 1;
            
            // Contiene caracteres especiales
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Actualizar barra y texto
            let width = 0;
            let text = '';
            let color = '';
            
            switch(strength) {
                case 0:
                case 1:
                    width = 25;
                    text = 'Débil';
                    color = 'var(--danger-color)';
                    break;
                case 2:
                    width = 50;
                    text = 'Moderada';
                    color = 'var(--warning-color)';
                    break;
                case 3:
                    width = 75;
                    text = 'Fuerte';
                    color = 'var(--success-color)';
                    break;
                case 4:
                    width = 100;
                    text = 'Muy Fuerte';
                    color = 'var(--primary-color)';
                    break;
            }
            
            strengthBar.style.width = width + '%';
            strengthBar.style.backgroundColor = color;
            strengthText.textContent = 'Seguridad: ' + text;
        });
    }
    
    const preferencesForm = document.getElementById('preferences-form');
    if (preferencesForm) {
        preferencesForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Preferencias guardadas con éxito');
            // Aquí iría la lógica para guardar las preferencias
        });
    }
    
    // Botones de cancelar reserva
    document.querySelectorAll('.reservation-actions .btn-cancel').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas cancelar esta reserva?')) {
                const reservationCard = this.closest('.reservation-card');
                reservationCard.classList.remove('confirmada');
                reservationCard.classList.add('cancelada');
                reservationCard.querySelector('.reservation-status').textContent = 'Cancelada';
                reservationCard.querySelector('.reservation-status').style.backgroundColor = 'rgba(220, 53, 69, 0.1)';
                reservationCard.querySelector('.reservation-status').style.color = 'var(--danger-color)';
                
                // Ocultar botón de cancelar después de cancelar
                this.style.display = 'none';
                
                alert('Reserva cancelada con éxito');
                // Aquí iría la lógica para cancelar la reserva en el servidor
            }
        });
    });
    
    // Preloder
    window.addEventListener('load', function() {
        document.getElementById('preloder').style.display = 'none';
    });
});