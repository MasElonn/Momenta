// Alpine component for the pricing-packages slider on the landing page
// (resources/views/LandingPage.blade.php, #harga section).
//
// Registered on the 'alpine:init' event so the component is available
// before Alpine scans the DOM for x-data="paketSlider".
document.addEventListener('alpine:init', () => {
    Alpine.data('paketSlider', () => ({
        isDown: false,
        hasDragged: false,
        dragThreshold: 6, // px — below this, treat it as a click, not a drag
        startX: 0,
        startScroll: 0,
        lastX: 0,
        lastTime: 0,
        velocity: 0,
        raf: null,
        canScrollLeft: false,
        canScrollRight: false,
        current: 0,
        count: 0,
        autoplayTimer: null,
        autoplay: false, // off: content that moves by itself is distracting and hard to read

        prefersReducedMotion() {
            return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        },

        init() {
            this.count = this.$refs.slider.children.length;
            this.$nextTick(() => this.updateEdges());
            window.addEventListener('resize', () => this.updateEdges());
            this.startAutoplay();
        },

        updateEdges() {
            const el = this.$refs.slider;
            this.canScrollLeft = el.scrollLeft > 4;
            this.canScrollRight = el.scrollLeft < el.scrollWidth - el.clientWidth - 4;

            const card = el.children[0];
            if (card) {
                const gap = parseFloat(getComputedStyle(el).columnGap || 24);
                this.current = Math.round(el.scrollLeft / (card.offsetWidth + gap));
            }
        },

        scrollToIndex(i) {
            const el = this.$refs.slider;
            const card = el.children[i];
            if (!card) return;
            el.scrollTo({
                left: card.offsetLeft - el.offsetLeft,
                behavior: this.prefersReducedMotion() ? 'auto' : 'smooth',
            });
        },

        prev() {
            this.scrollToIndex(Math.max(this.current - 1, 0));
        },

        next() {
            this.scrollToIndex(Math.min(this.current + 1, this.count - 1));
        },

        startAutoplay() {
            clearInterval(this.autoplayTimer);
            if (!this.autoplay || this.count <= 1) return;
            this.autoplayTimer = setInterval(() => {
                if (this.current >= this.count - 1) {
                    this.scrollToIndex(0);
                } else {
                    this.next();
                }
            }, 4500);
        },

        pauseAutoSlide() {
            clearInterval(this.autoplayTimer);
        },

        resumeAutoSlide() {
            this.startAutoplay();
        },

        startDrag(e) {
            if (e.pointerType !== 'mouse') return;

            this.isDown = true;
            this.hasDragged = false;
            this.startX = e.pageX;
            this.startScroll = this.$refs.slider.scrollLeft;
            this.lastX = e.pageX;
            this.lastTime = performance.now();
            this.velocity = 0;
            cancelAnimationFrame(this.raf);
            // Autoplay is only paused once we confirm this is an actual
            // drag (past the threshold below) — not on every click.
        },

        duringDrag(e) {
            if (!this.isDown) return;

            const moved = e.pageX - this.startX;

            // Still inside the click tolerance — don't touch scroll or
            // preventDefault yet, so a tap/click on a link or button
            // underneath the pointer still fires normally afterwards.
            if (!this.hasDragged) {
                if (Math.abs(moved) < this.dragThreshold) return;
                this.hasDragged = true;
                this.pauseAutoSlide();
            }

            e.preventDefault();

            const now = performance.now();
            const dt = Math.max(now - this.lastTime, 1);
            this.velocity = (e.pageX - this.lastX) / dt;
            this.lastX = e.pageX;
            this.lastTime = now;

            this.$refs.slider.scrollLeft = this.startScroll - moved;
            this.updateEdges();
        },

        endDrag() {
            if (!this.isDown) return;
            this.isDown = false;

            if (this.hasDragged) {
                this.glide();
            } else {
                // Was just a click/tap — nothing to settle, resume autoplay.
                this.resumeAutoSlide();
            }
        },

        pointerLeave() {
            this.endDrag();
        },

        // Momentum animation: after release, the row keeps sliding and
        // gradually slows down instead of stopping instantly.
        glide() {
            const el = this.$refs.slider;
            const decay = 0.94;
            const settle = () => {
                // hasDragged also switches scroll-snap off in the template
                // while dragging; clearing it lets the row snap to a card.
                this.hasDragged = false;
                this.updateEdges();
                this.resumeAutoSlide();
            };
            const step = () => {
                if (Math.abs(this.velocity) < 0.02) {
                    settle();
                    return;
                }
                el.scrollLeft -= this.velocity * 16;
                this.velocity *= decay;
                this.updateEdges();
                this.raf = requestAnimationFrame(step);
            };
            if (this.prefersReducedMotion()) {
                settle();
                return;
            }
            this.raf = requestAnimationFrame(step);
        },
    }));
});