/**
 * Momenta — Animasi landing page (scroll reveal + navbar aktif)
 *
 * File ini JS biasa (bukan Blade/inline script), jadi dipisah dari app.js
 * supaya nggak ribet. Tinggal import di resources/js/app.js:
 *
 *   import "./momenta-animations.js";
 *
 * (taruh file ini di folder yang sama dengan app.js, misal resources/js/)
 */

document.addEventListener('DOMContentLoaded', function () {
    // --- Reveal animasi saat elemen masuk viewport ---
    var revealEls = document.querySelectorAll('.reveal, .reveal-stagger');

    if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15, rootMargin: '0px 0px -60px 0px' });

        revealEls.forEach(function (el) { observer.observe(el); });
    } else {
        // Fallback kalau browser nggak support IntersectionObserver
        revealEls.forEach(function (el) { el.classList.add('is-visible'); });
    }

    // --- Highlight link navbar sesuai section yang lagi keliatan ---
    var navLinks = document.querySelectorAll('[data-nav-link]');
    var sections = ['cara-kerja', 'fitur', 'harga']
        .map(function (id) { return document.getElementById(id); })
        .filter(Boolean);

    function setActive(id) {
        navLinks.forEach(function (link) {
            var isActive = link.getAttribute('href') === '#' + id;
            link.classList.toggle('is-active', isActive);
            link.classList.toggle('text-brand', isActive);
            link.classList.toggle('text-ink-soft', !isActive);
        });
    }

    if ('IntersectionObserver' in window && sections.length) {
        var navObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) setActive(entry.target.id);
            });
        }, { threshold: 0.4 });

        sections.forEach(function (sec) { navObserver.observe(sec); });
    }
});