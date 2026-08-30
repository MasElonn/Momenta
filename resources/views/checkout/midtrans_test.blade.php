<!DOCTYPE html>
<html>
<head>
    <title>Midtrans Test Checkout</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
</head>
<body>
<h2>Test Checkout</h2>

<form id="checkoutForm">
    @csrf
    <label>Pilih Paket:</label>
    <select name="paket_id" id="paket_id">
        @foreach($pakets as $p)
            <option value="{{ $p->paket_id }}">{{ $p->judul }} - Rp{{ number_format($p->harga) }}</option>
        @endforeach
    </select>
    <button type="submit">Bayar</button>
</form>

<div id="result"></div>

<script>
    document.getElementById('checkoutForm').addEventListener('submit', async function (e) {
        e.preventDefault();

        const res = await fetch("{{ route('checkout.midtrans') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            },
            body: JSON.stringify({
                paket_id: document.getElementById('paket_id').value,
            }),
        });

        const data = await res.json();

        if (data.snapToken) {
            snap.pay(data.snapToken, {
                onSuccess: function (result) {
                    document.getElementById('result').innerText = 'Success: ' + JSON.stringify(result);
                },
                onPending: function (result) {
                    document.getElementById('result').innerText = 'Pending: ' + JSON.stringify(result);
                },
                onError: function (result) {
                    document.getElementById('result').innerText = 'Error: ' + JSON.stringify(result);
                },
                onClose: function () {
                    document.getElementById('result').innerText = 'Popup closed without finishing payment';
                }
            });
        } else {
            document.getElementById('result').innerText = 'No token returned: ' + JSON.stringify(data);
        }
    });
</script>
</body>
</html>
