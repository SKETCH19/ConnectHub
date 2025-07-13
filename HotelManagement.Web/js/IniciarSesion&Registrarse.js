document.addEventListener('DOMContentLoaded', function() {
  // Elementos comunes
  const loginForm = document.getElementById('login-form');
  const registerForm = document.getElementById('register-form');
  
  // Validación para el formulario de inicio de sesión
  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const email = document.getElementById('login-email');
      const password = document.getElementById('login-password');
      let isValid = true;
      
      // Reset errores
      resetErrors([email, password]);
      
      // Validar email
      if (!validateEmail(email.value)) {
        showError(email, 'Por favor ingresa un email válido');
        isValid = false;
      }
      
      // Validar contraseña
      if (password.value.length < 6) {
        showError(password, 'La contraseña debe tener al menos 6 caracteres');
        isValid = false;
      }
      
      if (isValid) {
        // Simular envío (en producción sería una petición AJAX)
        simulateSubmit(loginForm, 'Iniciando sesión...');
        
        // Aquí va la llamada al backend
      }
    });
  }
  
  // Validación para el formulario de registro
  if (registerForm) {
    registerForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const name = document.getElementById('register-name');
      const email = document.getElementById('register-email');
      const phone = document.getElementById('register-phone');
      const password = document.getElementById('register-password');
      const confirm = document.getElementById('register-confirm');
      let isValid = true;
      
      // Reset errores
      resetErrors([name, email, phone, password, confirm]);
      
      // Validar nombre
      if (name.value.trim().length < 3) {
        showError(name, 'El nombre debe tener al menos 3 caracteres');
        isValid = false;
      }
      
      // Validar email
      if (!validateEmail(email.value)) {
        showError(email, 'Por favor ingresa un email válido');
        isValid = false;
      }
      
      // Validar teléfono (formato simple)
      if (!validatePhone(phone.value)) {
        showError(phone, 'Ingresa un número de teléfono válido');
        isValid = false;
      }
      
      // Validar contraseña
      if (!validatePassword(password.value)) {
        showError(password, 'La contraseña debe tener al menos 8 caracteres, incluyendo números y símbolos');
        isValid = false;
      }
      
      // Validar confirmación
      if (password.value !== confirm.value) {
        showError(confirm, 'Las contraseñas no coinciden');
        isValid = false;
      }
      
      if (isValid) {
        // Simular envío (en producción sería una petición AJAX)
        simulateSubmit(registerForm, 'Creando cuenta...');
        
        // Aquí va la llamada al backend
      }
    });
  }
  
  // Funciones de ayuda
  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }
  
  function validatePhone(phone) {
    const re = /^[0-9]{10,15}$/;
    return re.test(phone);
  }
  
  function validatePassword(password) {
    // Mínimo 8 caracteres, al menos una letra y un número
    const re = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{8,}$/;
    return re.test(password);
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
    input.classList.add('input-error');
  }
  
  function resetErrors(inputs) {
    inputs.forEach(input => {
      input.classList.remove('input-error');
      const error = input.closest('.form-group')?.querySelector('.error-message');
      if (error) error.style.display = 'none';
    });
  }
  
  function simulateSubmit(form, message) {
    const button = form.querySelector('button[type="submit"]');
    const originalText = button.textContent;
    
    // Deshabilitar botón y cambiar texto
    button.disabled = true;
    button.textContent = message;
    button.style.opacity = '0.7';
    
    // Simular retraso de red
    setTimeout(() => {
      // Mensaje de éxito
      alert('Formulario enviado correctamente (simulación)');
      
      // Restaurar botón
      button.disabled = false;
      button.textContent = originalText;
      button.style.opacity = '1';
      
      // Resetear formulario
      form.reset();
    }, 1500);
  }
});