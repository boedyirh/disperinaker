<?php

namespace App\Http\Livewire\Backend;

use Livewire\Component;
use App\Models\Ak1Model;

class ShowBiodata extends Component
{
    public $data_pemohon;
    public $rand_ak1;
    public $nama_edit= false;
    public $nomer_hp_edit =false;
    public $jeniskelamin_edit =false;
    public $kawin_edit =false;
    public $tempat_lahir_edit =false;
    public $tgl_lahir_edit =false;
    public $agama_edit =false;

    public $nama;
    public $nomer_hp;
    public $nama_jeniskelamin;
    public $jeniskelamin_id;
    public $nama_kawin;
    public $nama_agama;
    public $agama_id;
    public $kawin_id;
    public $tgl_lahir;

    private function checkEdit($field)
    {
        switch ($field){
            case 'nama':
                if($this->nomer_hp_edit){$this->addError('pesan_hp_selesaikan','Belum selesai.');return;}
                if($this->jeniskelamin_edit){$this->addError('pesan_jk_selesaikan','Belum selesai.');return;}
                if($this->kawin_edit){$this->addError('pesan_kawin_selesaikan','Belum selesai.');return;}
                if($this->tempat_lahir_edit){$this->addError('pesan_tpt_selesaikan','Belum selesai.');return;}
                if($this->tgl_lahir_edit){$this->addError('pesan_tgl_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->nama_edit = true;
                break;
            case 'nomer_hp':
                if($this->nama_edit){$this->addError('pesan_nama_selesaikan','Belum selesai.');return;}
                if($this->jeniskelamin_edit){$this->addError('pesan_jk_selesaikan','Belum selesai.');return;}
                if($this->kawin_edit){$this->addError('pesan_kawin_selesaikan','Belum selesai.');return;}
                if($this->tempat_lahir_edit){$this->addError('pesan_tpt_selesaikan','Belum selesai.');return;}
                if($this->tgl_lahir_edit){$this->addError('pesan_tgl_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->nomer_hp_edit = true;
                break;
            case 'jeniskelamin':
                if($this->nama_edit){$this->addError('pesan_nama_selesaikan','Belum selesai.');return;}
                if($this->nomer_hp_edit){$this->addError('pesan_hp_selesaikan','Belum selesai.');return;}
                if($this->kawin_edit){$this->addError('pesan_kawin_selesaikan','Belum selesai.');return;}
                if($this->tempat_lahir_edit){$this->addError('pesan_tpt_selesaikan','Belum selesai.');return;}
                if($this->tgl_lahir_edit){$this->addError('pesan_tgl_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->jeniskelamin_edit = true;
                break;
            case 'statuskawin':
                if($this->nama_edit){$this->addError('pesan_nama_selesaikan','Belum selesai.');return;}
                if($this->nomer_hp_edit){$this->addError('pesan_hp_selesaikan','Belum selesai.');return;}
                if($this->jeniskelamin_edit){$this->addError('pesan_jk_selesaikan','Belum selesai.');return;}
                if($this->tempat_lahir_edit){$this->addError('pesan_tpt_selesaikan','Belum selesai.');return;}
                if($this->tgl_lahir_edit){$this->addError('pesan_tgl_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->kawin_edit = true;
                break;
            case 'tempatlahir':
                if($this->nama_edit){$this->addError('pesan_nama_selesaikan','Belum selesai.');return;}
                if($this->nomer_hp_edit){$this->addError('pesan_hp_selesaikan','Belum selesai.');return;}
                if($this->jeniskelamin_edit){$this->addError('pesan_jk_selesaikan','Belum selesai.');return;}
                if($this->kawin_edit){$this->addError('pesan_kawin_selesaikan','Belum selesai.');return;}
                if($this->tgl_lahir_edit){$this->addError('pesan_tgl_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->tempat_lahir_edit = true;
                break;
            case 'tgl_lahir':
                if($this->nama_edit){$this->addError('pesan_nama_selesaikan','Belum selesai.');return;}
                if($this->nomer_hp_edit){$this->addError('pesan_hp_selesaikan','Belum selesai.');return;}
                if($this->jeniskelamin_edit){$this->addError('pesan_jk_selesaikan','Belum selesai.');return;}
                if($this->kawin_edit){$this->addError('pesan_kawin_selesaikan','Belum selesai.');return;}
                if($this->tempat_lahir_edit){$this->addError('pesan_tpt_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->tgl_lahir_edit = true;
                break;
            case 'agama':
                if($this->nama_edit){$this->addError('pesan_nama_selesaikan','Belum selesai.');return;}
                if($this->nomer_hp_edit){$this->addError('pesan_hp_selesaikan','Belum selesai.');return;}
                if($this->jeniskelamin_edit){$this->addError('pesan_jk_selesaikan','Belum selesai.');return;}
                if($this->kawin_edit){$this->addError('pesan_kawin_selesaikan','Belum selesai.');return;}
                if($this->tempat_lahir_edit){$this->addError('pesan_tpt_selesaikan','Belum selesai.');return;}
                if($this->tgl_lahir_edit){$this->addError('pesan_tgl_selesaikan','Belum selesai.');return;}
                if($this->agama_edit){$this->addError('pesan_agama_selesaikan','Belum selesai.');return;}
                $this->agama_edit = true;
                break;
                default:




        }
    }

    private function resetField()
    {
        $this->nama_edit= false;
        $this->nomer_hp_edit =false;
        $this->jeniskelamin_edit =false;
        $this->kawin_edit =false;
        $this->tempat_lahir_edit =false;
        $this->tgl_lahir_edit =false;
        $this->agama_edit =false;
    }
    public function mount($rand_ak1)
    {
        $this->rand_ak1 = $rand_ak1;
        $this->Ak1Model = new Ak1Model();
        $this->data_pemohon  = Ak1Model::where('rand_ak1',$this->rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first();


        $this->nama = $this->data_pemohon->nama;
        $this->nomer_hp = $this->data_pemohon->nomer_hp;
        $this->nama_jeniskelamin = $this->data_pemohon->nama_jeniskelamin;
        $this->nama_kawin = $this->data_pemohon->nama_kawin;
        $this->tempat_lahir = $this->data_pemohon->tempat_lahir;
        $this->tgl_lahir = $this->data_pemohon->tgl_lahir;
        $this->nama_agama = $this->data_pemohon->nama_agama;

    }
    public function render()
    {


        return view('livewire.backend.show-biodata');
    }

    public function editNama()
    {

        $this->checkEdit('nama');

    }

    public function updateNama()
    {
        if(strlen($this->nama)>3){
            $data = [
                'nama' => $this->nama,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        } else {
            $this->nama = $this->data_pemohon->nama;
        }
        // $this->nama_edit = ($this->nama_edit == true) ? false : true;
        $this->nama_edit= false;
        $this->nomer_hp_edit =false;
        $this->jeniskelamin_edit =false;
        $this->kawin_edit =false;
        $this->tempat_lahir_edit =false;
        $this->tgl_lahir_edit =false;
        $this->agama_edit =false;


    }

    public function updatedNama()
    {
        if(strlen($this->nama)>3){
            $data = [
                'nama' => $this->nama,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        } else {
            $this->nama = $this->data_pemohon->nama;
        }
        $this->resetField();


    }



    public function editNomerHP()
    {
        $this->checkEdit('nomer_hp');
    }
    public function updateNomerHP()
    {
        if(strlen($this->nomer_hp)>7){
            $data = [
                'nomer_hp' => $this->nomer_hp,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->nomer_hp = $this->data_pemohon->nomer_hp;
        }
        $this->resetField();


    }

    public function updatedNomerHP()
    {
        if(strlen($this->nomer_hp)>7){
            $data = [
                'nomer_hp' => $this->nomer_hp,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->nomer_hp = $this->data_pemohon->nomer_hp;
        }
        $this->resetField();

    }


    public function editJenisKelamin()
    {
        $this->checkEdit('jeniskelamin');

    }
    public function updateJenisKelamin()
    {
        $jkel = getNamaJenisKelamin_from_id($this->jeniskelamin_id);
        if(in_array($this->jeniskelamin_id, array(1,2)))
        {
            $data = [
                'jeniskelamin_id' => $this->jeniskelamin_id,
                'nama_jeniskelamin' => $jkel,
            ];
            $this->nama_jeniskelamin = $jkel;
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->nama_jeniskelamin = $this->data_pemohon->nama_jeniskelamin;
        }

        $this->resetField();

    }

    public function editKawin()
    {
        $this->checkEdit('statuskawin');
    }


    public function updateKawin()
    {
        $statuskawin = getStatusKawin_from_id($this->kawin_id);
        if(in_array($this->kawin_id, array(1,2)))
        {
            $data = [
                'kawin_id' => $this->kawin_id,
                'nama_kawin' => $statuskawin,
            ];
            $this->nama_kawin = $statuskawin;
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->nama_kawin = $this->data_pemohon->nama_kawin;
        }
        $this->resetField();

    }

    public function editTempatLahir()
    {
        // $this->tempat_lahir_edit = ($this->tempat_lahir_edit == true) ? false : true;
        $this->checkEdit('tempatlahir');
    }
    public function updateTempatLahir()
    {
        if(strlen($this->tempat_lahir)>3){
            $data = [
                'tempat_lahir' => $this->tempat_lahir,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->tempat_lahir = $this->data_pemohon->tempat_lahir;
        }
        $this->resetField();


    }

    public function editTglLahir()
    {
        $this->checkEdit('tgl_lahir');
    }


    public function updatedTglLahir(){

        if(strlen($this->tgl_lahir)>8){
            $data = [
                'tgl_lahir' => $this->tgl_lahir,
            ];
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->tgl_lahir = $this->data_pemohon->tgl_lahir;
        }

        $this->resetField();

    }

    public function editAgama()
    {
        $this->checkEdit('agama');
    }




    public function updateAgama()
    {
        $label_agama = getLabelAgama_from_id($this->agama_id);
        if(in_array($this->agama_id, array(1,2,3,4,5,6,7)))
        {
            $data = [
                'agama_id' => $this->agama_id,
                'nama_agama' => $label_agama,
            ];
            $this->nama_agama = $label_agama;
            $this->Ak1Model->updateData($data,$this->rand_ak1);
        }else {
            $this->nama_agama = $this->data_pemohon->nama_agama;
        }

        $this->resetField();


    }




}
