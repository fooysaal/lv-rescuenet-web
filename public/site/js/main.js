// RescueNet - Main Application JavaScript
// Language Toggle & Interactive Features

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

        // Update toggle button text (for landing page structure)
        const langText = document.getElementById('langText');
        const langTextEn = document.getElementById('langTextEn');
        const langTextMobile = document.getElementById('langTextMobile');
        const langTextEnMobile = document.getElementById('langTextEnMobile');

        if (langText) langText.textContent = 'EN';
        if (langTextEn) langTextEn.textContent = 'বাংলা';
        if (langTextMobile) langTextMobile.textContent = 'EN';
        if (langTextEnMobile) langTextEnMobile.textContent = 'বাংলা';
    } else {
        // Show English, hide Bangla
        bnElements.forEach(el => {
            el.classList.add('lang-hidden');
        });
        enElements.forEach(el => {
            el.classList.remove('lang-hidden');
            el.classList.add('lang-fade');
        });

        // Update toggle button text (for landing page structure)
        const langText = document.getElementById('langText');
        const langTextEn = document.getElementById('langTextEn');
        const langTextMobile = document.getElementById('langTextMobile');
        const langTextEnMobile = document.getElementById('langTextEnMobile');

        if (langText) langText.textContent = 'বাংলা';
        if (langTextEn) langTextEn.textContent = 'EN';
        if (langTextMobile) langTextMobile.textContent = 'বাংলা';
        if (langTextEnMobile) langTextEnMobile.textContent = 'English';
    }

    // Store preference
    localStorage.setItem('rescuenet_lang', currentLang);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function () {
    console.log('RescueNet Main.js loaded');

    // Get all elements
    const enElements = document.querySelectorAll('.lang-en');
    const bnElements = document.querySelectorAll('.lang-bn');

    // CRITICAL: Ensure Bengali content is hidden by default on initial load
    // This prevents both languages from showing simultaneously
    bnElements.forEach(el => {
        if (!el.classList.contains('lang-hidden')) {
            el.classList.add('lang-hidden');
        }
    });

    // Check for saved language preference on page load
    const savedLang = localStorage.getItem('rescuenet_lang');
    if (savedLang) {
        currentLang = savedLang;

        // Apply the saved language
        if (currentLang === 'bn') {
            enElements.forEach(el => el.classList.add('lang-hidden'));
            bnElements.forEach(el => el.classList.remove('lang-hidden'));

            // Update button texts for landing page
            const langText = document.getElementById('langText');
            const langTextEn = document.getElementById('langTextEn');
            const langTextMobile = document.getElementById('langTextMobile');
            const langTextEnMobile = document.getElementById('langTextEnMobile');

            if (langText) langText.textContent = 'EN';
            if (langTextEn) langTextEn.textContent = 'বাংলা';
            if (langTextMobile) langTextMobile.textContent = 'EN';
            if (langTextEnMobile) langTextEnMobile.textContent = 'বাংলা';
        } else {
            // English is already showing, just ensure Bengali is hidden
            bnElements.forEach(el => el.classList.add('lang-hidden'));
            enElements.forEach(el => el.classList.remove('lang-hidden'));

            // Update button texts for landing page
            const langText = document.getElementById('langText');
            const langTextEn = document.getElementById('langTextEn');
            const langTextMobile = document.getElementById('langTextMobile');
            const langTextEnMobile = document.getElementById('langTextEnMobile');

            if (langText) langText.textContent = 'বাংলা';
            if (langTextEn) langTextEn.textContent = 'EN';
            if (langTextMobile) langTextMobile.textContent = 'বাংলা';
            if (langTextEnMobile) langTextEnMobile.textContent = 'English';
        }
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

    // Mobile menu toggle
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
});
