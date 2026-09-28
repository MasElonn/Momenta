import 'preline';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import persist from '@alpinejs/persist';

import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";

Alpine.plugin(intersect);
Alpine.plugin(persist);

window.Alpine = Alpine;

document.addEventListener('livewire:init', () => {
    Alpine.plugin(intersect);
    Alpine.plugin(persist);
});

document.addEventListener('DOMContentLoaded', () => {
    if (!window.Alpine.started) {
        Alpine.start();
    }
});

import HSRemoveElement from "@preline/remove-element/non-auto";
HSRemoveElement.autoInit();


Dropzone.autoDiscover = false;

document.addEventListener("DOMContentLoaded", () => {
    const dropzoneEl = document.querySelector("#my-dropzone");

    // Guard: Only run if the element actually exists on the current page
    if (!dropzoneEl) return;

    // Grab action from the form element or its data-action attribute
    const uploadUrl = dropzoneEl.action || dropzoneEl.getAttribute("data-action") || dropzoneEl.closest("form")?.action;

    if (!uploadUrl) {
        console.error("Dropzone target URL is missing. Ensure the element is a <form> with an action attribute or has data-action.");
        return;
    }

    const myDropzone = new Dropzone(dropzoneEl, {
        url: uploadUrl,
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
                const transId = document.querySelector('input[name="trans_id"]')?.value;
                if (transId) formData.append("trans_id", transId);
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
