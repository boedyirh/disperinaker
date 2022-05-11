<?php

namespace App\Http\Controllers;
use App\Models\MenuModel;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->MenuModel = new MenuModel();
    }


    public function index()
    {
        $data =[
            'menu' =>$this->MenuModel->allData(),
            'layanan' =>$this->MenuModel->allLayananData(),
            'rekom' =>$this->MenuModel->allRekomData(),
        ];
        return view('v_admin',$data);
    }
}
