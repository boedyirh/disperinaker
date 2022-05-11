<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KecamatanModel;
use App\Models\KeldesaModel;

class DropdownKeldesaLw extends Component
{
 public $kecamatan;
 public $keldesa;
 public $selectedKecamatan;
 public $keldesa_id;



 public function mount()
 {
    $this->kecamatan = KecamatanModel::where('status',1)
    ->orderBy('nama_kecamatan','asc')
    ->get(['kecamatan_id','nama_kecamatan']);
    $this->keldesa = collect();
    if (!is_null($this->selectedKecamatan)) {
        $this->keldesa = KeldesaModel::where('kecamatan_id', $this->selectedKecamatan)
        ->orderBy('nama_keldesa','asc')
        ->get(['id_keldesa_gabungan','nama_keldesa']);
    }




 }
    public function render()
    {
        return view('livewire.dropdown-keldesa-lw');
    }

    public function updatedSelectedKecamatan($selectedKecamatan)
    {
        if (!is_null($selectedKecamatan)) {
            $this->keldesa = KeldesaModel::where('kecamatan_id', $selectedKecamatan)
            ->orderBy('nama_keldesa','asc')
            ->get(['id_keldesa_gabungan','nama_keldesa']);
        }
    }
}
