// filepath: /Users/nikolakalcic/Documents/git/WP-loophaus/assets/js/main.js

document.addEventListener('DOMContentLoaded', function() {
    console.log('Main JS loaded');

    // Smooth Scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    // Sticky Header
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.site-header');
        if (window.scrollY > 50) {
            header.classList.add('sticky');
        } else {
            header.classList.remove('sticky');
        }
    });

    // Back to Top Button
    const backToTopButton = document.querySelector('.back-to-top');
    if (backToTopButton) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // Form Validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(event) {
            const email = form.querySelector('input[type="email"]');
            if (email && !email.value.includes('@')) {
                event.preventDefault();
                alert('Please enter a valid email address.');
            }
        });
    }

    // Modal Popup
    const modal = document.querySelector('.modal');
    const openModalButton = document.querySelector('.open-modal');
    const closeModalButton = document.querySelector('.close-modal');

    if (modal && openModalButton && closeModalButton) {
        openModalButton.addEventListener('click', () => {
            modal.classList.add('show');
        });

        closeModalButton.addEventListener('click', () => {
            modal.classList.remove('show');
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('show');
            }
        });
    }
});