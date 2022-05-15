<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ak1CetakModel extends Model
{
    protected $table = 'tbl_cetak';
    protected $primaryKey = 'id';

    use HasFactory;

    public function getLastAgenda($year,$rand_ak1){
        //Check apakah sudah ada record dengan rand_id tersebut.
        if(DB::table('tbl_cetak')->where('tahun',$year)->where('rand_ak1',$rand_ak1)->orderBy('id', 'DESC')->first())
        {
            $lastAgenda = DB::table('tbl_cetak')->where('tahun',$year)->orderBy('id', 'DESC')->first();
            $lastAgenca_inc = $lastAgenda->nomer_urut;
            return $lastAgenca_inc;

        } else{

            if(DB::table('tbl_cetak')->where('tahun',$year)->orderBy('id', 'DESC')->first())
            {
                $lastAgenda = DB::table('tbl_cetak')->where('tahun',$year)->orderBy('id', 'DESC')->first();
                $lastAgenca_inc = $lastAgenda->nomer_urut+1;
                return $lastAgenca_inc;
            }
            else {
                return 1; //Jika nol, berarti nomer agenda akan reset ke 1. (setiap ganti tahun)
            }

        }



    }



    public function addData($data)
    {
        return DB::table('tbl_cetak')->insertGetId($data);
    }


}
