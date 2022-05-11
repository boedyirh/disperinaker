<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PengalamankerjaAk1Model;
use App\Models\DropdownModel;
use App\Models\Ak1Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DataPengalamankerjaLw extends Component
{
    use WithFileUploads;
    public $dataPengalamankerja = [];
    public $list_ak1_pengalamankerja;
    public $rand_ak1;
    public $rand_ak1_pekerjaan;
    public $jenis_pengalamankerja;
    public $lembaga_pengalamankerja;
    public $jurusan;
    public $tahun_lulus;
    public $nilai;
    public $file_pendukung;

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->PengalamankerjaAk1Model = new PengalamankerjaAk1Model();
             //Daftar pengalaman kerja
        $this->list_ak1_pengalamankerja = PengalamankerjaAk1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_pekerjaan_id','asc')
        ->get();

        if ($this->list_ak1_pengalamankerja) {
            foreach ($this->list_ak1_pengalamankerja as $item) {
                $this->dataPengalamankerja[] = [
                    'rand_ak1_pekerjaan' => $item->rand_ak1_pekerjaan,
                    'nama_perusahaan' => $item->nama_perusahaan,
                    'rand_ak1' => $item->rand_ak1,
                    'bidang_usaha' => $item->bidang_usaha,
                    'file_pendukung' => $item->file_pendukung,
                    'file_asli'      => $item->file_asli,
                    'tahun' => $item->tahun,
                    'jabatan' => $item->jabatan,
                    'is_saved' => $item->is_saved,
            ];
            }
        }

    }


    public function render()
    {

        $datadropdown =[
            'd_jenisPengalamankerja' =>DropdownModel::where('dropdown_type','jenis_pengalamankerja')->where('NA','1')->orderBy('urutan')->get(['value_dropdown','label_dropdown']),
        ];
        return view('livewire.landingpage.data-pengalamankerja-lw',$datadropdown);
    }

    public function addPengalamankerja()
    {
        //Jika ada record yang belum disave, munculkan error
        foreach ($this->dataPengalamankerja as $key=>$item) {
            if (!$item['is_saved']) {
                 $this->addError('pesan_selesaikan.'. $key, 'Harap selesaikan ini dulu, baru bisa menambah yang baru.');
                return;
            }
        }

        //Insert record kosong ke table
        $rand_ak1_pekerjaan      = Str::random(64); //random id untuk setiap record

        $datapend = [
            'rand_ak1_pekerjaan' =>$rand_ak1_pekerjaan,
            'rand_ak1'      =>  $this->rand_ak1,
        ];
        //insert data Pengalaman kerja
        $this->PengalamankerjaAk1Model->addPengalamankerja($datapend);
        //initialisasi data awal untuk record baru sesuai record kosong di table

        $this->dataPengalamankerja[] = [
            'rand_ak1_pekerjaan' => $rand_ak1_pekerjaan,
            'nama_perusahaan' => '',
            'bidang_usaha' => '',
            'file_pendukung' => '',
            'file_asli' => '',
            'jabatan' => '',
            'tahun' => '',
            'is_saved' => 0,
        ];

    }

    public function savePengalamankerja($index)
    {
        $this->resetErrorBag();
        $data =  $this->dataPengalamankerja[$index];
        $this->dataPengalamankerja[$index]['is_saved']=1;
        $rand_ak1_pekerjaan = $data['rand_ak1_pekerjaan'];
        $rand_berkas      = Str::random(8); //random id untuk setiap berkas
        $file_pendukung        = $data['file_pendukung'];
        //Cek apakah ada update lampiran atau tidak
        if(is_string($file_pendukung)){
            $data_update= [
                'nama_perusahaan' => $data['nama_perusahaan'],
                'bidang_usaha' => $data['bidang_usaha'],
                'jabatan' => $data['jabatan'],
                'tahun' => $data['tahun'],
                'is_saved' => 1,
            ];


        } else {

            if($file_pendukung){
                $file_asli = $file_pendukung->getClientOriginalName();
                $fileName              = $rand_berkas.'.'.$file_pendukung->extension();
                $file_pendukung->storeAs('file_pengalamankerja', $fileName);
                $this->dataPengalamankerja[$index]['file_asli']= $file_asli;
             }else {
                $file_asli='';
                $fileName='';
            }

            $data_update= [
                'nama_perusahaan' => $data['nama_perusahaan'],
                'bidang_usaha' => $data['bidang_usaha'],
                'file_pendukung' => $fileName,
                'file_asli' => $file_asli,
                'jabatan' => $data['jabatan'],
                'tahun' => $data['tahun'],
                'is_saved' => 1,
            ];

        }


         //Save data Pengalaman kerja
         $this->PengalamankerjaAk1Model->updatePengalamankerja($data_update,$rand_ak1_pekerjaan);
    }

    public function removePengalamankerja($index)
    {
        $rand_ak1_pekerjaan = $this->dataPengalamankerja[$index]['rand_ak1_pekerjaan'];
        //Hapus di database
        $this->PengalamankerjaAk1Model->deletePengalamankerja($rand_ak1_pekerjaan);
        //Hapus di array
         unset($this->dataPengalamankerja[$index]);
        //pass parameter array yang tersisa
        $this->dataPengalamankerja = array_values($this->dataPengalamankerja);
    }

    public function editPengalamankerja($index)
    {
        //Jika ada record yang diedit dan belum disave, munculkan error
        foreach ($this->dataPengalamankerja as $key => $item) {
            if (!$item['is_saved']) {
                $this->addError('pesan_selesaikan.'. $key,'Selesaikan ini dulu baru bisa edit yang lain.');
                return;
            }
        }
        //Saat mode edit, langsung diset is_saved=0, setelah klik save diset is_saved=1
        $this->dataPengalamankerja[$index]['is_saved'] = 0;
    }


}
