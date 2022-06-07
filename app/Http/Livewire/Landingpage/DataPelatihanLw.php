<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PelatihanAk1Model;
use App\Models\DropdownModel;
use App\Models\Ak1Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataPelatihanLw extends Component
{
    use WithFileUploads;
    public $dataPelatihan = [];
    public $list_ak1_pelatihan;
    public $rand_ak1;
    public $rand_ak1_pelatihan;
    public $jenis_pelatihan;
    public $current_index;
    public $lembaga_pelatihan;
    public $tahun;

    public $data_dropdown=[];


    public $nilai;
    public $file_pendukung;
    public $categories=[] ;

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->PelatihanAk1Model = new PelatihanAk1Model();
             //Daftar pelatihan yang pernah ditempuh



        $this->list_ak1_pelatihan = PelatihanAk1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_pelatihan_id','asc')
        ->get();
        if ($this->list_ak1_pelatihan) {
            foreach ($this->list_ak1_pelatihan as $item) {
                $this->dataPelatihan[] = [
                    'rand_ak1_pelatihan' => $item->rand_ak1_pelatihan,
                    'jenis_pelatihan' => $item->jenis_pelatihan,
                    'rand_ak1' => $item->rand_ak1,
                    'lembaga_pelatihan' => $item->lembaga_pelatihan,
                    'tahun' => $item->tahun,
                    'hasil' => $item->hasil,
                    'file_pendukung' => $item->file_pendukung,
                    'file_asli'      => $item->file_asli,
                    'is_saved' => $item->is_saved,
            ];
            }
        }

    }


    public function render()
    {
        return view('livewire.landingpage.data-pelatihan-lw');
    }

    public function addPelatihan()
    {
        //Jika ada record yang belum disave, munculkan error
        foreach ($this->dataPelatihan as $key=>$item) {
            if (!$item['is_saved']) {
                 $this->addError('pesan_selesaikan.'. $key, 'Harap selesaikan ini dulu, baru bisa menambah yang baru.');
                return;
            }
        }

        //Insert record kosong ke table
        $rand_ak1_pelatihan      = Str::random(64); //random id untuk setiap record


        $datapend = [
            'rand_ak1_pelatihan' =>$rand_ak1_pelatihan,
            'rand_ak1'      =>  $this->rand_ak1,
        ];
        //insert data Pelatihan
        $this->PelatihanAk1Model->addPelatihan($datapend);
        //initialisasi data awal untuk record baru sesuai record kosong di table

        $this->dataPelatihan[] = [
            'rand_ak1_pelatihan' => $rand_ak1_pelatihan,
            'jenis_pelatihan' => '',
            'lembaga_pelatihan' => '',
            'tahun' => '',
            'hasil' => '',
            'file_pendukung' => '',
            'file_asli' => '',
            'is_saved' => 0,
        ];

    }

    public function savePelatihan($index)
    {
        $this->resetErrorBag();
        $data =  $this->dataPelatihan[$index];
        $this->dataPelatihan[$index]['is_saved']=1;
        $rand_ak1_pelatihan = $data['rand_ak1_pelatihan'];
        $rand_berkas      = Str::random(8); //random id untuk setiap berkas

        $file_pendukung        = $data['file_pendukung'];
        if(is_string($file_pendukung)){
            $data_update= [
                'jenis_pelatihan' => $data['jenis_pelatihan'],
                'lembaga_pelatihan' => $data['lembaga_pelatihan'],
                'tahun' => $data['tahun'],
                'is_saved' => 1,
            ];


        } else {

            if($file_pendukung){
                $file_asli = $file_pendukung->getClientOriginalName();
                $fileName              = $rand_berkas.'.'.$file_pendukung->extension();
                $file_pendukung->storeAs('file_pelatihan', $fileName);
                $this->dataPelatihan[$index]['file_asli']= $file_asli;
             }else {
                $file_asli='';
                $fileName='';
            }

            $data_update= [
                'jenis_pelatihan' => $data['jenis_pelatihan'],
                'lembaga_pelatihan' => $data['lembaga_pelatihan'],
                'file_pendukung' => $fileName,
                'file_asli' => $file_asli,
                'tahun' => $data['tahun'],
                'is_saved' => 1,
            ];


        }

         //Save data Pelatihan
         $this->PelatihanAk1Model->updatePelatihan($data_update,$rand_ak1_pelatihan);
    }

    public function removePelatihan($index)
    {
        $rand_ak1_pelatihan = $this->dataPelatihan[$index]['rand_ak1_pelatihan'];
        //Hapus di database
        $this->PelatihanAk1Model->deletePelatihan($rand_ak1_pelatihan);
        //Hapus di array
         unset($this->dataPelatihan[$index]);
        //pass parameter array yang tersisa
        $this->dataPelatihan = array_values($this->dataPelatihan);
    }

    public function editPelatihan($index)
    {
        //Jika ada record yang diedit dan belum disave, munculkan error
        foreach ($this->dataPelatihan as $key => $item) {
            if (!$item['is_saved']) {
                $this->addError('pesan_selesaikan.'. $key,'Selesaikan ini dulu baru bisa edit yang lain.');
                return;
            }
        }
        //Saat mode edit, langsung diset is_saved=0, setelah klik save diset is_saved=1
        $this->dataPelatihan[$index]['is_saved'] = 0;
    }



}
