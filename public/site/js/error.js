// RescueNet - Error Pages JavaScript
// Language Toggle & Mobile Menu for Error Pages

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
    } else {
        // Show English, hide Bangla
        bnElements.forEach(el => {
            el.classList.add('lang-hidden');
        });
        enElements.forEach(el => {
            el.classList.remove('lang-hidden');
            el.classList.add('lang-fade');
        });
    }

    // Store preference
    localStorage.setItem('rescuenet_lang', currentLang);
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function () {
    console.log('RescueNet Error.js loaded');

    // Get all elements
    const enElements = document.querySelectorAll('.lang-en');
    const bnElements = document.querySelectorAll('.lang-bn');

    // CRITICAL: Ensure Bengali content is hidden by default on initial load
    bnElements.forEach(el => {
        if (!el.classList.contains('lang-hidden')) {
            el.classList.add('lang-hidden');
        }
    });

    // Check for saved language preference
    const savedLang = localStorage.getItem('rescuenet_lang');
    if (savedLang) {
        currentLang = savedLang;

        // Apply the saved language
        if (currentLang === 'bn') {
            enElements.forEach(el => el.classList.add('lang-hidden'));
            bnElements.forEach(el => el.classList.remove('lang-hidden'));
        } else {
            bnElements.forEach(el => el.classList.add('lang-hidden'));
            enElements.forEach(el => el.classList.remove('lang-hidden'));
        }
    }

    // Language toggle button click handlers
    const langToggle = document.getElementById('langToggle');
    const langToggleMobile = document.getElementById('langToggleMobile');

    if (langToggle) {
        langToggle.addEventListener('click', function (e) {
            e.preventDefault();
            toggleLanguage();
        });
    }

    if (langToggleMobile) {
        langToggleMobile.addEventListener('click', function (e) {
            e.preventDefault();
            toggleLanguage();
        });
    }

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function (e) {
            e.preventDefault();
            mobileMenu.classList.toggle('hidden');
        });
    }
});
