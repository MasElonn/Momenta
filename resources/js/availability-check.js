// Alpine component for resources/views/availability/index.blade.php.
// Registered on 'alpine:init' so it's available before Alpine scans the DOM.
document.addEventListener('alpine:init', () => {
    Alpine.data('availabilityCheck', () => ({
        checkUrl: '',
        tanggal: '',
        waktuMulai: '',
        waktuSelesai: '',
        loading: false,
        submitted: false,
        errors: {},
        jumlahTersedia: 0,
        fotografer: [],
        checked: { tanggal: '', mulai: '', selesai: '' },

        init() {
            this.checkUrl = this.$el.dataset.checkUrl;
        },

        async check() {
            this.loading = true;
            this.errors = {};

            try {
                const response = await fetch(this.checkUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        tanggal: this.tanggal,
                        waktu_mulai: this.waktuMulai,
                        waktu_selesai: this.waktuSelesai,
                    }),
                });

                if (response.status === 422) {
                    const data = await response.json();
                    this.errors = data.errors || {};
                    this.submitted = false;
                    return;
                }

                if (!response.ok) {
                    throw new Error('Gagal mengecek ketersediaan.');
                }

                const data = await response.json();
                this.jumlahTersedia = data.jumlah_tersedia;
                this.fotografer = data.fotografer;
                // Snapshot the window that was actually checked, so the
                // booking link below can't drift if the inputs are edited.
                this.checked = {
                    tanggal: this.tanggal,
                    mulai: this.waktuMulai,
                    selesai: this.waktuSelesai,
                };
                this.submitted = true;
            } catch (e) {
                this.errors = { general: ['Terjadi kesalahan. Coba beberapa saat lagi.'] };
            } finally {
                this.loading = false;
            }
        },

        bookingUrl(fotograferId) {
            const query = new URLSearchParams({
                tanggal: this.checked.tanggal,
                mulai: this.checked.mulai,
                selesai: this.checked.selesai,
            });

            return `/booking/${fotograferId}?${query.toString()}`;
        },

        reset() {
            this.submitted = false;
            this.fotografer = [];
            this.errors = {};
        },

        firstError(field) {
            return this.errors[field]?.[0] ?? null;
        },

        initials(name) {
            return name
                .split(' ')
                .slice(0, 2)
                .map((part) => part.charAt(0).toUpperCase())
                .join('');
        },
    }));
});