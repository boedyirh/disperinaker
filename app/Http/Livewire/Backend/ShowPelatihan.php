<?php

namespace App\Http\Livewire\Backend;
use App\Models\PelatihanAk1Model;
use App\Models\DropdownModel;

use Livewire\Component;

class ShowPelatihan extends Component
{

    public $data_pelatihan;
    public $dataPelatihan = [];
    public $rand_ak1;
    public $datadropdown;
    public $pelatihan_edit;

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;

        $this->PelatihanAk1Model = new PelatihanAk1Model();
        $this->data_pelatihan = PelatihanAk1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_pelatihan_id','asc')
        ->get();

        if ($this->data_pelatihan) {
            foreach ($this->data_pelatihan as $item) {
                $this->dataPelatihan[] = [
                    'rand_ak1'              => $item->rand_ak1,
                    'rand_ak1_pelatihan'    => $item->rand_ak1_pelatihan,
                    'jenis_pelatihan'       => $item->jenis_pelatihan,
                    'nama_jenispelatihan'   => $item->nama_jenispelatihan,
                    'lembaga_pelatihan'     => $item->lembaga_pelatihan,
                    'tahun'                 => $item->tahun,
                    'file_pendukung'        => $item->file_pendukung,
                    'file_asli'             => $item->file_asli,
                    'dipakai'               => $item->dipakai,
                    'pelatihan_edit'       => false,
                    ];
            }
        }



        $this->datadropdown =[
            'd_jenisPelatihan' =>DropdownModel::where('dropdown_type','jenis_pelatihan')->where('NA','1')->orderBy('urutan')->get(['value_dropdown','label_dropdown']),
        ];


    }
    public function render()
    {

        return view('livewire.backend.show-pelatihan',$this->datadropdown);
    }

    public function toggleDipakai($index)
    {
        $data =  $this->dataPelatihan[$index];
        $rand_ak1_pelatihan = $data['rand_ak1_pelatihan'] ;
        $data['dipakai'] = toggle10($data['dipakai']);
        $this->dataPelatihan[$index]['dipakai']= $data['dipakai'];
        $data_update= [
            'dipakai' => $data['dipakai'],
        ];
        $this->PelatihanAk1Model->updatepelatihan($data_update,$rand_ak1_pelatihan);
    }

    public function editPelatihan($index)
    {
        //Jika ada record yang diedit dan belum disave, munculkan error
        foreach ($this->dataPelatihan as $key => $item) {
            if ($item['pelatihan_edit']) {
                $this->addError('pesan_selesaikan.'. $key,'Belum selesai.');
                return;
            }
        }
        //Saat mode edit, langsung diset pelatihan_edit=true, setelah klik save diset pelatihan_edit=true
        $this->dataPelatihan[$index]['pelatihan_edit'] = true;
    }

    public function updatePelatihan($index)
    {
        $this->resetErrorBag();
        $data =  $this->dataPelatihan[$index];
        $rand_ak1_pelatihan = $data['rand_ak1_pelatihan'] ;
        $nama_jenispelatihan =getJenisPelatihan_from_id($this->dataPelatihan[$index]['jenis_pelatihan']);
        $this->dataPelatihan[$index]['nama_jenispelatihan']=$nama_jenispelatihan;


        $data_update= [
            'lembaga_pelatihan' => $this->dataPelatihan[$index]['lembaga_pelatihan'],
             'jenis_pelatihan' => $this->dataPelatihan[$index]['jenis_pelatihan'],
            'nama_jenispelatihan' => $nama_jenispelatihan,

            'tahun' => $this->dataPelatihan[$index]['tahun'],
        ];

        $this->PelatihanAk1Model->updatePelatihan($data_update,$rand_ak1_pelatihan);
        $this->dataPelatihan[$index]['pelatihan_edit']=false;
    }


}
