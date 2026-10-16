<?php

namespace App\Livewire;

use App\Models\Acara;
use App\Models\Foto;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryPinterest extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $seed;
    public $acaraId;
    public $transId;

    public function mount($acaraId = null, $transId = null)
    {
        $this->acaraId = $acaraId;
        $this->transId = $transId;

        if ($this->transId) {
            $this->acaraId = Acara::where('trans_id', $this->transId)
                ->value('acara_id');
        }

        $this->seed = session()->get('gallery_seed_' . $this->acaraId);

        if (!$this->seed) {
            $this->seed = mt_rand(1, 1000000);
            session()->put('gallery_seed_' . $this->acaraId, $this->seed);
        }
    }

    public function loadMore()
    {
        $this->perPage += 4;
    }

    public function render()
    {
        return view('livewire.gallery-pinterest', [
            'fotos' => Foto::query()
                ->where('acara_id', $this->acaraId)
                ->orderByRaw('RAND(?)', [$this->seed])
                ->paginate($this->perPage),
        ]);
    }
}