<?php

namespace App\Livewire;

use App\Models\Foto;
use Livewire\Component;
use Livewire\WithPagination;

class GalleryPinterest extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $seed;
    public $acaraId;

    public function mount($acaraId = null)
    {
        $this->acaraId = $acaraId;
        $this->seed = session()->get('gallery_seed_' . $this->acaraId, function () {
            $newSeed = mt_rand(1, 1000000);
            session()->put('gallery_seed_' . $this->acaraId, $newSeed);
            return $newSeed;
        });
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
