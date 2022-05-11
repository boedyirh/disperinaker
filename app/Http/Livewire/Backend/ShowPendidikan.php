<?php

namespace App\Http\Livewire\Backend;
use App\Models\PendidikanAk1Model;
use App\Models\DropdownModel;
use App\Models\Ak1Model;

use Livewire\Component;

class ShowPendidikan extends Component
{
    public $data_pendidikan;
    public $dataPendidikan = [];
    public $rand_ak1;
    public $datadropdown;
    public $pendidikan_edit;


    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->PendidikanAk1Model = new PendidikanAk1Model();
        $this->data_pendidikan = PendidikanAk1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_pendidikan_id','asc')
        ->get();

        if ($this->data_pendidikan) {
            foreach ($this->data_pendidikan as $item) {
                $this->dataPendidikan[] = [
                    'rand_ak1'              => $item->rand_ak1,
                    'rand_ak1_pendidikan'   => $item->rand_ak1_pendidikan,
                    'tingkat_pendidikan'    => $item->tingkat_pendidikan,
                    'nama_tingkatpendidikan'=> $item->nama_tingkatpendidikan,
                    'nama_institusi'        => $item->nama_institusi,
                    'jurusan'               => $item->jurusan,
                    'tahun_lulus'           => $item->tahun_lulus,
                    'file_pendukung'        => $item->file_pendukung,
                    'file_asli'             => $item->file_asli,
                    'dipakai'               => $item->dipakai,
                    'pendidikan_edit'       => false,
                    ];
            }
        }

        $this->datadropdown =[
            'd_tingkatpendidikan' =>DropdownModel::where('dropdown_type','tingkat_pendidikan')->where('NA','1')->orderBy('urutan')->get(['value_dropdown','label_dropdown']),
        ];

    }

    public function render()
    {
        return view('livewire.backend.show-pendidikan',$this->datadropdown);
    }


    public function toggleDipakai($index)
    {
        $data =  $this->dataPendidikan[$index];
        $rand_ak1_pendidikan = $data['rand_ak1_pendidikan'] ;
        $data['dipakai'] = toggle10($data['dipakai']);
        $this->dataPendidikan[$index]['dipakai']= $data['dipakai'];
        $data_update= [
            'dipakai' => $data['dipakai'],
        ];
        $this->PendidikanAk1Model->updatePendidikan($data_update,$rand_ak1_pendidikan);
    }


    public function editPendidikan($index)
    {
        //Jika ada record yang diedit dan belum disave, munculkan error
        foreach ($this->dataPendidikan as $key => $item) {
            if ($item['pendidikan_edit']) {
                $this->addError('pesan_selesaikan.'. $key,'Belum selesai.');
                return;
            }
        }
        //Saat mode edit, langsung diset pendidikan_edit=true, setelah klik save diset pendidikan_edit=true
        $this->dataPendidikan[$index]['pendidikan_edit'] = true;
    }

    public function updatePendidikan($index)
    {
        $this->resetErrorBag();
        $data =  $this->dataPendidikan[$index];
        $rand_ak1_pendidikan = $data['rand_ak1_pendidikan'] ;
        $nama_tingkatpendidikan =getStrataPendidikan_from_id($this->dataPendidikan[$index]['tingkat_pendidikan']);
        $this->dataPendidikan[$index]['nama_tingkatpendidikan']=$nama_tingkatpendidikan;


        $data_update= [
            'tingkat_pendidikan' => $this->dataPendidikan[$index]['tingkat_pendidikan'],
            'nama_tingkatpendidikan' => $nama_tingkatpendidikan,
            'nama_institusi' => $this->dataPendidikan[$index]['nama_institusi'],
            'tahun_lulus' => $this->dataPendidikan[$index]['tahun_lulus'],
        ];

        $this->PendidikanAk1Model->updatePendidikan($data_update,$rand_ak1_pendidikan);
        $this->dataPendidikan[$index]['pendidikan_edit']=false;
    }




}
