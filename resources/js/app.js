import './bootstrap';

// Language Toggle Functionality
let currentLang = 'en'; // Default language

function toggleLanguage() {
    currentLang = currentLang === 'en' ? 'bn' : 'en';

    // Get all English and Bangla elements
    const enElements = document.querySelectorAll('.lang-en');
    const bnElements = document.querySelectorAll('.lang-bn');

    if (currentLang === 'bn') {
        // Show Bangla, hide English
        enElements.forEach(el => {
            el.classList.add('lang-hidden');
        });
        bnElements.forEach(el => {
            el.classList.remove('lang-hidden');
            el.classList.add('lang-fade');
        });

        // Update toggle button text
        document.getElementById('langText').textContent = 'EN';
        document.getElementById('langTextEn').textContent = 'বাংলা';
        document.getElementById('langTextMobile').textContent = 'EN';
        document.getElementById('langTextEnMobile').textContent = 'বাংলা';
    } else {
        // Show English, hide Bangla
        bnElements.forEach(el => {
            el.classList.add('lang-hidden');
        });
        enElements.forEach(el => {
            el.classList.remove('lang-hidden');
            el.classList.add('lang-fade');
        });

        // Update toggle button text
        document.getElementById('langText').textContent = 'বাংলা';
        document.getElementById('langTextEn').textContent = 'EN';
        document.getElementById('langTextMobile').textContent = 'বাংলা';
        document.getElementById('langTextEnMobile').textContent = 'EN';
    }

    // Store preference
    localStorage.setItem('rescuenet_lang', currentLang);
}

// RescueNet Landing Page Interactive Features
document.addEventListener('DOMContentLoaded', function () {
    // Check for saved language preference
    const savedLang = localStorage.getItem('rescuenet_lang');
    if (savedLang && savedLang === 'bn') {
        toggleLanguage(); // Switch to Bangla if it was previously selected
    }

    // Language toggle button click handlers
    const langToggle = document.getElementById('langToggle');
    const langToggleMobile = document.getElementById('langToggleMobile');

    if (langToggle) {
        langToggle.addEventListener('click', toggleLanguage);
    }

    if (langToggleMobile) {
        langToggleMobile.addEventListener('click', toggleLanguage);
    }

    // Mobile menu toggle (if needed in future)
    const mobileMenuButton = document.querySelector('[data-mobile-menu-toggle]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const targetId = this.getAttribute('href');
            if (targetId === '#' || targetId === '#download') return;

            e.preventDefault();
            const target = document.querySelector(targetId);
            if (target) {
                const offset = 80; // Account for fixed header
                const targetPosition = target.offsetTop - offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    });

    // Add scroll animation to navbar
    const navbar = document.querySelector('nav');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 100) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }

        lastScroll = currentScroll;
    });

    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in');
            }
        });
    }, observerOptions);

    // Observe feature cards and sections
    document.querySelectorAll('.feature-card, .workflow-step').forEach(el => {
        observer.observe(el);
    });
});
