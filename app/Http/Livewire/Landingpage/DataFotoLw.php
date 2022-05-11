<?php

namespace App\Http\Livewire\Landingpage;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\Ak1Model;

class DataFotoLw extends Component
{
    use WithFileUploads;
    public $rand_ak1;
    public $foto_ktp;
    public $foto_diri;
    public $iteration=0;


    protected $rules =[
        'foto_ktp' => 'required',
        'foto_ktp.*' => 'image|mimes:jpg,jpeg,png|max2048',
        'foto_diri' => 'required',
        'foto_diri.*' => 'image|mimes:jpg,jpeg,png|max2048',
    ];
    protected $messages = [
        'foto_ktp.required' => 'Foto KTP wajib diisi.',
        'foto_diri.required' => 'Foto diri ukuran 3x4 wajib diisi.',
    ];


    public function mount($rand_ak1)

    {
        $this->Ak1Model = new Ak1Model();


    }


    public function render()
    {

            $datafoto =[
                'daftar_foto' =>$this->Ak1Model->detailFoto($this->rand_ak1),
            ];

            return view('livewire.landingpage.data-foto-lw',$datafoto);
    }



    public function submitFoto()
    {

        $this->validate();
        $rand_ak1 = $this->rand_ak1;
        $rand_ak1_foto_ktp  = Str::random(8); //random id untuk setiap record
        $rand_ak1_foto_diri = Str::random(8); //random id untuk setiap record
        $rand_ak1_foto      = Str::random(8); //random id untuk setiap record

        //Upload Foto KTP
        $filektp        = $this->foto_ktp;

        $fileNameKTP    = $rand_ak1_foto_ktp.'.'.$filektp->extension();
        $this->foto_ktp->storeAs('foto_ktp', $fileNameKTP);

        //Upload Foto Diri
        $filediri = $this->foto_diri;
        $fileNameDiri = $rand_ak1_foto_diri.'.'.$filediri->extension();
        $this->foto_diri->storeAs('foto_diri', $fileNameDiri);


        $datax = [
            'foto_ktp' => $fileNameKTP,
            'foto_diri' => $fileNameDiri,
            'rand_ak1' =>$rand_ak1,
            'rand_ak1_foto' =>$rand_ak1_foto,
            'tanggal' =>  date('Y-m-d H:i:s'),
        ];

        $data = [
            'foto_ktp' => $fileNameKTP,
            'foto_diri' => $fileNameDiri,
        ];
        //Update Foto
        $this->Ak1Model->updateData($data,$rand_ak1);


        //Cek jika sudah ada existing record, jika sudah ada update, jika belum insert addFoto. true or false
        //  $cekfoto = $this->DataFotoModel->cekFoto($rand_ak1);

        //  if ($cekfoto){
        //       $this->DataFotoModel->updateFoto($data,$rand_ak1);
        //   }else {
        //       //Jika belum ada
        //       $this->DataFotoModel->addFoto($data);
        //   }

        session()->flash('uploadexist', 'ok');
         //clean up
         $this->file_ktp=null;
         $this->file_diri=null;
         $this->iteration++;


        return redirect()->back();



    }

    public function gantiFoto()
    {
        $clearFoto = $this->Ak1Model->clearFoto($this->rand_ak1);

    }
}
