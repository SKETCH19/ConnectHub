document.addEventListener('DOMContentLoaded', function() {
    // Navegación entre secciones
    const navLinks = document.querySelectorAll('.admin-nav a');
    const sections = document.querySelectorAll('.admin-section');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remover clase active de todos los links
            navLinks.forEach(navLink => {
                navLink.parentElement.classList.remove('active');
            });
            
            // Agregar clase active al link clickeado
            this.parentElement.classList.add('active');
            
            // Ocultar todas las secciones
            sections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Mostrar la sección correspondiente
            const target = this.getAttribute('href').substring(1);
            document.getElementById(target).style.display = 'block';
        });
    });
    
    // Pestañas de configuración
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remover clase active de todos los botones
            tabBtns.forEach(tabBtn => {
                tabBtn.classList.remove('active');
            });
            
            // Agregar clase active al botón clickeado
            this.classList.add('active');
            
            // Ocultar todos los contenidos
            tabContents.forEach(content => {
                content.classList.remove('active');
            });
            
            // Mostrar el contenido correspondiente
            const target = this.getAttribute('data-tab');
            document.getElementById(target).classList.add('active');
        });
    });
    
    // Modal de habitaciones
    const modal = document.getElementById('habitacionModal');
    const btnAdd = document.getElementById('btnAddHabitacion');
    const closeModal = document.querySelector('.close-modal');
    
    btnAdd.addEventListener('click', function() {
        modal.classList.add('active');
        document.getElementById('modalTitle').textContent = 'Agregar Nueva Habitación';
        document.getElementById('habitacionForm').reset();
    });
    
    closeModal.addEventListener('click', function() {
        modal.classList.remove('active');
    });
    
    window.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });
    
    // Botones de editar y eliminar
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const cells = row.querySelectorAll('td');
            
            document.getElementById('modalTitle').textContent = 'Editar Habitación';
            document.getElementById('numero').value = cells[1].textContent;
            document.getElementById('tipo').value = cells[2].textContent.toLowerCase();
            document.getElementById('piso').value = cells[3].textContent;
            document.getElementById('precio').value = cells[5].textContent.replace('$', '');
            
            modal.classList.add('active');
        });
    });
    
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm('¿Estás seguro de que deseas eliminar esta habitación?')) {
                const row = this.closest('tr');
                row.remove();
                showToast('Habitación eliminada correctamente', 'success');
            }
        });
    });
    
    // Formulario de habitación
    const habitacionForm = document.getElementById('habitacionForm');
    
    habitacionForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Aqui va la lógica para guardar los datos
        // Solo se creo el modal y mostramos un mensaje
        modal.classList.remove('active');
        showToast('Habitación guardada correctamente', 'success');
    });
    
    // Generar gráficos
    const ocupacionCtx = document.getElementById('ocupacionChart');
    const ingresosCtx = document.getElementById('ingresosChart');
    
    if (ocupacionCtx && ingresosCtx) {
        // Gráfico de ocupación mensual
        new Chart(ocupacionCtx, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Ocupación %',
                    data: [65, 59, 80, 81, 56, 55, 40, 75, 82, 90, 85, 78],
                    backgroundColor: 'rgba(212, 175, 55, 0.7)',
                    borderColor: 'rgba(212, 175, 55, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
        
        // Gráfico de ingresos por temporada
        new Chart(ingresosCtx, {
            type: 'line',
            data: {
                labels: ['Baja', 'Media', 'Alta', 'Festiva'],
                datasets: [{
                    label: 'Ingresos ($)',
                    data: [12000, 24000, 35000, 42000],
                    backgroundColor: 'rgba(44, 62, 80, 0.1)',
                    borderColor: 'rgba(44, 62, 80, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true
            }
        });
    }
    
    // Botones de reportes
    document.querySelectorAll('.btn-report').forEach(btn => {
        btn.addEventListener('click', function() {
            const reportType = this.textContent.trim();
            const placeholder = document.querySelector('.report-placeholder p');
            
            placeholder.textContent = `Generando reporte: ${reportType}...`;
            
            // Generación de reporte
            setTimeout(() => {
                showToast(`Reporte ${reportType} generado con éxito`, 'success');
                placeholder.textContent = `Vista previa del reporte: ${reportType}`;
            }, 1500);
        });
    });
    
    // Mostrar notificaciones
    function showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.textContent = message;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }
    
    // Mostrar sección dashboard por defecto
    document.getElementById('dashboard').style.display = 'block';
});