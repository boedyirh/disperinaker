<?php



namespace App\Http\Controllers;



use App\Models\Ak1Model;
use App\Models\MenuModel;
use App\Models\SeksiModel;
use App\Models\KecamatanModel;
use App\Models\PendidikanAk1Model;
use App\Models\PelatihanAk1Model;
use App\Models\PengalamankerjaAk1Model;
use App\Models\Ak1CetakModel;


use Illuminate\Http\Request;

use PDF;



class PDFController extends Controller

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
        $this->Ak1CetakModel = new Ak1CetakModel();
    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF($rand_ak1)

    {
        $last_agenda = $this->Ak1CetakModel->getLastAgenda(date('Y'),$rand_ak1);

        $data =[
            'last_agenda'=>$last_agenda['nomer'],
            'tgl_ambil'=>$last_agenda['tgl_ambil'],
            'data_pemohon' =>$this->Ak1Model->detailData($rand_ak1),
            'data_pendidikan' =>$this->PendidikanAk1Model->pdfData($rand_ak1),
            'data_pelatihan' =>$this->PelatihanAk1Model->pdfData($rand_ak1),
            'data_pekerjaan' =>$this->PengalamankerjaAk1Model->pdfData($rand_ak1),
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
        ];

        $data_diri = Ak1Model::where('rand_ak1',$rand_ak1)
        ->orderBy('ak1_id','asc')
        ->first();


        $data_cetak =[
            'rand_ak1'=>$rand_ak1,
            'nama'=>$data_diri->nama,
            'kecamatan'=>$data_diri->nama_kecamatan,
            'keldesa'=>$data_diri->nama_keldesa,
            'tahun'=>date("Y"),
            'nomer_urut'=>$last_agenda['nomer'],
            'tgl_ambil'=>date("Y-m-d"),

        ];

        $this->Ak1CetakModel->addData($data_cetak);


        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'setPaper'=>'legal'])->loadView('backend.myPDF', $data)->stream();
    }

}