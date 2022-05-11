<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ak1Model;

class ShowKTPController extends Controller
{
    public function __construct()
    {
        $this->Ak1Model = new Ak1Model();
    }
    public function showKTP($rand_ak1)
    {
        $data =[
            'data_pemohon' =>$this->Ak1Model->detailData($rand_ak1),
        ];

        return view('backend.v_showktp',$data);

    }
}
