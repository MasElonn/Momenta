
document.addEventListener('DOMContentLoaded', () => {

    // 1. SCROLL REVEAL
    const revealElements = document.querySelectorAll(
        '.reveal, .reveal-stagger'
    );

    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15
        });

        revealElements.forEach(element => {
            revealObserver.observe(element);
        });
    } else {
        revealElements.forEach(element => {
            element.classList.add('is-visible');
        });
    }


    // 2. NAVBAR ACTIVE SECTION
    const navLinks = document.querySelectorAll('[data-nav-link]');

    const sections = ['cara-kerja', 'fitur', 'fotografer']
        .map(id => document.getElementById(id))
        .filter(Boolean);

    function setActiveSection(id) {
        navLinks.forEach(link => {
            const isActive = link.getAttribute('href') === `#${id}`;

            link.classList.toggle('is-active', isActive);
            link.classList.toggle('text-brand', isActive);
            link.classList.toggle('text-ink-soft', !isActive);
        });
    }

    if ('IntersectionObserver' in window) {
        const navObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    setActiveSection(entry.target.id);
                }
            });
        }, {
            threshold: 0.4
        });

        sections.forEach(section => {
            navObserver.observe(section);
        });
    }


    // 3. PACKAGE SLIDER
    const slider = document.querySelector('.package-slider');

    if (!slider) return;

    const cards = slider.querySelectorAll('.package-card');
    const previousButton = document.querySelector('[data-slider-prev]');
    const nextButton = document.querySelector('[data-slider-next]');
    const dotsContainer = document.querySelector('[data-slider-dots]');

    let currentIndex = 0;
    let isDragging = false;
    let startX = 0;
    let startScrollLeft = 0;


    // DOTS NAVIGATION
    if (dotsContainer) {
        cards.forEach((_, index) => {
            const dot = document.createElement('button');

            dot.type = 'button';
            dot.setAttribute('aria-label', `Ke paket ${index + 1}`);
            dot.className = 'h-2 w-2 rounded-full bg-line transition-all duration-300';

            dot.addEventListener('click', () => goTo(index));

            dotsContainer.appendChild(dot);
        });
    }


    function updateDots() {
        if (!dotsContainer) return;

        const dots = dotsContainer.querySelectorAll('button');

        dots.forEach((dot, index) => {
            dot.className = index === currentIndex
                ? 'h-2 w-7 rounded-full bg-brand transition-all duration-300'
                : 'h-2 w-2 rounded-full bg-line transition-all duration-300';
        });
    }


    // GET CARD POSITION
    function getCardPosition(index) {
        const card = cards[index];

        if (!card) return 0;

        return card.offsetLeft -
            (slider.clientWidth - card.clientWidth) / 2;
    }


    // MOVE TO CARD
    function goTo(index) {
        if (!cards.length) return;

        currentIndex = Math.max(
            0,
            Math.min(index, cards.length - 1)
        );

        slider.scrollTo({
            left: getCardPosition(currentIndex),
            behavior: 'smooth'
        });

        updateDots();
    }


    // NEXT AND PREVIOUS
    function next() {
        goTo(currentIndex >= cards.length - 1
            ? 0
            : currentIndex + 1
        );
    }

    function previous() {
        goTo(currentIndex <= 0
            ? cards.length - 1
            : currentIndex - 1
        );
    }

    if (previousButton) {
        previousButton.addEventListener('click', previous);
    }

    if (nextButton) {
        nextButton.addEventListener('click', next);
    }


    // 4. DRAG TO SCROLL
    slider.addEventListener('pointerdown', event => {
        if (event.pointerType === 'mouse' && event.button !== 0) return;

        isDragging = true;
        startX = event.clientX;
        startScrollLeft = slider.scrollLeft;

        slider.setPointerCapture(event.pointerId);
        slider.classList.add('cursor-grabbing');
    });

    slider.addEventListener('pointermove', event => {
        if (!isDragging) return;

        const distance = event.clientX - startX;
        slider.scrollLeft = startScrollLeft - distance;
    });

    function endDrag() {
        if (!isDragging) return;

        isDragging = false;
        slider.classList.remove('cursor-grabbing');
    }

    slider.addEventListener('pointerup', endDrag);
    slider.addEventListener('pointercancel', endDrag);


    // 5. INITIAL
    updateDots();

    window.addEventListener('resize', () => {
        goTo(currentIndex);
    });

});
