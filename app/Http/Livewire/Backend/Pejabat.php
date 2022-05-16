<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Ak1Model;
use App\Models\PejabatModel;

class Pejabat extends Component
{

    public $rand_ak1;
    public $data_pemohon=[];
    public $pejabat_id;
    public $nama_penandatangan;
    public $nama_penandatangan_edit=false;
    public $nip_penandatangan;
    public $data_dropdown;


    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->PejabatModel = new PejabatModel();
        $this->data_pemohon  = Ak1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first(['penandatangan', 'nip_penandatangan']);
        $this->nama_penandatangan = $this->data_pemohon['penandatangan'];
        $this->nip_penandatangan = $this->data_pemohon['nip_penandatangan'];



        $this->datadropdown =[
            'd_pejabat' =>PejabatModel::where('status',1)->orderBy('urutan')->get(['id','nama']),
        ];

    }

    public function render()
    {
        return view('livewire.backend.pejabat',$this->datadropdown);
    }

    public function editPejabat()
    {
        $this->nama_penandatangan_edit = true;
    }

    public function updatePejabat()
    {
        if($this->pejabat_id){
            $data_pejabat  = PejabatModel::where('id',$this->pejabat_id)
            ->first();

            $data_update = [
                'penandatangan' => $data_pejabat->nama,
                'nip_penandatangan' => $data_pejabat->nip,
                'pejabat_id' => $this->pejabat_id,
            ];

            $this->Ak1Model->updateData($data_update,$this->rand_ak1);
        }


        $this->data_pemohon  = Ak1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first(['penandatangan', 'nip_penandatangan']);
        $this->nama_penandatangan = $this->data_pemohon['penandatangan'];
        $this->nip_penandatangan = $this->data_pemohon['nip_penandatangan'];

        $this->nama_penandatangan_edit = false;
    }


}
