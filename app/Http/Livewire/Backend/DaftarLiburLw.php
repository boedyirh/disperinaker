<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\EventModel;
use Livewire\WithPagination;

class DaftarLiburLw extends Component
{
    use WithPagination;
    public $periode;
    public $tahun =2022;
    public $perpage=12;
    public $total_record;

    public function render()
    {
        $daftarLibur = EventModel::where('tahun',$this->tahun)
                            ->orderBy('start','asc')
                            ->paginate($this->perpage);
        return view('livewire.backend.daftar-libur-lw',['daftarLibur'=>$daftarLibur]);

    }

    public function refreshPage()
        {
       //To reload
        }
}
