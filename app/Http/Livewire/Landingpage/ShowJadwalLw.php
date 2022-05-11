<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use App\Models\SlotWawancaraModel;
use Illuminate\Support\Facades\DB;

class ShowJadwalLw extends Component
{
    public $rand_ak1;
    public $dataSlot;
    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
    }
    public function render()
    {
            $this->dataSlot = SlotWawancaraModel::where('sudah_dipesan',$this->rand_ak1)->first();
            return view('livewire.landingpage.show-jadwal-lw',[$this->dataSlot]);
    }
}
