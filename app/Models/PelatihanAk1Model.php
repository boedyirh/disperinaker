<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PelatihanAk1Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_ak1_pelatihan';
    protected $primaryKey = 'ak1_pelatihan_id';


    public function addPelatihan($data)
    {
    return DB::table('tbl_ak1_pelatihan')->insertGetId($data);
    }

    public function deletePelatihan($rand_ak1_pelatihan)
    {
        return DB::table('tbl_ak1_pelatihan')->where('rand_ak1_pelatihan', '=', $rand_ak1_pelatihan)->delete();
}

    public function updatePelatihan($data,$rand_ak1_pelatihan)
    {
        DB::table('tbl_ak1_pelatihan')
        ->where('rand_ak1_pelatihan',$rand_ak1_pelatihan)
        ->update($data);
    }
    public function allData($rand_ak1)
    {
        if(DB::table('tbl_ak1_pelatihan')->where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty())
        {
            return DB::table('tbl_ak1_pelatihan')
            ->where('rand_ak1',$rand_ak1)
            ->where('NA',1)
            ->get();
        }
        else {
            return NULL;
        }

    }
    public function pdfData($rand_ak1)
    {
        if(DB::table('tbl_ak1_pelatihan')->where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty())
        {
            return DB::table('tbl_ak1_pelatihan')
            ->where('rand_ak1',$rand_ak1)
            ->where('NA',1)
            ->where('dipakai',1)
            ->get();
        }
        else {
            return NULL;
        }

    }
}
