<?php

namespace App\Http\Livewire\Backend;
use App\Models\PengalamankerjaAk1Model;

use Livewire\Component;

class ShowPengalamanKerja extends Component
{

    public $data_pekerjaan;
    public $rand_ak1;
    public $dataPekerjaan = [];
    public $pekerjaan_edit;

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->PengalamankerjaAk1Model = new PengalamankerjaAk1Model();
        $this->data_pekerjaan = PengalamankerjaAk1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_pekerjaan_id','asc')
        ->get();

        if ($this->data_pekerjaan) {
            foreach ($this->data_pekerjaan as $item) {
                $this->dataPekerjaan[] = [
                    'rand_ak1'              => $item->rand_ak1,
                    'rand_ak1_pekerjaan'    => $item->rand_ak1_pekerjaan,
                    'nama_perusahaan'       => $item->nama_perusahaan,
                    'jabatan'               => $item->jabatan,
                    'tahun'                 => $item->tahun,
                    'dipakai'               => $item->dipakai,
                    'file_pendukung'        => $item->file_pendukung,
                    'pekerjaan_edit'        => false,
                    ];
            }
        }
    }
    public function render()
    {
        return view('livewire.backend.show-pengalaman-kerja');
    }

    public function toggleDipakai($index)
    {
        $data =  $this->dataPekerjaan[$index];
        $rand_ak1_pekerjaan = $data['rand_ak1_pekerjaan'] ;
        $data['dipakai'] = toggle10($data['dipakai']);
        $this->dataPekerjaan[$index]['dipakai']= $data['dipakai'];

        $data_update= [
            'dipakai' => $data['dipakai'],
        ];
        $this->PengalamankerjaAk1Model->updatePengalamankerja($data_update,$rand_ak1_pekerjaan);
    }
    public function editPekerjaan($index)
    {
        //Jika ada record yang diedit dan belum disave, munculkan error
        foreach ($this->dataPekerjaan as $key => $item) {
            if ($item['pekerjaan_edit']) {
                $this->addError('pesan_selesaikan.'. $key,'Belum selesai.');
                return;
            }
        }
        $this->dataPekerjaan[$index]['pekerjaan_edit'] = true;
    }

    public function updatePekerjaan($index)
    {
        $this->resetErrorBag();
        $data =  $this->dataPekerjaan[$index];
        $rand_ak1_pekerjaan = $data['rand_ak1_pekerjaan'] ;


        $data_update= [
            'jabatan' => $this->dataPekerjaan[$index]['jabatan'],
            'nama_perusahaan' => $this->dataPekerjaan[$index]['nama_perusahaan'],
            'tahun' => $this->dataPekerjaan[$index]['tahun'],

        ];

        $this->PengalamankerjaAk1Model->updatePengalamankerja($data_update,$rand_ak1_pekerjaan);
        $this->dataPekerjaan[$index]['pekerjaan_edit']=false;
    }


}
