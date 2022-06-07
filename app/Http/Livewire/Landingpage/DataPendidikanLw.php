<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PendidikanAk1Model;
use App\Models\DropdownModel;
use App\Models\Ak1Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataPendidikanLw extends Component
{
    use WithFileUploads;
    public $dataPendidikan = [];
    public $list_ak1_pendidikan;
    public $rand_ak1;
    public $rand_ak1_pendidikan;
    public $tingkat_pendidikan;
    public $nama_institusi;
    public $jurusan;
    public $datadropdown;
    public $tahun_lulus;
    public $file_pendukung;



    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->PendidikanAk1Model = new PendidikanAk1Model();
             //Daftar pendidikan yang pernah ditempuh
             $this->list_ak1_pendidikan = PendidikanAk1Model::where('rand_ak1',$this->rand_ak1)
             ->orderBy('ak1_pendidikan_id','asc')
             ->get();

             if ($this->list_ak1_pendidikan) {
                 foreach ($this->list_ak1_pendidikan as $item) {
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
                     'is_saved'              => $item->is_saved,
                     ];
                 }
             }

        $this->datadropdown =[
            'd_tingkatpendidikan' =>DropdownModel::where('dropdown_type','tingkat_pendidikan')->where('NA','1')->orderBy('urutan')->get(['value_dropdown','label_dropdown']),
        ];
    }


    public function render()
    {

        return view('livewire.landingpage.data-pendidikan-lw',$this->datadropdown);
    }

    public function addPendidikan()
    {
        //Jika ada record yang belum disave, munculkan error
        foreach ($this->dataPendidikan as $key=>$item) {
            if (!$item['is_saved']) {
                 $this->addError('pesan_selesaikan.'. $key, 'Harap selesaikan ini dulu, baru bisa menambah yang baru.');
                return;
            }
        }

        //Insert record kosong ke table
        $rand_ak1_pendidikan      = Str::random(64); //random id untuk setiap record

        $datapend = [
            'rand_ak1_pendidikan' =>$rand_ak1_pendidikan,
            'rand_ak1'      =>  $this->rand_ak1,
        ];
        //insert data pendidikan
        $this->PendidikanAk1Model->addPendidikan($datapend);
        //initialisasi data awal untuk record baru sesuai record kosong di table

        $this->dataPendidikan[] = [
            'rand_ak1' => $this->rand_ak1,
            'rand_ak1_pendidikan' => $rand_ak1_pendidikan,
            'tingkat_pendidikan' => '',
            'nama_tingkatpendidikan' => '',
            'nama_institusi' => '',
            'jurusan' => '',
            'tahun_lulus' => '',
            'file_pendukung' => '',
            'file_asli' => '',
            'is_saved' => 0,
        ];

    }

    public function savePendidikan($index)
    {
        $this->resetErrorBag();
        $data =  $this->dataPendidikan[$index];
        $this->dataPendidikan[$index]['is_saved']=1;
        $rand_ak1_pendidikan = $data['rand_ak1_pendidikan'];
        $nama_tingkatpendidikan =getStrataPendidikan_from_id($this->dataPendidikan[$index]['tingkat_pendidikan']);
        $rand_berkas         = Str::random(8); //random id untuk setiap record
        $file_pendukung        = $data['file_pendukung'];

         //Cek apakah ada update lampiran atau tidak
         if(is_string($file_pendukung)){
            $data_update= [
                'tingkat_pendidikan' => $data['tingkat_pendidikan'],
                'nama_tingkatpendidikan' => $nama_tingkatpendidikan,
                'nama_institusi' => $data['nama_institusi'],
                'jurusan' => $data['jurusan'],
                'tahun_lulus' => $data['tahun_lulus'],
                'is_saved' => 1,
            ];
            $this->dataPendidikan[$index]['is_saved']=1;
            $this->dataPendidikan[$index]['file_pendukung']= $file_pendukung;


         }else{
            if($file_pendukung){
                $file_asli = $file_pendukung->getClientOriginalName();
                $fileName              = $rand_berkas.'.'.$file_pendukung->extension();
                $file_pendukung->storeAs('file_pendidikan', $fileName);
                $this->dataPendidikan[$index]['file_asli']= $file_asli;
             }else {
                $file_asli='';
                $fileName='';
            }




            $data_update= [
                'tingkat_pendidikan' => $data['tingkat_pendidikan'],
                'nama_tingkatpendidikan' => $nama_tingkatpendidikan,
                'nama_institusi' => $data['nama_institusi'],
                'jurusan' => $data['jurusan'],
                'file_pendukung' => $fileName,
                'file_asli' => $file_asli,
                'tahun_lulus' => $data['tahun_lulus'],
                'is_saved' => 1,
            ];
            // $this->dataPendidikan[$index]['is_saved']=1;
            $this->dataPendidikan[$index]['file_pendukung']= $fileName;
         }

         //Save data pendidikan
        $this->PendidikanAk1Model->updatePendidikan($data_update,$rand_ak1_pendidikan);
    }

    public function removePendidikan($index)
    {
        $rand_ak1_pendidikan = $this->dataPendidikan[$index]['rand_ak1_pendidikan'];
        //Hapus di database
        $this->PendidikanAk1Model->deletePendidikan($rand_ak1_pendidikan);
        //Hapus di array
         unset($this->dataPendidikan[$index]);
        //pass parameter array yang tersisa
        $this->dataPendidikan = array_values($this->dataPendidikan);
    }

    public function editPendidikanxx($index)
    {
        //Jika ada record yang diedit dan belum disave, munculkan error
        foreach ($this->dataPendidikan as $key => $item) {
            if (!$item['is_saved']) {
                $this->addError('pesan_selesaikan.'. $key,'Selesaikan ini dulu baru bisa edit yang lain.');
                return;
            }
        }
        //Saat mode edit, langsung diset is_saved=0, setelah klik save diset is_saved=1
        $this->dataPendidikan[$index]['is_saved'] = 0;
    }


}
