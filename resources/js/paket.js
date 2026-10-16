/*
 * Momenta
 * Landing page animations + package slider
 */

document.addEventListener('DOMContentLoaded', function () {

    // =====================================================
    // SCROLL REVEAL
    // =====================================================

    const revealEls = document.querySelectorAll(
        '.reveal, .reveal-stagger'
    );

    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            {
                threshold: 0.15,
                rootMargin: '0px 0px -60px 0px'
            }
        );

        revealEls.forEach(function (el) {
            observer.observe(el);
        });
    } else {
        revealEls.forEach(function (el) {
            el.classList.add('is-visible');
        });
    }


    // =====================================================
    // NAVBAR ACTIVE SECTION
    // =====================================================

    const navLinks = document.querySelectorAll('[data-nav-link]');

    const sections = [
        'cara-kerja',
        'fitur',
        'harga'
    ]
        .map(function (id) {
            return document.getElementById(id);
        })
        .filter(Boolean);

    function setActive(id) {
        navLinks.forEach(function (link) {
            const isActive =
                link.getAttribute('href') === '#' + id;

            link.classList.toggle('is-active', isActive);
            link.classList.toggle('text-brand', isActive);
            link.classList.toggle('text-ink-soft', !isActive);
        });
    }

    if (
        'IntersectionObserver' in window &&
        sections.length
    ) {
        const navObserver = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        setActive(entry.target.id);
                    }
                });
            },
            {
                threshold: 0.4
            }
        );

        sections.forEach(function (section) {
            navObserver.observe(section);
        });
    }


    // =====================================================
    // PACKAGE SLIDER
    // =====================================================

    const slider = document.querySelector('.package-slider');

    if (!slider) {
        return;
    }

    const cards = slider.querySelectorAll('.package-card');

    const previousButton =
        document.querySelector('[data-slider-prev]');

    const nextButton =
        document.querySelector('[data-slider-next]');

    const dotsContainer =
        document.querySelector('[data-slider-dots]');

    let currentIndex = 0;
    let isDragging = false;

    let startX = 0;
    let startScrollLeft = 0;

    let velocity = 0;
    let lastX = 0;
    let lastTime = 0;

    let animationFrame = null;
    let autoSlideTimer = null;

    // =====================================================
    // DOTS
    // =====================================================

    if (dotsContainer && cards.length > 0) {

        cards.forEach(function (_, index) {

            const dot = document.createElement('button');

            dot.type = 'button';

            dot.setAttribute(
                'aria-label',
                `Ke paket ${index + 1}`
            );

            dot.className =
                'h-2 rounded-full transition-all duration-300 ' +
                (index === 0
                    ? 'w-7 bg-brand'
                    : 'w-2 bg-line');

            dot.addEventListener('click', function () {
                goTo(index);
            });

            dotsContainer.appendChild(dot);
        });
    }

    function updateDots() {

        if (!dotsContainer) {
            return;
        }

        const dots =
            dotsContainer.querySelectorAll('button');

        dots.forEach(function (dot, index) {

            if (index === currentIndex) {

                dot.className =
                    'h-2 w-7 rounded-full bg-brand transition-all duration-300';

            } else {

                dot.className =
                    'h-2 w-2 rounded-full bg-line transition-all duration-300';
            }
        });
    }


    // =====================================================
    // GET CARD POSITION
    // =====================================================

    function getCardPosition(index) {

        const card = cards[index];

        if (!card) {
            return 0;
        }

        return (
            card.offsetLeft -
            (slider.clientWidth - card.clientWidth) / 2
        );
    }


    // =====================================================
    // GO TO CARD
    // =====================================================

    function goTo(index) {

        if (!cards.length) {
            return;
        }

        currentIndex =
            Math.max(
                0,
                Math.min(index, cards.length - 1)
            );

        slider.scrollTo({
            left: getCardPosition(currentIndex),
            behavior: 'smooth'
        });

        updateDots();
    }


    // =====================================================
    // NEXT
    // =====================================================

    function next() {

        if (!cards.length) {
            return;
        }

        if (currentIndex >= cards.length - 1) {
            currentIndex = 0;
        } else {
            currentIndex++;
        }

        goTo(currentIndex);
    }


    // =====================================================
    // PREVIOUS
    // =====================================================

    function previous() {

        if (!cards.length) {
            return;
        }

        if (currentIndex <= 0) {
            currentIndex = cards.length - 1;
        } else {
            currentIndex--;
        }

        goTo(currentIndex);
    }


    // =====================================================
    // BUTTON EVENTS
    // =====================================================

    if (previousButton) {
        previousButton.addEventListener(
            'click',
            function () {
                previous();
                restartAutoSlide();
            }
        );
    }

    if (nextButton) {
        nextButton.addEventListener(
            'click',
            function () {
                next();
                restartAutoSlide();
            }
        );
    }


    // =====================================================
    // DRAG START
    // =====================================================

    slider.addEventListener(
        'pointerdown',
        function (event) {

            isDragging = true;

            slider.setPointerCapture(
                event.pointerId
            );

            startX = event.clientX;

            startScrollLeft =
                slider.scrollLeft;

            lastX = event.clientX;
            lastTime = performance.now();

            velocity = 0;

            cancelAnimationFrame(
                animationFrame
            );

            slider.classList.remove(
                'scroll-smooth'
            );

            slider.classList.add(
                'cursor-grabbing'
            );

            pauseAutoSlide();
        }
    );


    // =====================================================
    // DRAG MOVE
    // =====================================================

    slider.addEventListener(
        'pointermove',
        function (event) {

            if (!isDragging) {
                return;
            }

            const currentX =
                event.clientX;

            const currentTime =
                performance.now();

            const distance =
                currentX - startX;

            slider.scrollLeft =
                startScrollLeft - distance;

            const deltaX =
                currentX - lastX;

            const deltaTime =
                currentTime - lastTime;

            if (deltaTime > 0) {
                velocity =
                    deltaX / deltaTime;
            }

            lastX = currentX;
            lastTime = currentTime;
        }
    );


    // =====================================================
    // DRAG END
    // =====================================================

    function endDrag() {

        if (!isDragging) {
            return;
        }

        isDragging = false;

        slider.classList.remove(
            'cursor-grabbing'
        );

        slider.classList.add(
            'scroll-smooth'
        );

        glide();

        restartAutoSlide();
    }

    slider.addEventListener(
        'pointerup',
        endDrag
    );

    slider.addEventListener(
        'pointercancel',
        endDrag
    );


    // =====================================================
    // MOMENTUM
    // =====================================================

    function glide() {

        let currentVelocity =
            velocity * 18;

        function step() {

            if (
                Math.abs(currentVelocity) < 0.5
            ) {

                snapToNearestCard();

                return;
            }

            slider.scrollLeft -=
                currentVelocity;

            currentVelocity *= 0.92;

            animationFrame =
                requestAnimationFrame(step);
        }

        animationFrame =
            requestAnimationFrame(step);
    }


    // =====================================================
    // SNAP TO CARD
    // =====================================================

    function snapToNearestCard() {

        let nearestIndex = 0;
        let smallestDistance = Infinity;

        cards.forEach(function (card, index) {

            const cardCenter =
                card.offsetLeft +
                card.clientWidth / 2;

            const sliderCenter =
                slider.scrollLeft +
                slider.clientWidth / 2;

            const distance =
                Math.abs(
                    cardCenter - sliderCenter
                );

            if (distance < smallestDistance) {

                smallestDistance = distance;
                nearestIndex = index;
            }
        });

        goTo(nearestIndex);
    }


    // =====================================================
    // MOUSE WHEEL
    // =====================================================

    slider.addEventListener(
        'wheel',
        function (event) {

            if (
                Math.abs(event.deltaY) >
                Math.abs(event.deltaX)
            ) {

                event.preventDefault();

                slider.scrollLeft +=
                    event.deltaY;
            }

            restartAutoSlide();
        },
        {
            passive: false
        }
    );


    // =====================================================
    // AUTO SLIDE
    // =====================================================

    function startAutoSlide() {

        clearInterval(autoSlideTimer);

        if (cards.length <= 1) {
            return;
        }

        autoSlideTimer =
            setInterval(function () {

                if (!isDragging) {
                    next();
                }

            }, 5000);
    }

    function pauseAutoSlide() {
        clearInterval(autoSlideTimer);
    }

    function restartAutoSlide() {
        pauseAutoSlide();
        startAutoSlide();
    }


    slider.addEventListener(
        'mouseenter',
        pauseAutoSlide
    );

    slider.addEventListener(
        'mouseleave',
        restartAutoSlide
    );


    // =====================================================
    // RESPONSIVE
    // =====================================================

    window.addEventListener(
        'resize',
        function () {
            goTo(currentIndex);
        }
    );


    // =====================================================
    // INITIAL
    // =====================================================

    updateDots();
    startAutoSlide();

});