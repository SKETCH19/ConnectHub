document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validación básica
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const message = document.getElementById('message');
            let isValid = true;
            
            // Reset errores
            resetErrors([name, email, message]);
            
            // Validar nombre
            if (name.value.trim().length < 3) {
                showError(name, 'Por favor ingrese su nombre completo');
                isValid = false;
            }
            
            // Validar email
            if (!validateEmail(email.value)) {
                showError(email, 'Por favor ingrese un email válido');
                isValid = false;
            }
            
            // Validar mensaje
            if (message.value.trim().length < 10) {
                showError(message, 'El mensaje debe tener al menos 10 caracteres');
                isValid = false;
            }
            
            if (isValid) {
                // Simular envío
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.disabled = true;
                submitBtn.innerHTML = 'Enviando... <i class="lnr lnr-sync lnr-spin"></i>';
                
                // Aquí iría la llamada AJAX real
                setTimeout(() => {
                    alert('Mensaje enviado con éxito. Nos pondremos en contacto pronto.');
                    contactForm.reset();
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 1500);
            }
        });
    }
    
    // Funciones de ayuda
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        let error = formGroup.querySelector('.error-message');
        
        if (!error) {
            error = document.createElement('div');
            error.className = 'error-message';
            formGroup.appendChild(error);
        }
        
        error.textContent = message;
        error.style.display = 'block';
        input.style.borderColor = '#e74c3c';
    }
    
    function resetErrors(inputs) {
        inputs.forEach(input => {
            input.style.borderColor = '#ddd';
            const error = input.closest('.form-group')?.querySelector('.error-message');
            if (error) error.style.display = 'none';
        });
    }
});