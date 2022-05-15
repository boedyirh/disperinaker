<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengalamankerjaAk1Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_ak1_pekerjaan';
    protected $primaryKey = 'ak1_pekerjaan_id';


    public function addPengalamankerja($data)
    {
    return DB::table('tbl_ak1_pekerjaan')->insertGetId($data);
    }

    public function deletePengalamankerja($rand_ak1_pekerjaan)
    {
        return DB::table('tbl_ak1_pekerjaan')->where('rand_ak1_pekerjaan', '=', $rand_ak1_pekerjaan)->delete();
}

    public function updatePengalamankerja($data,$rand_ak1_pekerjaan)
    {
        DB::table('tbl_ak1_pekerjaan')
        ->where('rand_ak1_pekerjaan',$rand_ak1_pekerjaan)
        ->update($data);
    }

    public function allData($rand_ak1)
    {
        if(DB::table('tbl_ak1_pekerjaan')->where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty()){
            return DB::table('tbl_ak1_pekerjaan')
            ->where('rand_ak1',$rand_ak1)
            ->where('NA',1)
            ->get();
        }else{

            return NULL;
        }
    }

    public function pdfData($rand_ak1)
    {
        if(DB::table('tbl_ak1_pekerjaan')->where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty()){
            return DB::table('tbl_ak1_pekerjaan')
            ->where('rand_ak1',$rand_ak1)
            ->where('NA',1)
            ->where('dipakai',1)
            ->get();
        }else{

            return NULL;
        }
    }
}
