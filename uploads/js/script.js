// script.js - Funcionalidades generales de ConnectHub

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar todas las funcionalidades
    initPasswordToggle();
    initFormValidations();
    initAutoLogout();
    initNotifications();
    initResponsiveMenu();
});

// Función para mostrar/ocultar contraseña
function initPasswordToggle() {
    const toggleButtons = document.querySelectorAll('.password-toggle');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const passwordInput = this.previousElementSibling;
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Cambiar icono
            this.textContent = type === 'password' ? '👁️' : '🔒';
        });
    });
}

// Validaciones de formularios
function initFormValidations() {
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!validateForm(this)) {
                e.preventDefault();
            }
        });
    });
}

// Validación general de formularios
function validateForm(form) {
    let isValid = true;
    const inputs = form.querySelectorAll('input[required]');
    
    inputs.forEach(input => {
        if (!input.value.trim()) {
            showInputError(input, 'Este campo es obligatorio');
            isValid = false;
        } else {
            clearInputError(input);
            
            // Validaciones específicas por tipo
            switch(input.type) {
                case 'email':
                    if (!isValidEmail(input.value)) {
                        showInputError(input, 'Ingresa un email válido');
                        isValid = false;
                    }
                    break;
                    
                case 'password':
                    if (input.id === 'password' && !isStrongPassword(input.value)) {
                        showInputError(input, 'La contraseña debe tener al menos 8 caracteres, una mayúscula y un número');
                        isValid = false;
                    }
                    break;
                    
                case 'text':
                    if (input.name === 'username' && !isValidUsername(input.value)) {
                        showInputError(input, 'El usuario solo puede contener letras, números y guiones bajos');
                        isValid = false;
                    }
                    break;
            }
        }
    });
    
    // Validar confirmación de contraseña
    const password = form.querySelector('#password');
    const confirmPassword = form.querySelector('#confirm_password');
    
    if (password && confirmPassword && password.value !== confirmPassword.value) {
        showInputError(confirmPassword, 'Las contraseñas no coinciden');
        isValid = false;
    }
    
    return isValid;
}

// Mostrar error en input
function showInputError(input, message) {
    clearInputError(input);
    
    input.style.borderColor = '#dc3545';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'input-error';
    errorDiv.style.color = '#dc3545';
    errorDiv.style.fontSize = '0.85em';
    errorDiv.style.marginTop = '5px';
    errorDiv.textContent = message;
    
    input.parentNode.appendChild(errorDiv);
}

// Limpiar error de input
function clearInputError(input) {
    input.style.borderColor = '';
    
    const existingError = input.parentNode.querySelector('.input-error');
    if (existingError) {
        existingError.remove();
    }
}

// Validar formato de email
function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

// Validar fortaleza de contraseña
function isStrongPassword(password) {
    return password.length >= 8 && 
           /[A-Z]/.test(password) && 
           /[0-9]/.test(password);
}

// Validar formato de usuario
function isValidUsername(username) {
    const usernameRegex = /^[a-zA-Z0-9_]+$/;
    return usernameRegex.test(username);
}

// Auto logout después de inactividad
function initAutoLogout() {
    let timeout;
    const logoutTime = 30 * 60 * 1000; // 30 minutos
    
    function resetTimer() {
        clearTimeout(timeout);
        timeout = setTimeout(logout, logoutTime);
    }
    
    function logout() {
        if (confirm('Tu sesión expirará por inactividad. ¿Quieres mantenerla activa?')) {
            resetTimer();
        } else {
            window.location.href = 'logout.php';
        }
    }
    
    // Reiniciar timer en eventos de usuario
    ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'].forEach(event => {
        document.addEventListener(event, resetTimer, false);
    });
    
    resetTimer();
}

// Sistema de notificaciones
function initNotifications() {
    // Mostrar notificaciones existentes
    showStoredNotifications();
    
    // Simular nuevas notificaciones (en un caso real vendrían del servidor)
    simulateNotifications();
}

function showStoredNotifications() {
    const notifications = JSON.parse(localStorage.getItem('connecthub_notifications') || '[]');
    
    notifications.forEach(notification => {
        showNotification(notification.message, notification.type);
    });
    
    // Limpiar notificaciones mostradas
    localStorage.removeItem('connecthub_notifications');
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background: ${type === 'success' ? '#d4edda' : type === 'error' ? '#f8d7da' : '#d1ecf1'};
        color: ${type === 'success' ? '#155724' : type === 'error' ? '#721c24' : '#0c5460'};
        border: 1px solid ${type === 'success' ? '#c3e6cb' : type === 'error' ? '#f5c6cb' : '#bee5eb'};
        border-radius: 5px;
        z-index: 1000;
        animation: slideIn 0.3s ease-out;
    `;
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Auto-remover después de 5 segundos
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

function simulateNotifications() {
    // Solo simular en páginas específicas
    if (window.location.pathname.includes('dashboard.php')) {
        setTimeout(() => {
            showNotification('¡Bienvenido de nuevo! Tus contactos están actualizados.', 'success');
        }, 2000);
    }
}

// Menú responsive
function initResponsiveMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-nav');
    
    if (menuToggle && mainNav) {
        menuToggle.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }
}

// Utilidad para hacer peticiones AJAX
function makeRequest(url, options = {}) {
    return fetch(url, {
        headers: {
            'Content-Type': 'application/json',
            ...options.headers
        },
        ...options
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .catch(error => {
        console.error('Error en la petición:', error);
        showNotification('Error de conexión. Intenta nuevamente.', 'error');
        throw error;
    });
}

// Formatear fechas
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays === 1) {
        return 'Ayer';
    } else if (diffDays < 7) {
        return `Hace ${diffDays} días`;
    } else {
        return date.toLocaleDateString('es-ES');
    }
}

// Debounce para optimizar eventos
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Copiar al portapapeles
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showNotification('Copiado al portapapeles', 'success');
    }).catch(err => {
        console.error('Error al copiar: ', err);
        showNotification('Error al copiar', 'error');
    });
}

// Exportar funciones globalmente
window.ConnectHub = {
    showNotification,
    formatDate,
    copyToClipboard,
    makeRequest
};

// Estilos CSS para animaciones
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .password-toggle {
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1.2em;
        margin-left: -30px;
    }
    
    .input-error {
        color: #dc3545;
        font-size: 0.85em;
        margin-top: 5px;
    }
    
    @media (max-width: 768px) {
        .menu-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
        }
        
        .main-nav {
            display: none;
        }
        
        .main-nav.active {
            display: flex;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 20px;
        }
    }
`;
document.head.appendChild(style);