<div>
  <h2>Daftar Paket Fotografer
    NAJWANNNNNN
  </h2>

    @php
        $paket = \App\Models\Paket::where('fotografer_id', Auth::id())->get();
    @endphp
</div>