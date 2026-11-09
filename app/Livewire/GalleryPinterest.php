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

        if ($this->transId && !$this->acaraId) {
            $this->acaraId = Acara::where('trans_id', $this->transId)
                ->value('acara_id');
        }

        $seedKey = 'gallery_seed_' . ($this->acaraId ?? 'default');
        $this->seed = session()->get($seedKey);

        if (!$this->seed) {
            $this->seed = mt_rand(1, 1000000);
            session()->put($seedKey, $this->seed);
        }
    }

    public function loadMore()
    {
        $this->perPage += 4;
    }

    public function render()
    {
        return view('livewire.gallery-pinterest', [
            'fotos' => $this->acaraId
                ? Foto::query()
                    ->where('acara_id', $this->acaraId)
                    ->orderByRaw('RAND(?)', [$this->seed])
                    ->paginate($this->perPage)
                : Foto::query()->whereRaw('1 = 0')->paginate($this->perPage),
        ]);
    }
}
