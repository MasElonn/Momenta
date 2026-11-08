document.addEventListener('DOMContentLoaded', () => {
    const revealElements = document.querySelectorAll('.reveal, .reveal-stagger');

    if (!('IntersectionObserver' in window)) {
        revealElements.forEach(element => {
            element.classList.add('is-visible');
        });
    } else {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(element => {
            revealObserver.observe(element);
        });
    }

    const sections = ['beranda', 'cara-kerja', 'fitur', 'fotografer']
        .map(id => document.getElementById(id))
        .filter(Boolean);

    const navLinks = document.querySelectorAll('[data-nav-link]');

    function setActiveNavigation(id) {
        navLinks.forEach(link => {
            const active = link.getAttribute('href') === `#${id}`;

            link.classList.toggle('text-brand', active);
            link.classList.toggle('font-medium', active);
            link.classList.toggle('text-ink-soft', !active);
        });
    }

    if ('IntersectionObserver' in window) {
        const navigationObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setActiveNavigation(entry.target.id);
                }
            });
        }, {
            threshold: 0,
            rootMargin: '-25% 0px -65% 0px'
        });

        sections.forEach(section => {
            navigationObserver.observe(section);
        });
    }
});