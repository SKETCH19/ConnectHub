document.addEventListener('DOMContentLoaded', function() {
    // Variables globales
    const bookingForm = document.getElementById('booking-form');
    const steps = document.querySelectorAll('.step');
    const formSteps = document.querySelectorAll('.form-step');
    const stepProgress = document.querySelector('.step-progress');
    let currentStep = 1;
    
    // Inicialización
    if (bookingForm) {
        // Validación de fechas
        const checkInInput = document.getElementById('check-in');
        const checkOutInput = document.getElementById('check-out');
        
        // Establecer fecha mínima para check-out
        checkInInput.addEventListener('change', function() {
            const checkInDate = new Date(this.value);
            checkOutInput.min = this.value;
            
            // Si check-out es anterior a check-in, resetear
            if (new Date(checkOutInput.value) < checkInDate) {
                checkOutInput.value = '';
            }
        });
        
        // Botones de navegación
        document.querySelectorAll('.btn-next').forEach(button => {
            button.addEventListener('click', function() {
                if (validateStep(currentStep)) {
                    goToStep(currentStep + 1);
                }
            });
        });
        
        document.querySelectorAll('.btn-prev').forEach(button => {
            button.addEventListener('click', function() {
                goToStep(currentStep - 1);
            });
        });
        
        // Actualizar resumen antes de enviar
        bookingForm.addEventListener('submit', function(e) {
            if (currentStep === 3) {
                if (!validateStep(currentStep)) {
                    e.preventDefault();
                } else {
                    updateSummary();
                    // Simular envío (en producción sería una llamada AJAX)
                    const submitBtn = this.querySelector('.btn-submit');
                    const originalText = submitBtn.innerHTML;
                    
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = 'Procesando... <i class="lnr lnr-sync lnr-spin"></i>';
                    
                    // Aquí iría la llamada AJAX real
                    setTimeout(() => {
                        alert('Reserva confirmada con éxito. Recibirá un correo de confirmación.');
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 1500);
                }
            } else {
                e.preventDefault();
            }
        });
        
        // Inicializar primer paso
        goToStep(1);
    }
    
    // Funciones de ayuda
    function goToStep(step) {
        if (step < 1 || step > 3) return;
        
        // Actualizar UI de pasos
        steps.forEach(s => {
            if (parseInt(s.dataset.step) === step) {
                s.classList.add('active');
            } else {
                s.classList.remove('active');
            }
        });
        
        // Actualizar progreso
        stepProgress.dataset.step = step;
        
        // Mostrar paso actual
        formSteps.forEach(fs => {
            if (parseInt(fs.dataset.step) === step) {
                fs.classList.add('active');
            } else {
                fs.classList.remove('active');
            }
        });
        
        currentStep = step;
        
        // Actualizar resumen si estamos en el paso 3
        if (step === 3) {
            updateSummary();
        }
    }
    
    function validateStep(step) {
        let isValid = true;
        
        if (step === 1) {
            const checkIn = document.getElementById('check-in');
            const checkOut = document.getElementById('check-out');
            const roomType = document.getElementById('room-type');
            
            if (!checkIn.value) {
                showError(checkIn, 'Por favor seleccione fecha de entrada');
                isValid = false;
            }
            
            if (!checkOut.value) {
                showError(checkOut, 'Por favor seleccione fecha de salida');
                isValid = false;
            } else if (new Date(checkOut.value) <= new Date(checkIn.value)) {
                showError(checkOut, 'La fecha de salida debe ser posterior a la de entrada');
                isValid = false;
            }
            
            if (!roomType.value) {
                showError(roomType, 'Por favor seleccione un tipo de habitación');
                isValid = false;
            }
        } else if (step === 2) {
            const fullName = document.getElementById('full-name');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');
            
            if (fullName.value.trim().length < 3) {
                showError(fullName, 'Por favor ingrese su nombre completo');
                isValid = false;
            }
            
            if (!validateEmail(email.value)) {
                showError(email, 'Por favor ingrese un email válido');
                isValid = false;
            }
            
            if (phone.value.trim().length < 8) {
                showError(phone, 'Por favor ingrese un teléfono válido');
                isValid = false;
            }
        } else if (step === 3) {
            const terms = document.getElementById('terms');
            
            if (!terms.checked) {
                showError(terms, 'Debe aceptar los términos y condiciones');
                isValid = false;
            }
        }
        
        return isValid;
    }
    
    function updateSummary() {
        // Calcular noches
        const checkIn = new Date(document.getElementById('check-in').value);
        const checkOut = new Date(document.getElementById('check-out').value);
        const nights = Math.round((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        
        // Obtener valores
        const roomType = document.getElementById('room-type');
        const roomText = roomType.options[roomType.selectedIndex].text;
        const adults = document.getElementById('adults').value;
        const children = document.getElementById('children').value;
        
        // Calcular precio (simplificado)
        const roomPrice = parseFloat(roomType.value.match(/\$(\d+)/)?.[1]) || 0;
        const total = roomPrice * nights;
        
        // Actualizar resumen
        document.getElementById('summary-room').textContent = roomText;
        document.getElementById('summary-dates').textContent = 
            `${checkIn.toLocaleDateString()} - ${checkOut.toLocaleDateString()}`;
        document.getElementById('summary-guests').textContent = 
            `${adults} Adulto${adults > 1 ? 's' : ''}${children > 0 ? `, ${children} Niño${children > 1 ? 's' : ''}` : ''}`;
        document.getElementById('summary-nights').textContent = `${nights} Noche${nights > 1 ? 's' : ''}`;
        document.getElementById('summary-total').textContent = `$${total.toFixed(2)}`;
    }
    
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
        error.style.color = '#e74c3c';
        error.style.fontSize = '0.85rem';
        error.style.marginTop = '5px';
        error.style.display = 'block';
        
        if (input.tagName !== 'INPUT' && input.tagName !== 'SELECT' && input.tagName !== 'TEXTAREA') {
            // Para checkbox (términos)
            error.style.marginTop = '10px';
        } else {
            input.style.borderColor = '#e74c3c';
        }
    }
    
    // Preloder
    window.addEventListener('load', function() {
        document.getElementById('preloder').style.display = 'none';
    });
});