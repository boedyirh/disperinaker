<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Ak1SlotModel;
use App\Models\PeriodeModel;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\Ak1WawancaraModel;
use App\Models\TimeDimensionModel;
use App\Models\Ak1SlotWawancaraModel;

class Ak1Wawancara extends Component
{
    use WithPagination;
    public $periode;
    public $tahun;
    public $perpage=4;
    public $searchTerm='';
    public $total_record;
    public $slot_wwc;


    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    protected function rules()
    {
        return [

            'tahun' => 'required|digits:4|integer|min:2021|max:'.(date('Y')+6),

        ];

    }
    public function mount()
    {
        $this->PeriodeModel = new PeriodeModel();
        $this->periode      = $this->PeriodeModel::getPeriodeAktif();
        $this->slot_wwc     = Ak1SlotModel::where('kategori','wawancara_ak1')
                                ->where('NA',1)
                                ->orderBy('urutan','asc')
                                ->get();
    }
    public function render()
    {


        $searchTerm = '%'.$this->searchTerm.'%';
        $daftar_wawancara = Ak1WawancaraModel::where('NA','1')
                            ->where('periode','like',$searchTerm)
                            ->orderBy('periode','asc')
                            ->paginate($this->perpage);
        $this->total_record = $daftar_wawancara->total();
        return view('livewire.ak1-wawancara',['daftar_wawancara' => $daftar_wawancara]);
    }
    public function kosongkan()
    {
        $this->searchTerm = '';

    }



    public function store(Request $request)
    {
        $this->validate();

        $rand_wawancara      = Str::random(64); //random id untuk setiap record
        $tahun = $this->tahun;



        //Cek apakah program kerja pada tahun itu sudah ada
        //Jika sudah ada beri pesan bahwa program kerja tahun tersebut sudah ada
        //Jika belum ada insert
        //insert data program kerja tbl_wawancara.
        Ak1WawancaraModel::create([
            'rand_wawancara'=> $rand_wawancara,
            'periode'       => $tahun,
            'kategori'      => 'wawancara_ak1',
            'NA'            => '1',
        ]);

        // Siapkan collections hari dalam setahun kecuali weekend.
        $slot_tahunan     = TimeDimensionModel::where('year',$tahun)
        ->where('weekend_flag','f')
        ->orderBy('id','asc')
        ->get();


        $slot_harian     = Ak1SlotModel::where('kategori','wawancara_ak1')
        ->where('NA',1)
        ->orderBy('urutan','asc')
        ->get();
        //Setiap hari (dalam setahun) dibuatkan slot wawancara yg diambil dari tbl_slot
        //Kecuali hari weekend yaitu Sabtu dan Minggu. dilewati karena tidak ada layanan
        // menggunakan flag weekend_flag = false

        //Insert data Slot wawancara sejumlah slot perhari tersebut
        foreach ($slot_tahunan as $item) {


            foreach ($slot_harian as $itemharian) {
            $rand_slot_wwc      = Str::random(64);
            //Cek jika hari Jumat, slot nomer urut 19,20,21,22,23,24,25, libur layanan t
            // UPDATE `tbl_slot_wawancara` SET `libur_layanan` = 't' WHERE hari='Jumat' and urutan=21
            //Istirahat
            // UPDATE `tbl_slot_wawancara` SET `libur_layanan` = 't' WHERE  urutan=21
            Ak1SlotWawancaraModel::create([
                'rand_slot_wwc' => $rand_slot_wwc,
                'wawancara_id'  => $item->wawancara_id,
                'tahun'         => $tahun,
                'bulan'         => $item->month,
                'hari'          => $item->nama_hari,
                'tanggal'       => $item->db_date,
                'minggu_ke'     => $item->minggu_ke,
                'hari_libur'     => $item->harilibur_flag,
                'libur_layanan' => 'f',
                'waktu'         => $itemharian->waktu,
                'urutan'        => $itemharian->urutan,
            ]);
            }
        }
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('urutan', 25)
        ->update(['libur_layanan' => 't']);
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('urutan', 19)
        ->where('hari','Jumat')
        ->update(['libur_layanan' => 't']);
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('hari','Jumat')
        ->where('urutan', 20)
        ->update(['libur_layanan' => 't']);
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('hari','Jumat')
        ->where('urutan', 21)
        ->update(['libur_layanan' => 't']);
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('hari','Jumat')
        ->where('urutan', 22)
        ->update(['libur_layanan' => 't']);
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('hari','Jumat')
        ->where('urutan', 23)
        ->update(['libur_layanan' => 't']);
        Ak1SlotWawancaraModel::where('tahun', $tahun)
        ->where('hari','Jumat')
        ->where('urutan', 24)
        ->update(['libur_layanan' => 't']);

        $request->session()->flash('pesan_1','Data berhasil ditambahkan');
        $this->emit('postUpdated');
    }



}
