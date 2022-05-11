<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Ak1Model;
use App\Models\KecamatanModel;
use App\Models\KeldesaModel;

class ShowAlamat extends Component
{
    public $data_pemohon;
    public $rand_ak1;
    public $alamat_edit =false;
    public $kecamatan_edit=false;
    public $keldesa_edit=false;
    public $alamat;
    public $kecamatan;
    public $nama_kecamatan;
    public $kecamatan_id;
    public $keldesa;
    public $nama_keldesa;
    public $keldesa_id;

    private function checkEdit($field)
    {
        switch ($field){
            case 'alamat':
                if($this->kecamatan_edit){$this->addError('pesan_kecamatan_selesaikan','Belum selesai.');return;}
                if($this->keldesa_edit){$this->addError('pesan_keldesa_selesaikan','Belum selesai.');return;}
                $this->alamat_edit = true;
                break;
            case 'kecamatan':
                if($this->alamat_edit){$this->addError('pesan_alamat_selesaikan','Belum selesai.');return;}
                // if($this->keldesa_edit){$this->addError('pesan_keldesa_selesaikan','Belum selesai.');return;}

                $this->keldesa_edit = true;
                $this->kecamatan_edit = true;
                break;
            case 'keldesa':
                if($this->alamat_edit){$this->addError('pesan_alamat_selesaikan','Belum selesai.');return;}
                // if($this->kecamatan_edit){$this->addError('pesan_kecamatan_selesaikan','Belum selesai.');return;}
                $this->keldesa_edit = true;
                break;
                default:
        }
    }

    private function resetField()
    {
        $this->alamat_edit= false;
        $this->kecamatan_edit =false;
        $this->keldesa_edit =false;
    }

    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->data_pemohon  = Ak1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first();
        $this->kecamatan = KecamatanModel::where('status',1)
        ->orderBy('nama_kecamatan','asc')
        ->get(['kecamatan_id','nama_kecamatan']);



        $this->alamat = $this->data_pemohon->alamat;
        $this->nama_kecamatan = $this->data_pemohon->nama_kecamatan;
        $this->kecamatan_id = $this->data_pemohon->kecamatan_id;
        $this->nama_keldesa = $this->data_pemohon->nama_keldesa;
        $this->keldesa_id = $this->data_pemohon->keldesa_id;

        if (!is_null($this->kecamatan_id)) {
            $this->keldesa = KeldesaModel::where('kecamatan_id', $this->kecamatan_id)
            ->orderBy('nama_keldesa','asc')
            ->get(['id_keldesa_gabungan','nama_keldesa']);
        }

    }
    public function render()
    {
        return view('livewire.backend.show-alamat');
    }

    public function editAlamat()
    {
        // $this->alamat_edit = ($this->alamat_edit == true) ? false : true;
        $this->checkEdit('alamat');
    }
    public function updateAlamat()
    {
        if(strlen($this->alamat)>3){
            $data = [
                'alamat' => $this->alamat,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->alamat = $this->data_pemohon->alamat;
        }

        $this->resetField();
    }

    public function editKecamatan()
    {
        // $this->kecamatan_edit = ($this->kecamatan_edit == true) ? false : true;
        $this->checkEdit('kecamatan');
    }

    public function editKeldesa()
    {
        // $this->keldesa_edit = ($this->keldesa_edit == true) ? false : true;
        $this->checkEdit('keldesa');
    }




    public function updatedKecamatanId()
    {

        $nama_kecamatan = getNamaKecamatan_from_id($this->kecamatan_id);
        if(strlen($this->kecamatan_id)==2){
            $data = [
                'kecamatan_id' => $this->kecamatan_id,
                'nama_kecamatan' =>$nama_kecamatan,
             ];
            $this->nama_kecamatan = $nama_kecamatan;
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {

            $this->kecamatan_id = $this->data_pemohon->kecamatan_id;
            $this->nama_kecamatan = $this->data_pemohon->nama_kecamatan;
        }
        $this->keldesa_edit = true;
        // $this->kecamatan_edit = ($this->kecamatan_edit == true) ? false : true;
        $this->alamat_edit =false;
        $this->kecamatan_edit=false;
        // $this->keldesa_edit=false;



        if (!is_null($this->kecamatan_id)) {
            $this->keldesa = KeldesaModel::where('kecamatan_id', $this->kecamatan_id)
            ->orderBy('nama_keldesa','asc')
            ->get(['id_keldesa_gabungan','nama_keldesa']);
        }
    }

    public function updatedKeldesaId()
    {
        $nama_keldesa = getNamaKeldesa_from_id($this->keldesa_id);
        if(strlen($this->keldesa_id)==6){
            $data = [
                'keldesa_id' => $this->keldesa_id,
                'nama_keldesa' =>$nama_keldesa,
             ];
            $this->nama_keldesa = $nama_keldesa;
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {

            $this->keldesa_id = $this->data_pemohon->keldesa_id;
            $this->nama_keldesa = $this->data_pemohon->nama_keldesa;
        }
        // $this->keldesa_edit = ($this->keldesa_edit == true) ? false : true;
        // $this->alamat_edit =false;
        // $this->kecamatan_edit=false;
        // $this->keldesa_edit=false;
        $this->resetField();
    }



}
