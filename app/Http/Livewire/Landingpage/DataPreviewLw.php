<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use App\Models\Ak1Model;
use App\Models\DataFotoModel;
use App\Models\PendidikanAk1Model;
use App\Models\PelatihanAk1Model;
use App\Models\PengalamankerjaAk1Model;

class DataPreviewLw extends Component
{
    public $list_ak1_preview;
    public $dataPreview = [];
    public $foto_ak1_preview;
    public $fotoPreview = [];
    public $pendidikan_ak1_preview;
    public $pendidikanPreview = [];
    public $pelatihan_ak1_preview;
    public $pelatihanPreview = [];
    public $pengalaman_kerja_ak1_preview;
    public $pengalamanKerjaPreview = [];

    public $rand_ak1;

    public function mount($rand_ak1)
    {
        $this->list_ak1_preview = Ak1Model::where('rand_ak1',$rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first();

        $this->pendidikan_ak1_preview = PendidikanAk1Model::where('rand_ak1',$rand_ak1)
        ->orderBy('ak1_pendidikan_id','asc')
        ->get();

        if ($this->pendidikan_ak1_preview) {
            foreach ($this->pendidikan_ak1_preview as $item) {
                $this->pendidikanPreview[] = [
                   'rand_ak1' => $item->rand_ak1,
                   'nama_tingkatpendidikan' => $item->nama_tingkatpendidikan,
                   'nama_institusi' => $item->nama_institusi,
                   'jurusan' => $item->jurusan,
                   'tahun_lulus' => $item->tahun_lulus,
                   'nilai' => $item->nilai,
                   'file_asli' => $item->file_asli,
               ];
            }
        }



        $this->pelatihan_ak1_preview = PelatihanAk1Model::where('rand_ak1',$rand_ak1)
        ->orderBy('ak1_pelatihan_id','asc')
        ->get();

        if ($this->pelatihan_ak1_preview) {
            foreach ($this->pelatihan_ak1_preview as $item) {
                $this->pelatihanPreview[] = [
                   'rand_ak1' => $item->rand_ak1,
                   'jenis_pelatihan' => $item->jenis_pelatihan,
                   'nama_jenispelatihan' => $item->nama_jenispelatihan,
                   'lembaga_pelatihan' => $item->lembaga_pelatihan,
                   'tahun' => $item->tahun,
                   'file_asli' => $item->file_asli,
               ];
            }
        }

        $this->pengalaman_kerja_ak1_preview = PengalamankerjaAk1Model::where('rand_ak1',$rand_ak1)
        ->orderBy('ak1_pekerjaan_id','asc')
        ->get();

        if ($this->pengalaman_kerja_ak1_preview) {
            foreach ($this->pengalaman_kerja_ak1_preview as $item) {
                $this->pengalamanKerjaPreview[] = [
                   'rand_ak1' => $item->rand_ak1,
                   'bidang_usaha' => $item->bidang_usaha,
                   'nama_perusahaan' => $item->nama_perusahaan,
                   'jabatan' => $item->jabatan,
                   'tahun' => $item->tahun,
                   'file_asli' => $item->file_asli,
               ];
            }
        }

    }
    public function render()
    {
        return view('livewire.landingpage.data-preview-lw');
    }
}
