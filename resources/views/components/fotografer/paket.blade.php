<div>
  <h2>Daftar Paket Fotografer
    NAJWANNNNNN
  </h2>
    <p class="text-gray-500">Paket yang Anda buat untuk pelanggan</p>



    @php
        $paket = \App\Models\Paket::where('fotografer_id', Auth::id())->get();
    @endphp
    