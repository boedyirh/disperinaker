<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Ak1PengajuanModel;
use App\Models\PeriodeModel;
use Illuminate\Support\Str;

use Livewire\WithPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Ak1Pengajuan extends Component
{
    use WithPagination;
    public $tahun;
    public $perpage=6;
    public $searchTerm='';
    public $total_record;
    public $filter_id='';
    public $filter_tahun='';
    public $filter_bulan= '';
    public $nama, $alamat,$nama_kecamatan, $nama_keldesa;


    public function updatingSearchTerm()
    {
        $this->resetPage();
    }


    public function mount()
    {
        $this->filter_tahun = idate("Y");
        $this->filter_bulan = idate("m");

    }
    public function render()
    {
        $where = array();
        if ($this->filter_tahun != '') $where['tahun'] = $this->filter_tahun;
        if ($this->filter_bulan != '') $where['bulan'] = $this->filter_bulan;


        if($this->filter_id==''){
            $searchTerm = '%'.$this->searchTerm.'%';
            $daftar_pengajuan = DB::table('tbl_ak1')
            ->where('NA', '=', 1)
            ->where($where)
            ->where(function ($query) use ($searchTerm) {
                $query->where('nama', 'like', $searchTerm)
                ->orWhere('nama_kecamatan','like',$searchTerm)
                ->orWhere('nama_keldesa','like',$searchTerm);
            })
            ->paginate($this->perpage);

            $this->total_record = $daftar_pengajuan->total();
            //   dd($this->filter_id);
        }else{
            $searchTerm = '%'.$this->searchTerm.'%';
            $daftar_pengajuan = DB::table('tbl_ak1')
            ->where('NA', '=', 1)
            ->where($where)
            ->where('status_id','=',$this->filter_id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('nama', 'like', $searchTerm)
                ->orWhere('nama_kecamatan','like',$searchTerm)
                ->orWhere('nama_keldesa','like',$searchTerm);
            })
            ->paginate($this->perpage);
            $this->total_record = $daftar_pengajuan->total();

        }

        return view('livewire.backend.ak1-pengajuan',['daftar_pengajuan' => $daftar_pengajuan]);
    }
    public function kosongkan()
    {
        $this->searchTerm = '';
        $this->filter_id = '';

        $this->filter_tahun = idate("Y");
        $this->filter_bulan = idate("m");

    }

    public function updateFilterStatus()
    {
       // Update Filter

    }





}
