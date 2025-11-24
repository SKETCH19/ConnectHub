// messages.js - Manejo de mensajes en tiempo real
document.addEventListener('DOMContentLoaded', function() {
    const userItems = document.querySelectorAll('.user-item');
    const chatMessages = document.getElementById('chatMessages');
    const chatInput = document.querySelector('.chat-input');
    const messageForm = document.getElementById('messageForm');
    const receiverIdInput = document.getElementById('receiverId');
    const messageInput = document.getElementById('messageInput');
    
    let currentReceiverId = null;
    let currentUserId = null;
    
    // Obtener el user_id desde el HTML (lo agregaremos en dashboard.php)
    const userIdElement = document.getElementById('currentUserId');
    if (userIdElement) {
        currentUserId = userIdElement.value;
    }
    
    // Seleccionar usuario para chatear
    userItems.forEach(item => {
        item.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            const userName = this.querySelector('span').textContent;
            
            // Remover clase active de todos
            userItems.forEach(u => u.classList.remove('active'));
            // Agregar clase active al seleccionado
            this.classList.add('active');
            
            // Actualizar interfaz
            currentReceiverId = userId;
            receiverIdInput.value = userId;
            chatInput.style.display = 'block';
            
            document.querySelector('.chat-header h3').textContent = `Chat con ${userName}`;
            
            // Cargar mensajes
            loadMessages(userId);
        });
    });
    
    // Enviar mensaje
    messageForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!currentReceiverId) {
            alert('Selecciona un contacto primero');
            return;
        }
        
        const message = messageInput.value.trim();
        if (!message) return;
        
        // Enviar mensaje via AJAX
        sendMessage(currentReceiverId, message);
        messageInput.value = '';
    });
    
    function loadMessages(receiverId) {
        fetch(`get_messages.php?receiver_id=${receiverId}`)
            .then(response => response.json())
            .then(messages => {
                chatMessages.innerHTML = '';
                messages.forEach(msg => {
                    const messageDiv = document.createElement('div');
                    // Usar currentUserId en lugar de PHP
                    const messageClass = msg.sender_id == currentUserId ? 'sent' : 'received';
                    messageDiv.className = `message ${messageClass}`;
                    messageDiv.innerHTML = `
                        <div class="message-content">${escapeHtml(msg.message)}</div>
                        <div class="message-time">${formatTime(msg.created_at)}</div>
                    `;
                    chatMessages.appendChild(messageDiv);
                });
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => console.error('Error:', error));
    }
    
    function sendMessage(receiverId, message) {
        const formData = new FormData();
        formData.append('receiver_id', receiverId);
        formData.append('message', message);
        
        fetch('send_message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadMessages(receiverId);
            } else {
                alert('Error al enviar mensaje: ' + (data.error || 'Error desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error de conexión al enviar mensaje');
        });
    }
    
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    function formatTime(dateString) {
        const date = new Date(dateString);
        return date.toLocaleTimeString('es-ES', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
    }
    
    // Recargar mensajes cada 5 segundos
    setInterval(() => {
        if (currentReceiverId) {
            loadMessages(currentReceiverId);
        }
    }, 5000);
});