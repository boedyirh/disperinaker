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
    }

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function generatePDF($rand_id)

    {

        $data =[
            'data_pemohon' =>$this->Ak1Model->detailData($rand_id),
            'data_pendidikan' =>$this->PendidikanAk1Model->pdfData($rand_id),
            'data_pelatihan' =>$this->PelatihanAk1Model->pdfData($rand_id),
            'data_pekerjaan' =>$this->PengalamankerjaAk1Model->pdfData($rand_id),
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
        ];



        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true,'setPaper'=>'legal'])->loadView('backend.myPDF', $data)->stream();
    }

}