<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ak1Model;
use App\Models\DropdownModel;
use App\Models\Ak1WawancaraModel;
use App\Models\SeksiModel;
use App\Models\MenuModel;


class Ak1wawancaraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Ak1Model = new Ak1Model();
        $this->MenuModel = new MenuModel();
        $this->SeksiModel = new SeksiModel();
        $this->Ak1WawancaraModel = new Ak1WawancaraModel();

    }

    public function wawancara()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'seksi' =>$this->SeksiModel->allData(),
            'ak1_wawancara_list' =>$this->Ak1WawancaraModel->allData(),
        ];

        return view('v_wawancara',$data);

    }

}
