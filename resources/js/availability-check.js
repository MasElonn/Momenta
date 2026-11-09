
window.bookingForm = function (config) {
    return {
        fotograferId: config.fotograferId,
        pakets: config.pakets,
        checkUrl: config.checkUrl,

        selectedPackage: config.pakets.length
            ? String(config.pakets[0].paket_id)
            : '',

        tanggal: '',
        jam: '',
        jamSelesai: '',
        loading: false,
        checked: false,
        tersedia: false,
        message: '',

        get currentPackage() {
            return this.pakets.find(
                item => String(item.paket_id) === String(this.selectedPackage)
            );
        },

        get currentPrice() {
            return this.currentPackage
                ? Number(this.currentPackage.harga)
                : 0;
        },

        async checkAvailability() {
            this.checked = false;
            this.tersedia = false;
            this.jamSelesai = '';
            this.message = '';

            if (!this.selectedPackage || !this.tanggal || !this.jam) {
                return;
            }

            this.loading = true;

            try {
                const response = await fetch(this.checkUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content
                    },
                    body: JSON.stringify({
                        fotografer_id: this.fotograferId,
                        paket_id: this.selectedPackage,
                        tanggal: this.tanggal,
                        jam_mulai: this.jam
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    this.message = data.message || 'Gagal memeriksa jadwal.';
                    this.checked = true;
                    return;
                }

                this.checked = true;
                this.tersedia = data.tersedia;
                this.jamSelesai = data.jam_selesai || '';
                this.message = data.message;

            } catch (error) {
                this.message = 'Terjadi kesalahan saat memeriksa jadwal.';
                this.checked = true;
            } finally {
                this.loading = false;
            }
        },

        formatPrice() {
            return Number(this.currentPrice).toLocaleString('id-ID');
        }
    };
};
