// Navegación entre secciones
function showSection(sectionName) {
    // Ocultar todas las secciones
    document.querySelectorAll('.chat-area, .content-area').forEach(section => {
        section.style.display = 'none';
    });
    
    // Mostrar la sección seleccionada
    const section = document.getElementById(sectionName + '-section');
    if (section) {
        section.style.display = 'flex';
    }
    
    // Actualizar menú activo
    document.querySelectorAll('.menu-item').forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('data-section') === sectionName) {
            item.classList.add('active');
        }
    });
    
    // Cerrar menú en móviles
    document.querySelector('.sidebar').classList.remove('open');
}

// Tabs en sección de amigos
function setupFriendTabs() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            
            // Remover active de todos los tabs
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Activar tab clickeado
            this.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        });
    });
}

// Búsqueda de usuarios
function setupSearch() {
    const searchBtn = document.getElementById('search-btn');
    const searchInput = document.getElementById('user-search');
    
    function performSearch() {
        const query = searchInput.value.trim();
        const resultsContainer = document.getElementById('search-results');
        
        if (query.length < 3) {
            resultsContainer.innerHTML = `
                <div class="empty-state">
                    <div class="empty-icon">🔍</div>
                    <h3>Ingresa al menos 3 caracteres</h3>
                    <p>Escribe el nombre de usuario que buscas</p>
                </div>
            `;
            return;
        }
        
        // Simular búsqueda (en una app real, harías una petición AJAX)
        resultsContainer.innerHTML = `
            <div class="search-result-item">
                <img src="https://via.placeholder.com/50" alt="Usuario" class="search-result-avatar">
                <div class="search-result-info">
                    <div class="search-result-name">Usuario Ejemplo</div>
                    <div class="search-result-username">@${query}</div>
                </div>
                <div class="search-result-actions">
                    <button class="btn btn-primary send-request">Enviar solicitud</button>
                </div>
            </div>
            <div class="empty-state">
                <p>Estos son resultados de ejemplo. En una implementación real, se conectaría con la base de datos.</p>
            </div>
        `;
    }
    
    searchBtn.addEventListener('click', performSearch);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });
}

// Modales
function setupModals() {
    // Modal de cambiar contraseña
    const passwordModal = document.getElementById('password-modal');
    const changePasswordBtn = document.getElementById('change-password-btn');
    const passwordForm = document.getElementById('password-form');
    
    changePasswordBtn.addEventListener('click', function() {
        passwordModal.style.display = 'flex';
    });
    
    // Modal de eliminar cuenta
    const deleteModal = document.getElementById('delete-modal');
    const deleteAccountBtn = document.getElementById('delete-account-btn');
    const deleteForm = document.getElementById('delete-form');
    
    deleteAccountBtn.addEventListener('click', function() {
        deleteModal.style.display = 'flex';
    });
    
    // Cerrar modales
    document.querySelectorAll('.modal-close, .modal-cancel').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.modal').forEach(modal => {
                modal.style.display = 'none';
            });
        });
    });
    
    // Enviar formularios de modales
    passwordForm.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Funcionalidad de cambiar contraseña - En desarrollo');
        passwordModal.style.display = 'none';
    });
    
    deleteForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const password = this.querySelector('input[name="confirm_password"]').value;
        if (password) {
            if (confirm('¿ESTÁS ABSOLUTAMENTE SEGURO? Esta acción no se puede deshacer.')) {
                alert('Funcionalidad de eliminar cuenta - En desarrollo');
                deleteModal.style.display = 'none';
            }
        }
    });
}

// Acciones de amigos
function setupFriendActions() {
    // Chatear con amigo
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('chat-with-friend') || 
            e.target.classList.contains('chat-featured')) {
            const friendItem = e.target.closest('.friend-item, .featured-item');
            const userId = friendItem.getAttribute('data-user-id');
            alert(`Iniciar chat con usuario ${userId} - En desarrollo`);
            showSection('messages');
        }
        
        // Bloquear amigo
        if (e.target.classList.contains('block-friend')) {
            const friendItem = e.target.closest('.friend-item');
            const userId = friendItem.getAttribute('data-user-id');
            if (confirm('¿Bloquear a este usuario?')) {
                alert(`Usuario ${userId} bloqueado - En desarrollo`);
            }
        }
        
        // Eliminar amigo
        if (e.target.classList.contains('remove-friend') || 
            e.target.classList.contains('remove-featured')) {
            const item = e.target.closest('.friend-item, .featured-item');
            const userId = item.getAttribute('data-user-id');
            if (confirm('¿Eliminar de amigos/destacados?')) {
                alert(`Usuario ${userId} eliminado - En desarrollo`);
            }
        }
        
        // Aceptar/rechazar solicitudes
        if (e.target.classList.contains('accept-request')) {
            const requestItem = e.target.closest('.request-item');
            const userId = requestItem.getAttribute('data-user-id');
            alert(`Solicitud de ${userId} aceptada - En desarrollo`);
        }
        
        if (e.target.classList.contains('decline-request')) {
            const requestItem = e.target.closest('.request-item');
            const userId = requestItem.getAttribute('data-user-id');
            alert(`Solicitud de ${userId} rechazada - En desarrollo`);
        }
        
        // Desbloquear usuario
        if (e.target.classList.contains('unblock-user')) {
            const blockedItem = e.target.closest('.blocked-item');
            const userId = blockedItem.getAttribute('data-user-id');
            if (confirm('¿Desbloquear a este usuario?')) {
                alert(`Usuario ${userId} desbloqueado - En desarrollo`);
            }
        }
    });
}

// Inicialización cuando el DOM está listo
document.addEventListener('DOMContentLoaded', function() {
    // Menú toggle
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.querySelector('.sidebar');
    
    if (menuToggle && sidebar) {
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('open');
        });
    }
    
    // Navegación del menú principal
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', function() {
            const section = this.getAttribute('data-section');
            showSection(section);
        });
    });
    
    // Configurar funcionalidades
    setupFriendTabs();
    setupSearch();
    setupModals();
    setupFriendActions();
    
    // Mostrar sección de mensajes por defecto
    showSection('messages');
    
    // Envío de mensajes (simulación)
    const sendButton = document.querySelector('.send-button');
    const messageInput = document.querySelector('.message-input');
    
    if (sendButton && messageInput) {
        sendButton.addEventListener('click', sendMessage);
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
});

// Función para enviar mensajes
function sendMessage() {
    const messageInput = document.querySelector('.message-input');
    const message = messageInput.value.trim();
    
    if (message) {
        addMessageToChat(message, true);
        messageInput.value = '';
        
        // Simular respuesta después de 1 segundo
        setTimeout(() => {
            const responses = [
                "¡Hola! ¿Cómo estás?",
                "Interesante, cuéntame más",
                "Estoy de acuerdo contigo",
                "¿En qué puedo ayudarte?"
            ];
            const randomResponse = responses[Math.floor(Math.random() * responses.length)];
            addMessageToChat(randomResponse, false);
        }, 1000);
    }
}

// Función para agregar mensajes al chat
function addMessageToChat(message, isSent) {
    const messagesContainer = document.querySelector('.messages-container');
    if (messagesContainer) {
        // Ocultar mensaje de bienvenida si existe
        const welcomeMessage = messagesContainer.querySelector('.welcome-message');
        if (welcomeMessage) {
            welcomeMessage.style.display = 'none';
        }
        
        // Mostrar input de mensajes si está oculto
        const messageInputContainer = document.querySelector('.message-input-container');
        if (messageInputContainer) {
            messageInputContainer.style.display = 'flex';
        }
        
        const messageElement = document.createElement('div');
        messageElement.className = `message ${isSent ? 'sent' : 'received'}`;
        
        const now = new Date();
        const timeString = `${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;
        
        messageElement.innerHTML = `
            <div class="message-bubble">
                <div class="message-text">${message}</div>
                <div class="message-time">${timeString}</div>
            </div>
        `;
        
        messagesContainer.appendChild(messageElement);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }
}