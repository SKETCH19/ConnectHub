// Header scroll effect
window.addEventListener('scroll', () => {
    const header = document.getElementById('header');
    header.classList.toggle('scrolled', window.scrollY > 100);
});

// Mobile menu toggle
const mobileToggle = document.getElementById('mobileToggle');
const mainMenu = document.getElementById('mainMenu');

mobileToggle.addEventListener('click', (e) => {
    e.stopPropagation();
    mainMenu.classList.toggle('active');
    const icon = mobileToggle.querySelector('i');
    icon.classList.toggle('fa-bars');
    icon.classList.toggle('fa-times');
});

// Close mobile menu when clicking outside (but not when clicking inside menu)
document.addEventListener('click', (event) => {
    if (!event.target.closest('#mainMenu') && !event.target.closest('#mobileToggle')) {
        mainMenu.classList.remove('active');
        const icon = mobileToggle.querySelector('i');
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-times');
    }
});

// Close menu on Escape key
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        mainMenu.classList.remove('active');
        const icon = mobileToggle.querySelector('i');
        icon.classList.add('fa-bars');
        icon.classList.remove('fa-times');
    }
});

// Smooth scroll when clicking menu links
document.querySelectorAll('.main-menu ul li a').forEach(link => {
    link.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
            mainMenu.classList.remove('active');
            const icon = mobileToggle.querySelector('i');
            icon.classList.add('fa-bars');
            icon.classList.remove('fa-times');
        }
    });
});

// Hover effect (desktop only)
const menuItems = document.querySelectorAll('.main-menu ul li a');
menuItems.forEach(item => {
    item.addEventListener('mouseenter', () => {
        item.style.transform = 'translateY(-2px)';
    });
    item.addEventListener('mouseleave', () => {
        item.style.transform = 'translateY(0)';
    });
});

// Footer widget animation on scroll
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
});

document.querySelectorAll('.single-footer-widget').forEach(widget => {
    widget.style.opacity = '0';
    widget.style.transform = 'translateY(30px)';
    widget.style.transition = 'all 0.6s ease';
    observer.observe(widget);
});

// Fade in body on load
window.addEventListener('load', () => {
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease';
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);
});

// Dynamic copyright year
document.addEventListener('DOMContentLoaded', () => {
    const yearElement = document.querySelector('.copyright-text script');
    if (yearElement) {
        yearElement.parentNode.innerHTML = yearElement.parentNode.innerHTML.replace(
            '<script>document.write(new Date().getFullYear());</script>',
            new Date().getFullYear()
        );
    }
});
