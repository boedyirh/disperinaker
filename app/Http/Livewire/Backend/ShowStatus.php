<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Ak1Model;

class ShowStatus extends Component
{
    public $status_id;
    public $keterangan;
    public $rand_ak1;
    public $data_pemohon=[];
    public $status_edit=false;
    public $nama_status;

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->data_pemohon  = Ak1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first();
        $this->status_id = $this->data_pemohon['status_id'];
        $this->keterangan = $this->data_pemohon['keterangan'];

    }

    public function render()
    {
        return view('livewire.backend.show-status');
    }

    public function editStatus()
    {
          $this->status_edit = true;
    }
    public function simpanStatus()
    {
        $nama_status = getStatus_from_id($this->status_id);

        $data_update= [
            'status_id' => $this->status_id,
            'keterangan' => $this->keterangan,
            'nama_status' => $nama_status,
        ];

        $this->Ak1Model->updateData($data_update,$this->rand_ak1);
        $this->status_edit = false;
        $this->data_pemohon['keterangan'] = $this->keterangan;
        $this->data_pemohon['status_id'] = $this->status_id;


    }
}
