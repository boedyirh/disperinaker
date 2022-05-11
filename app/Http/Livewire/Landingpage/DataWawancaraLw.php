<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\DropdownModel;
use App\Models\InitialSlotModel;
use App\Models\SlotWawancaraModel;
use App\Models\Ak1Model;
use App\Models\TimeDimensionModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class DataWawancaraLw extends Component
{
    public $minggu_ke;
    public $tahun ;
    public $tanggal_wawancara;
    public $inital_slot;
    public $recordDataSlot;
    public $slot_id;
    public $dataSlot;
    public $rand_ak1;
    public $sudah_ambil_jadwal=false;

    protected $rules =[
        'slot_id' => 'required',
    ];

    public function mount($rand_ak1)
    {
        $tanggal_sekarang = date("Y-m-d");
        $this->minggu_ke =  getMingguKe($tanggal_sekarang);
        $hari_ini = getNamaHari($tanggal_sekarang);

        //Jika hari ini hari Sabtu atau Minggu, Maka slot minggu-ke aktif adalah Minggu depannya.
        // $hari_ini = $_tanggal->nama_hari;
        if($hari_ini=="Sabtu"||$hari_ini=="Minggu"){
            $this->minggu_ke =$this->minggu_ke +1;
        }
        $this->tahun = idate("Y");

        $this->rand_ak1 = $rand_ak1;
        $this->SlotWawancaraModel   = new SlotWawancaraModel();
        $this->InitialSlotModel     = new InitialSlotModel();
        $this->Ak1Model             = new Ak1Model();


        $this->sudah_ambil_jadwal   = $this->SlotWawancaraModel->cekSudahAmbilJadwal($this->rand_ak1); //tbl_slot_wawancara false/true
        //Ambil jadwal harian tiap hari
        $this->initial_slot         = InitialSlotModel::where('kategori','wawancara_ak1')->orderBy('urutan','asc')->get(); //tbl_slot
        $this->recordDataWaktu      = InitialSlotModel::where('kategori','wawancara_ak1')->get(); //tbl_slot
        $this->recordDataSlot       = SlotWawancaraModel::where('kategori','wawancara_ak1')->where('tahun',$this->tahun)->where('minggu_ke',$this->minggu_ke)->get(); //tbl_slot_wawancara
        //time_dimension
        $this->tanggal_wawancara    = TimeDimensionModel::where('minggu_ke',$this->minggu_ke)->where('year',$this->tahun)->where('weekend_flag','f')->orderBy('id','asc')->get();
        $this->dataSlot             = SlotWawancaraModel::where('sudah_dipesan', $this->rand_ak1)->first(); //tbl_slot_wawancara

    }
    public function render()
    {
        $this->sudah_ambil_jadwal   = $this->SlotWawancaraModel->cekSudahAmbilJadwal($this->rand_ak1); //tbl_slot_wawancara false/true
        return view('livewire.landingpage.data-wawancara-lw',[$this->dataSlot,$this->tanggal_wawancara,$this->initial_slot,$this->recordDataSlot, $this->recordDataWaktu,$this->sudah_ambil_jadwal]);
    }

    public function submit()
    {
        $dataslot = [
            'sudah_dipesan' => $this->rand_ak1,
        ];
          //Save slot pemesanan di tabel slot utama tbl_slot_wawancara
          $this->SlotWawancaraModel->updateSlotWawancara($dataslot,$this->slot_id);

         //Save slot pemesanan di tabel layanan utama tbl_ak1
          $slot_detil =$this->SlotWawancaraModel->detailSlot($this->slot_id);
          $jadwal_wawancara = [
            'tanggal_jadwal' => $slot_detil->tanggal,
            'jam_jadwal' =>$slot_detil->waktu,
            'hari_jadwal' =>$slot_detil->hari,
        ];
          $this->dataSlot             = SlotWawancaraModel::where('sudah_dipesan', $this->rand_ak1)->first(); //tbl_slot_wawancara
          $this->Ak1Model->updateData($jadwal_wawancara,$this->rand_ak1);
          $this->dispatchBrowserEvent('postUpdated', "close-modal");
    }

    public function nextWeek()
    {
        $this->minggu_ke =$this->minggu_ke +1;
        $this->recordDataSlot       = SlotWawancaraModel::where('kategori','wawancara_ak1')->where('tahun',$this->tahun)->where('minggu_ke',$this->minggu_ke)->get(); //tbl_slot_wawancara

        //time_dimension
        $this->tanggal_wawancara    = TimeDimensionModel::where('minggu_ke',$this->minggu_ke)->where('year',$this->tahun)->where('weekend_flag','f')->orderBy('id','asc')->get();


    }
    public function previousWeek()
    {
        $this->minggu_ke =$this->minggu_ke -1;
        $this->recordDataSlot       = SlotWawancaraModel::where('kategori','wawancara_ak1')->where('tahun',$this->tahun)->where('minggu_ke',$this->minggu_ke)->get(); //tbl_slot_wawancara

        //time_dimension
        $this->tanggal_wawancara    = TimeDimensionModel::where('minggu_ke',$this->minggu_ke)->where('year',$this->tahun)->where('weekend_flag','f')->orderBy('id','asc')->get();


    }
}
