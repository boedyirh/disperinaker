<?php

namespace App\Http\Controllers;

use App\Models\Ak1Model;
use Illuminate\Support\Str;
use App\Models\KeldesaModel;
use Illuminate\Http\Request;
use App\Models\DropdownModel;
use App\Models\KecamatanModel;
use App\Models\SlotWawancaraModel;
use App\Models\PendidikanAk1Model;
use App\Models\TimeDimensionModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse ;

class Ak1Controller extends Controller
{
    public function __construct()
    {

        $this->Ak1Model = new Ak1Model();
        $this->SlotWawancaraModel = new SlotWawancaraModel();
        $this->PendidikanAk1Model = new PendidikanAk1Model();

    }
    public function nextStep(Request $request)
    {

        $currentStep = Request()->currentStep;
        $rand_ak1 = Request()->rand_ak1;

        switch ($currentStep){
            case '1':
                Request()->validate([
                    'nama' => 'required|min:4|max:255',
                    'nik' => 'required|regex:/(^[0-9 ]+$)+/',
                    'tempat_lahir' => 'required',
                    'jeniskelamin_id' => 'required',
                    'agama_id' => 'required',
                    'tgl_lahir' => 'required',
                    'kawin_id' => 'required',
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
                    'jeniskelamin_id.required' =>'Jenis Kelamin wajib diisi',
                    'agama_id.required' =>'Agama wajib diisi',
                    'kecamatan_id.required' =>'Kecamatan wajib diisi',
                    'keldesa_id.required' =>'Desa wajib diisi',
                    'alamat.required' =>'Alamat wajib diisi',
                    'nomer_hp.required' =>'Nomer HP wajib diisi',
                    'email.required' =>'Email wajib diisi',
                ]);

                $nama_kecamatan = getNamaKecamatan_from_id(Request()->kecamatan_id);
                $nama_keldesa  = getNamaKeldesa_from_id(Request()->keldesa_id);
                $nama_agama =   getLabelAgama_from_id(Request()->agama_id);
                $nama_jeniskelamin =  getNamaJenisKelamin_from_id(Request()->jeniskelamin_id);
                $status_kawin = getStatusKawin_from_id(Request()->kawin_id);
                if($rand_ak1!='0'){
                    //Edit
                    $data = [
                        'nama' => Request()->nama,
                        'nik' => Request()->nik,
                        'tempat_lahir' => Request()->tempat_lahir,
                        'tgl_lahir' => date('Y-m-d', strtotime(Request()->tgl_lahir)) ,
                        'jeniskelamin_id' => Request()->jeniskelamin_id,
                        'nama_jeniskelamin' => $nama_jeniskelamin,
                        'agama_id' => Request()->agama_id,
                        'nama_agama' => $nama_agama,
                        'kawin_id' => Request()->kawin_id,
                        'nama_kawin' => $status_kawin,
                        'kecamatan_id' => Request()->kecamatan_id,
                        'nama_kecamatan' => $nama_kecamatan,
                        'keldesa_id' => Request()->keldesa_id,
                        'nama_keldesa' => $nama_keldesa,
                        'alamat' => Request()->alamat,
                        'nomer_hp' => Request()->nomer_hp,
                        'email' => Request()->email,
                    ];
                    $this->Ak1Model->updateData($data,$rand_ak1);

                }else{
                    //Insert

                    $tanggal_sekarang = date("Y-m-d");
                    $minggu_ke    = TimeDimensionModel::where('db_date',$tanggal_sekarang)
                                       ->orderBy('id','asc')
                                       ->first();
                    $minggu_ke = $minggu_ke->minggu_ke;
                    $rand_ak1 = Str::random(64); //rand_ak1 adalah random ID (primary key) sebagai identitas yang dipakai setiap pencari kerja.

                    $data = [
                        'nama' => Request()->nama,
                        'nik' => Request()->nik,
                        'tempat_lahir' => Request()->tempat_lahir,
                        'tgl_lahir' => date('Y-m-d', strtotime(Request()->tgl_lahir)) ,
                        'jeniskelamin_id' => Request()->jeniskelamin_id,
                        'nama_jeniskelamin' => $nama_jeniskelamin,
                        'agama_id' => Request()->agama_id,
                        'nama_agama' => $nama_agama,
                        'kawin_id' => Request()->kawin_id,
                        'nama_kawin' => $status_kawin,
                        'kecamatan_id' => Request()->kecamatan_id,
                        'nama_kecamatan' => $nama_kecamatan,
                        'keldesa_id' => Request()->keldesa_id,
                        'nama_keldesa' => $nama_keldesa,
                        'alamat' => Request()->alamat,
                        'nomer_hp' => Request()->nomer_hp,
                        'email' => Request()->email,
                        'rand_ak1' =>$rand_ak1,
                        'tahun' =>idate("Y"),
                        'bulan' =>idate("m"),
                        'minggu_ke' => $minggu_ke,
                        'tanggal' =>$tanggal_sekarang,
                    ];

                    $this->Ak1Model->addData($data);


                }
                //Cek apakah user sudah pernah pilih Jadwal (true/false)
                $cek_slot = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);

                $nextStep = $currentStep+1;
                $passData =[
                    'currentStep' =>$nextStep,
                    'rand_ak1' =>$rand_ak1,
                    'sudah_pilih_jadwal'=>$cek_slot,
                ];

                return redirect()->back()->with('currentStep',$passData);
                break;
            case '2':
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                  //Cek apakah user sudah pernah pilih Jadwal (true/false)
                  $cek_slot = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);
                  $cek_pendidikan = $this->PendidikanAk1Model->cekSudahIsiPendidikan($rand_ak1);


                if($request->input('action')=='Berikutnya'){
                    if(!$cek_pendidikan){
                        $data_diri = Ak1Model::where('rand_ak1',$rand_ak1)
                        ->orderBy('ak1_id','asc')
                        ->get();

                          $passData =[
                              'currentStep' =>$currentStep,
                              'rand_ak1' =>$rand_ak1,
                              'sudah_pilih_jadwal' =>$cek_slot,
                              'data_diri' =>$data_diri,
                          ];
                          return redirect()->back()->with('currentStep',$passData);
                      }
                      else {
                        $passData =[
                            'currentStep' =>$nextStep,
                            'rand_ak1' =>$rand_ak1,
                            'sudah_pilih_jadwal'=>$cek_slot,

                        ];
                        return redirect()->back()->with('currentStep',$passData);


                      }




                }else{
                    $data_diri = Ak1Model::where('rand_ak1',$rand_ak1)
                    ->orderBy('ak1_id','asc')
                    ->get();


                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,
                        'data_diri' =>$data_diri,
                        'sudah_pilih_jadwal'=>$cek_slot,

                    ];
                    return redirect()->back()->with('currentStep',$passData);

                }
                break;
            case '3':
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                //Cek apakah user sudah isi Pendidikan (true/false)
                $cek_slot = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);

                if($request->input('action')=='Berikutnya'){
                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal'=>$cek_slot,

                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }else{

                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }
                break;
            case '4':
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                $cek_slot = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);
                if($request->input('action')=='Berikutnya'){
                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }else{
                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }
                break;
            case '5':
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                $cek_slot = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);
                if($request->input('action')=='Berikutnya'){
                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,

                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }else{
                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,

                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }
                break;
            case '6':
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                $cek_slot = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);
                if($request->input('action')=='Berikutnya'){
                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }else{
                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,

                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }
                break;
            case '7':
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;

                $cek_slot       = $this->SlotWawancaraModel->cekSudahAmbilJadwal($rand_ak1);
                if($request->input('action')=='Ajukan'){

                    // $dataSlot = DB::table('tbl_slot_wawancara')->where('sudah_dipesan', $rand_ak1)->first();
                    $dataSlot = SlotWawancaraModel::where('sudah_dipesan', $rand_ak1)->first();
                    $datafinalisasi =[
                        'completed' =>1,
                    ];

                    $this->Ak1Model->updateData($datafinalisasi,$rand_ak1);

                    $data =[
                        'rand_ak1' =>$rand_ak1,
                        'dataSlot' =>$dataSlot,
                    ];
                    return view('landingpage.v_sukses',$data);
                }else{
                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,
                        'sudah_pilih_jadwal' =>$cek_slot,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }
                break;
            default:


        }





    }

    public function step1DataDiri()
    {

           $passData =[
            'currentStep' =>1,
            'rand_ak1' =>'0',
            'data_diri' =>'0',
            'sudah_pilih_jadwal' =>false,
            'd_agama' =>DropdownModel::where('dropdown_type','agama')->where('NA','1')->orderBy('urutan')->get(['value_dropdown','label_dropdown']),
        ];


        return view('landingpage.v_home',$passData);
    }
}
