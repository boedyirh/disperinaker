<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ak1Model;
use App\Models\DropdownModel;
use App\Models\SeksiModel;
use App\Models\MenuModel;
use App\Models\KecamatanModel;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->Ak1Model = new Ak1Model();
        $this->MenuModel = new MenuModel();
        $this->SeksiModel = new SeksiModel();
        $this->KecamatanModel = new KecamatanModel();
    }

    public function index()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'seksi' =>$this->SeksiModel->allData(),
            'dropdownKecamatan' =>$this->KecamatanModel->dropdownKecamatan(),
            'ak1_list' =>$this->Ak1Model->allData(),
        ];

        return view('backend.v_ak1',$data);

    }

    public function daftar()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'seksi' =>$this->SeksiModel->allData(),
            'dropdownKecamatan' =>$this->KecamatanModel->dropdownKecamatan(),
            'ak1_list' =>$this->Ak1Model->allData(),
        ];

        return view('backend.v_ak1daftar',$data);

    }

    public function proses_hari_ini()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'seksi' =>$this->SeksiModel->allData(),
            'dropdownKecamatan' =>$this->KecamatanModel->dropdownKecamatan(),
            'ak1_list' =>$this->Ak1Model->allData(),
        ];

        return view('v_ak1_proses_hari_ini',$data);

    }

    public function daftargagal()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'seksi' =>$this->SeksiModel->allData(),
            'dropdownKecamatan' =>$this->KecamatanModel->dropdownKecamatan(),
            'ak1_list' =>$this->Ak1Model->allData(),
        ];

        return view('backend.v_daftargagal',$data);

    }

    public function pendaftaran()
    {
        $data =[

            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'rand_ak1'=>'',
            'currentStep'=>1,
            'maxStep'=>1,
            'dari_step'=>0,


        ];
        return view('v_ak1pendaftaran',$data);
    }

    public function penetapan_libur()
    {
        $data =[

            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'rand_ak1'=>'',
            'currentStep'=>1,
            'maxStep'=>1,
            'dari_step'=>0,


        ];
        return view('v_penetapan_libur',$data);
    }

    public function postDataDiri(Request $request)
     {
         Request()->validate([
             'nama' => 'required|min:4|max:255',
             'nik' => 'required|regex:/(^[0-9 ]+$)+/',
             'tempat_lahir' => 'required',
             'tgl_lahir' => 'required|date_format:d-m-Y',
             'jeniskelamin_id' => 'required',
             'tinggi' => 'required|numeric',
             'berat' => 'required|numeric',
             'agama_id' => 'required',
             'alamat' => 'required',
             'kecamatan_id' => 'required',
             'keldesa_id' => 'required',
             'nomer_hp' => 'required|regex:/(^[0-9 ]+$)+/',
             'email' => 'required',
         ],[
             'nama.required'=>'Nama wajib diisi',
             'nik.required' =>'NIK wajib diisi',
             'nik.regex' =>'Format NIK hanya boleh angka dan spasi',
             'tempat_lahir.required' =>'Tempat Lahir wajib diisi',
             'tgl_lahir.required' =>'Tgl Lahir wajib diisi',
             'tgl_lahir.date_format' =>'Contoh format tanggal 24-11-2007',
             'jeniskelamin_id.required' =>'Jenis Kelamin wajib diisi',
             'tinggi.required' =>'Tinggi badan wajib diisi',
             'tinggi.numeric' =>'Tinggi badan diisi angka pembulatan',
             'berat.required' =>'Berat Badan wajib diisi',
             'berat.numeric' =>'Berat Badan diisi angka pembulatan',
             'agama_id.required' =>'Agama wajib diisi',
             'kecamatan_id.required' =>'Kecamatan wajib diisi',
             'keldesa_id.required' =>'Desa wajib diisi',
             'alamat.required' =>'Alamat wajib diisi',
             'nomer_hp.required' =>'Nomer HP wajib diisi',
             'email.required' =>'Email wajib diisi',
         ]);

         //Jika validasi sukses, simpan data utama pencari kerja
         $rand_ak1 = Str::random(64); //rand_ak1 adalah random ID (primary key) sebagai identitas yang dipakai setiap pencari kerja.
         $data = [
             'nama' => Request()->nama,
             'nik' => Request()->nik,
             'tempat_lahir' => Request()->tempat_lahir,
             'tgl_lahir' => date('Y-m-d', strtotime(Request()->tgl_lahir)) ,
             'jeniskelamin_id' => Request()->jeniskelamin_id,
             'tinggi' => Request()->tinggi,
             'berat' => Request()->berat,
             'agama_id' => Request()->agama_id,
             'kecamatan_id' => Request()->kecamatan_id,
             'keldesa_id' => Request()->keldesa_id,
             'alamat' => Request()->alamat,
             'nomer_hp' => Request()->nomer_hp,
             'email' => Request()->email,
             'rand_ak1' =>$rand_ak1,
         ];
         $this->Ak1Model->addData($data);
         $data2 =[

            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'currentStep'=>2,
            'maxStep'=>2,
            'dari_step'=>1,
            'rand_ak1'=>$rand_ak1,
        ];
         return view('v_ak1pendaftaran',$data2);

     }

     public function postPendidikan(Request $request)
     {
         Request()->validate([
             'tingkat_pendidikan' => 'required',
             'nama_institusi' => 'required',
             'jurusan' => 'required',
             'tahun_lulus' => 'required',
             'nilai' => 'required',

         ],[
             'tingkat_pendidikan.required'=>'Tingkat Pendidikan wajib diisi',
             'nama_institusi.required' =>'Nama Institusi wajib diisi',
             'jurusan.required' =>'Jurusan wajib diisi',
             'tahun_lulus.required' =>'Tahun Lulus wajib diisi',
             'nilai.required' =>'Nilai wajib diisi',

         ]);

         //Jika validasi sukses, simpan data utama pencari kerja
         $rand_ak1 = Request()->rand_ak1; //rand_ak1 adalah random ID (primary key) sebagai identitas yang dipakai setiap pencari kerja.
         $rand_ak1_pendidikan = Str::random(64); //rand_ak1 adalah random ID (primary key) sebagai identitas yang dipakai setiap pencari kerja.
         $nama_tingkatpendidikan   = DropdownModel::where('dropdown_type','tingkat_pendidikan')
                                    ->where('value_dropdown',Request()->tingkat_pendidikan)
                                    ->where('NA','1')
                                    ->first();
         $data_insert= [
             'tingkat_pendidikan' => Request()->tingkat_pendidikan,
             'nama_tingkatpendidikan' =>  $nama_tingkatpendidikan->label_dropdown,
             'nama_institusi' => Request()->nama_institusi,
             'jurusan' => Request()->jurusan,
             'tahun_lulus' => Request()->tahun_lulus,
             'nilai' => Request()->nilai,
             'rand_ak1_pendidikan' => $rand_ak1_pendidikan,
             'rand_ak1' => $rand_ak1,
         ];
         $this->Ak1Model->addPendidikan($data_insert);

         $data_view =[

            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'currentStep'=>3,
            'maxStep'=>3,
            'rand_ak1'=>$rand_ak1,
        ];

        // return redirect()->back();
        return view('v_ak1pendaftaran',$data_view);
     }

     public function postUploadFoto(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
        switch ($request->input('action')) {
            case 'step1':

                $data1 =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'rand_ak1' =>$rand_ak1,
                   'currentStep'=>1,
                   'maxStep'=>1,
               ];
                return view('v_ak1pendaftaran',$data1);
                break;

            case 'step3':

                Request()->validate([
                    'foto_ktp' => 'required',
                    'foto_ktp.*' => 'image|mimes:jpg,jpeg,png|max2048',
                    'foto_diri' => 'required',
                    'foto_diri.*' => 'image|mimes:jpg,jpeg,png|max2048',
                ],[
                    'foto_ktp.required' =>'Foto KTP wajib ada',
                    'foto_diri.required'=>'Foto 3x4 wajib ada',
                ]);

                $rand_ak1_foto_ktp = Str::random(14); //random id untuk setiap record
                $rand_ak1_foto_diri = Str::random(14); //random id untuk setiap record
                $rand_ak1_foto = Str::random(64); //random id untuk setiap record

                //Upload Foto KTP
                $filektp = Request()->foto_ktp;
                $fileNameKTP = $rand_ak1_foto_ktp.'.'.$filektp->extension();
                $filektp->move(public_path('foto_diri'),$fileNameKTP);

                //Upload Foto Diri
                $filediri = Request()->foto_diri;
                $fileNameDiri = $rand_ak1_foto_diri.'.'.$filediri->extension();
                $filediri->move(public_path('foto_diri'),$fileNameDiri);


                $data = [
                    'foto_ktp' => $fileNameKTP,
                    'foto_diri' => $fileNameDiri,
                    'rand_ak1' =>$rand_ak1,
                    'rand_ak1_foto' =>$rand_ak1_foto,
                    'tanggal' =>  date('Y-m-d H:i:s'),
                ];


                $this->Ak1Model->addFoto($data);
                $data3 =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'rand_ak1' =>$rand_ak1,
                   'currentStep'=>3,
                   'maxStep'=>3,
               ];
                return view('v_ak1pendaftaran',$data3);
                break;
        }
     }

     public function postPekerjaan(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
         Request()->validate([
             'jenis_usaha' => 'required',
             'jabatan' => 'required',
             'awal_masuk' => 'required',
             'sampai_tanggal' => 'required',
         ],[
             'jenis_usaha.required'=>'Jenis Usaha wajib diisi',
             'jabatan.required' =>'Jabatan wajib diisi',
             'awal_masuk.required' =>'Awal masuk wajib diisi',
             'sampai_tanggal.required' =>'Sampai Tanggal wajib diisi',
         ]);

         //Jika validasi sukses, simpan data dan upload gambar
         $data = [
             'jenis_usaha' => Request()->jenis_usaha,
             'jabatan' => Request()->jabatan,
             'awal_masuk' => Request()->awal_masuk,
             'sampai_tanggal' => Request()->sampai_tanggal,
             'rand_ak1_pekerjaan' =>Str::random(64),
             'rand_ak1' =>Request()->rand_ak1,
         ];
         $this->Ak1Model->addPekerjaan($data);
         $data5 =[

            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'rand_ak1' =>Request()->rand_ak1,
            'currentStep'=>5,
            'maxStep'=>5,
        ];
         return view('v_ak1pendaftaran',$data5);
     }
     public function postStep1(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;

        switch ($request->input('action')) {
            case 'step2':
                $data2 =[
                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>2,
                   'dari_step'=>1,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data2);
                break;
        }
     }

     public function postStep2(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
        switch ($request->input('action')) {
            case 'step1':
                $data1 =[
                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>1,
                   'maxStep'=>1,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                $request->session()->flash('step1-2','dari 2 ke 1');
                // $request->session()->flash('pesan_1','Dari Step 2 kembali ke step 1');

                return view('v_ak1pendaftaran',$data1);
                break;

            case 'step3':
               $data3 =[
                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),

                   'currentStep'=>3,
                   'maxStep'=>3,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data3);
                break;
        }
     }
     public function postStep3(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
        switch ($request->input('action')) {
            case 'step2':
                $data2 =[
                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>2,
                   'maxStep'=>2,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data2);
                break;

            case 'step4':

                $data4 =[
                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>4,
                   'maxStep'=>4,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data4);
                break;
        }
     }

     public function postStep4(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
        switch ($request->input('action')) {
            case 'step3':

                $data3 =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>3,
                   'maxStep'=>3,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data3);
                break;

            case 'step5':
                // $data = [
                //     'foto_file' => 'Testing Foto',
                //     'ktp_file' => 'Testing KTP',
                // ];

                // $this->Ak1Model->addData($data);
                $data5 =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),

                   'currentStep'=>5,
                   'maxStep'=>5,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data5);
                break;
        }
     }

     public function postStep5(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
        switch ($request->input('action')) {
            case 'step4':

                $data4 =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>4,
                   'maxStep'=>4,
               ];
               $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data4);
                break;

            case 'step6':

                $datafinal =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>6,
                   'maxStep'=>6,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$datafinal);
                break;
        }
     }

     public function postStep6(Request $request)
     {
        $rand_ak1 = Request()->rand_ak1;
        switch ($request->input('action')) {
            case 'step5':

                $data5 =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>5,
                   'maxStep'=>5,
               ];
               $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$data5);
                break;

            case 'stepfinal':

                $datafinal =[

                   'layanan' =>$this->MenuModel->allLayananData(),
                   'rekom' =>$this->MenuModel->allRekomData(),
                   'currentStep'=>7,
                   'maxStep'=>7,
               ];
                $request->session()->flash('rand_ak1',$rand_ak1);
                return view('v_ak1pendaftaran',$datafinal);
                break;
        }
     }



}
