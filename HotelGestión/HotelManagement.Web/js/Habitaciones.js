document.addEventListener('DOMContentLoaded', function() {
    // Datos de las habitaciones
    const roomsData = [
        {
            id: 1,
            type: "standard",
            name: "Habitación Standard",
            price: 99,
            image: "img/room/rooms-1.jpg",
            badge: "Popular",
            features: [
                { icon: "fa-tv", text: "Smart TV" },
                { icon: "fa-wifi", text: "WiFi Gratis" },
                { icon: "fa-snowflake", text: "Aire Acondicionado" }
            ],
            description: "Cómoda habitación ideal para viajeros individuales o parejas, con todas las comodidades básicas para una estancia agradable.",
            gallery: ["img/room/standard-1.jpg", "img/room/standard-2.jpg", "img/room/standard-3.jpg"],
            seasonalPrices: {
                low: 80,
                medium: 99,
                high: 120
            }
        },
        {
            id: 2,
            type: "double",
            name: "Habitación Doble",
            price: 179,
            image: "img/room/rooms-3.jpg",
            features: [
                { icon: "fa-tv", text: "Smart TV" },
                { icon: "fa-wifi", text: "WiFi Gratis" },
                { icon: "fa-snowflake", text: "Aire Acondicionado" },
                { icon: "fa-car", text: "Parking Gratis" }
            ],
            description: "Amplia habitación con dos camas queen size, perfecta para amigos o familias pequeñas que buscan comodidad y espacio.",
            gallery: ["img/room/double-1.jpg", "img/room/double-2.jpg", "img/room/double-3.jpg"],
            seasonalPrices: {
                low: 150,
                medium: 179,
                high: 210
            }
        },
        {
            id: 3,
            type: "suite",
            name: "Junior Suite",
            price: 252,
            image: "img/room/rooms-4.jpg",
            badge: "Lujo",
            features: [
                { icon: "fa-tv", text: "Smart TV" },
                { icon: "fa-wifi", text: "WiFi Gratis" },
                { icon: "fa-snowflake", text: "Aire Acondicionado" },
                { icon: "fa-car", text: "Parking Gratis" },
                { icon: "fa-umbrella-beach", text: "Acceso a Piscina" }
            ],
            description: "Elegante suite con área de estar separada y amenities premium, diseñada para quienes buscan una experiencia de lujo durante su estadía.",
            gallery: ["img/room/suite-1.jpg", "img/room/suite-2.jpg", "img/room/suite-3.jpg"],
            seasonalPrices: {
                low: 220,
                medium: 252,
                high: 290
            }
        }
    ];

    // Elementos del DOM
    const roomsGrid = document.getElementById('rooms-grid');
    const priceTableBody = document.querySelector('.pricing-table tbody');
    const roomSearch = document.getElementById('room-search');
    const priceFilter = document.getElementById('price-filter');
    const typeFilter = document.getElementById('type-filter');
    const galleryModal = document.getElementById('galleryModal');
    const modalRoomTitle = document.getElementById('modal-room-title');
    const modal360View = document.getElementById('360-view-container');
    const closeModal = document.querySelector('.close');

    // Cargar habitaciones
    function loadRooms(rooms) {
        roomsGrid.innerHTML = '';
        
        rooms.forEach(room => {
            const roomCard = document.createElement('div');
            roomCard.className = 'room-item';
            roomCard.dataset.price = room.price;
            roomCard.dataset.type = room.type;
            
            let featuresHTML = '';
            room.features.forEach(feature => {
                featuresHTML += `<span><i class="fas ${feature.icon}"></i> ${feature.text}</span>`;
            });
            
            let badgeHTML = '';
            if (room.badge) {
                badgeHTML = `<div class="room-badge">${room.badge}</div>`;
            }
            
            roomCard.innerHTML = `
                <div class="room-card">
                    <div class="room-image">
                        <img src="${room.image}" alt="${room.name}">
                        ${badgeHTML}
                        <div class="room-price">Desde $${room.price}<span>/noche</span></div>
                    </div>
                    <div class="room-content">
                        <h3>${room.name}</h3>
                        <div class="room-features">
                            ${featuresHTML}
                        </div>
                        <p>${room.description}</p>
                        <div class="room-actions">
                            <a href="#" class="view-gallery" data-room-id="${room.id}">
                                <i class="fas fa-images"></i> Galería 360°
                            </a>
                            <a href="Reservas.php?room=${room.type}" class="book-now">
                                Reservar <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            `;
            
            roomsGrid.appendChild(roomCard);
        });
        
        // Event listeners para galería
        document.querySelectorAll('.view-gallery').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const roomId = parseInt(this.dataset.roomId);
                openGalleryModal(roomId);
            });
        });
    }

    // Cargar tabla de precios
    function loadPriceTable(rooms) {
        priceTableBody.innerHTML = '';
        
        rooms.forEach(room => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${room.name}</td>
                <td>$${room.seasonalPrices.low}</td>
                <td>$${room.seasonalPrices.medium}</td>
                <td>$${room.seasonalPrices.high}</td>
            `;
            priceTableBody.appendChild(row);
        });
    }

    // Filtrar habitaciones
    function filterRooms() {
        const searchTerm = roomSearch.value.toLowerCase();
        const priceRange = priceFilter.value;
        const typeValue = typeFilter.value;
        
        const filteredRooms = roomsData.filter(room => {
            // Filtrar por búsqueda
            const matchesSearch = room.name.toLowerCase().includes(searchTerm) || 
                                 room.description.toLowerCase().includes(searchTerm);
            
            // Filtrar por rango de precio
            let matchesPrice = true;
            if (priceRange !== 'all') {
                const [min, max] = priceRange.split('-').map(Number);
                if (max) {
                    matchesPrice = room.price >= min && room.price <= max;
                } else {
                    matchesPrice = room.price >= min;
                }
            }
            
            // Filtrar por tipo
            const matchesType = typeValue === 'all' || room.type === typeValue;
            
            return matchesSearch && matchesPrice && matchesType;
        });
        
        loadRooms(filteredRooms);
    }

    // Abrir modal de galería
    function openGalleryModal(roomId) {
        const room = roomsData.find(r => r.id === roomId);
        if (!room) return;
        
        modalRoomTitle.textContent = `Galería - ${room.name}`;
        modal360View.innerHTML = `
            <div class="gallery-slider">
                ${room.gallery.map(img => `<img src="${img}" alt="${room.name}">`).join('')}
            </div>
        `;
        
        galleryModal.style.display = 'block';
    }

    // Cerrar modal
    function closeGalleryModal() {
        galleryModal.style.display = 'none';
    }

    
    roomSearch.addEventListener('input', filterRooms);
    priceFilter.addEventListener('change', filterRooms);
    typeFilter.addEventListener('change', filterRooms);
    closeModal.addEventListener('click', closeGalleryModal);
    window.addEventListener('click', function(e) {
        if (e.target === galleryModal) {
            closeGalleryModal();
        }
    });

    // Iniciar
    loadRooms(roomsData);
    loadPriceTable(roomsData);
});