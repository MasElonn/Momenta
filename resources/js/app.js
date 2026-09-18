import 'preline';

import intersect from '@alpinejs/intersect'

document.addEventListener('livewire:init', () => {
    Alpine.plugin(intersect)
})

import HSRemoveElement from "@preline/remove-element/non-auto";
HSRemoveElement.autoInit();

import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", () => {
    const myDropzone = new Dropzone("#my-dropzone", {
        url: document.querySelector('#my-dropzone').action,
        paramName: 'file',
        chunking: true,
        forceChunking: true,
        parallelUploads: 3,
        chunkSize: 1000000,
        autoProcessQueue: true,
        init: function () {
            this.on("complete", (file) => {
                if (myDropzone.getQueuedFiles().length > 0 && myDropzone.getUploadingFiles().length === 0) {
                    myDropzone.processQueue();
                }
            });
            this.on("queuecomplete", () => {
                window.location.reload();
            });
            this.on("sending", (file, xhr, formData) => {
                const acaraId = document.querySelector('input[name="acara_id"]')?.value;
                if (acaraId) formData.append("acara_id", acaraId);
            });
        }
    });
});
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

        // --- Highlight link navbar sesuai posisi scroll ---
        // (Pakai posisi scroll langsung, bukan IntersectionObserver threshold,
        // karena section yang tinggi bisa bikin threshold nggak pernah kepenuhan
        // dan highlight "nyangkut" di section sebelumnya.)
        var navLinks = document.querySelectorAll('[data-nav-link]');
        var sections = ['beranda', 'cara-kerja', 'fitur', 'harga']
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

        if (sections.length) {
            var navbarOffset = 100; // tinggi navbar + sedikit buffer

            var updateActiveSection = function () {
                var scrollPos = window.scrollY + navbarOffset;
                var current = sections[0];

                sections.forEach(function (sec) {
                    if (sec.offsetTop <= scrollPos) current = sec;
                });

                setActive(current.id);
            };

            var ticking = false;
            window.addEventListener('scroll', function () {
                if (!ticking) {
                    window.requestAnimationFrame(function () {
                        updateActiveSection();
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });

            updateActiveSection();
        }
    });
