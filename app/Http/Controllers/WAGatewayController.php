<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ak1Model;

use App\Models\SeksiModel;
use App\Models\MenuModel;


class WAGatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->Ak1Model = new Ak1Model();
        $this->MenuModel = new MenuModel();
        $this->SeksiModel = new SeksiModel();

    }

    public function index()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
            'seksi' =>$this->SeksiModel->allData(),
            'ak1_list' =>$this->Ak1Model->allData(),
        ];

        return view('backend.v_wa-gateway',$data);

    }
}
