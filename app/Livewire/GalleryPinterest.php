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

    public function mount()
    {
        // Reuse the same seed across refreshes; only generate a new one if none exists yet
        $this->seed = session()->get('gallery_seed', function () {
            $newSeed = mt_rand(1, 1000000);
            session()->put('gallery_seed', $newSeed);
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
                ->orderByRaw('RAND(?)', [$this->seed])
                ->paginate($this->perPage),
        ]);
    }
}
