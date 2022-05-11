<?php

namespace App\Http\Controllers;

use App\Models\Ak1Model;
use App\Models\MenuModel;
use App\Models\SeksiModel;
use App\Models\KecamatanModel;
use App\Models\PendidikanAk1Model;
use App\Models\PelatihanAk1Model;
use App\Models\PengalamankerjaAk1Model;



use Illuminate\Http\Request;

class VerifikasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->Ak1Model = new Ak1Model();
        $this->MenuModel = new MenuModel();
        $this->SeksiModel = new SeksiModel();
        $this->KecamatanModel = new KecamatanModel();
        $this->PendidikanAk1Model = new PendidikanAk1Model();
        $this->PelatihanAk1Model = new PelatihanAk1Model();
        $this->PengalamankerjaAk1Model = new PengalamankerjaAk1Model();
    }

    public function verifikasi($rand_id)
    {

        if (!$this->Ak1Model->detailData($rand_id)) {

            abort(404);
        }


        $data =[
            'data_pemohon' =>$this->Ak1Model->detailData($rand_id),
            'data_pendidikan' =>$this->PendidikanAk1Model->allData($rand_id),
            'data_pelatihan' =>$this->PelatihanAk1Model->allData($rand_id),
            'data_pekerjaan' =>$this->PengalamankerjaAk1Model->allData($rand_id),
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'currentStep' =>1,
            'rand_ak1' =>$rand_id,

        ];




        return view('backend.v_verifikasi',$data);
    }

    public function nextStepVerification(Request $request) {

        $currentStep = Request()->currentStep;
        $rand_ak1 = Request()->rand_ak1;
        $nextStep = $currentStep+1;
        $list_ak1_preview = Ak1Model::where('rand_ak1',$rand_ak1)
        ->orderBy('ak1_id','asc')
        ->get();
        switch ($currentStep){
            case '1':
                //
                if($request->input('action')=='Berikutnya'){
                    $nextStep = $currentStep+1;
                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                        'dataPreview'=> $list_ak1_preview,
                    ];

                    return redirect()->back()->with('currentStep',$passData);
                }else{
                    $passData =[

                        'rand_ak1' =>$rand_ak1,

                    ];
                    return redirect()->back()->with('currentStep',$passData);

                }
                break;
            case '2':
                //
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                if($request->input('action')=='Berikutnya'){

                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }else{
                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,

                    ];
                    return redirect()->back()->with('currentStep',$passData);

                }

                break;
            case '3':
                //
                $nextStep       = $currentStep+1;
                $previousStep   = $currentStep-1;
                if($request->input('action')=='Berikutnya'){
                    $passData =[
                        'currentStep' =>$nextStep,
                        'rand_ak1' =>$rand_ak1,
                    ];
                    return redirect()->back()->with('currentStep',$passData);
                }else{
                    $passData =[
                        'currentStep' =>$previousStep,
                        'rand_ak1' =>$rand_ak1,

                    ];
                    return redirect()->back()->with('currentStep',$passData);

                }
                break;
            case '4':
                   //
                   $nextStep       = $currentStep+1;
                   $previousStep   = $currentStep-1;
                   if($request->input('action')=='Berikutnya'){
                       $passData =[
                           'currentStep' =>$nextStep,
                           'rand_ak1' =>$rand_ak1,
                       ];
                       return redirect()->back()->with('currentStep',$passData);
                   }else{
                       $passData =[
                           'currentStep' =>$previousStep,
                           'rand_ak1' =>$rand_ak1,

                       ];
                       return redirect()->back()->with('currentStep',$passData);

                   }
                   break;
            case '5':
                  //
                  $nextStep       = $currentStep+1;
                  $previousStep   = $currentStep-1;
                  $status_tahapan = Request()->status_tahapan;
                  $status_tahapan = filter_var($status_tahapan,FILTER_SANITIZE_NUMBER_INT);
                  if($request->input('action')=='Simpan'){

                    $dataVerifikasi =[
                        'tahapan' =>'Verifikasi',
                        'status_tahapan' =>$status_tahapan,
                    ];
                    $this->Ak1Model->updateData($dataVerifikasi,$rand_ak1);

                    $data =[
                        'menu' =>$this->MenuModel->allData(),
                        'layanan' =>$this->MenuModel->allLayananData(),
                        'rekom' =>$this->MenuModel->allRekomData(),
                        'seksi' =>$this->SeksiModel->allData(),
                        'dropdownKecamatan' =>$this->KecamatanModel->dropdownKecamatan(),
                        'ak1_list' =>$this->Ak1Model->allData(),
                    ];

                    return view('v_ak1daftar',$data);

                  }else{
                      $passData =[
                          'currentStep' =>$previousStep,
                          'rand_ak1' =>$rand_ak1,

                      ];
                      return redirect()->back()->with('currentStep',$passData);

                  }
                  break;
            default:
                // default
        } //end of switch-case

    }
}
