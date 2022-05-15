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
        //Check apakah sudah ada record dengan rand_id tersebut. Jika sudah ada ambil nomernya
        if(DB::table('tbl_cetak')->where('tahun',$year)->where('rand_ak1',$rand_ak1)->orderBy('id', 'DESC')->first())
        {
            $lastAgenda = DB::table('tbl_cetak')->where('tahun',$year)->orderBy('id', 'DESC')->first();

            $nomer_existing = $lastAgenda->nomer_urut;
            $tgl_ambil_existing = $lastAgenda->tgl_ambil;
            $data= [
                'nomer'=>$nomer_existing,
                'tgl_ambil' =>$tgl_ambil_existing,
            ];
            return $data;

        } else{

            if(DB::table('tbl_cetak')->where('tahun',$year)->orderBy('id', 'DESC')->first())
            {
                $lastAgenda = DB::table('tbl_cetak')->where('tahun',$year)->orderBy('id', 'DESC')->first();
                $lastAgenca_inc = $lastAgenda->nomer_urut+1;
                $data= [
                    'nomer'=>$lastAgenca_inc,
                    'tgl_ambil' =>date("Y-m-d"),
                ];

                  return $data;
            }
            else {

                $data= [
                    'nomer'=>1,
                    'tgl_ambil' =>date("Y-m-d"),
                ];
                return $data; //Jika nol, berarti nomer agenda akan reset ke 1. (setiap ganti tahun)
            }

        }



    }



    public function addData($data)
    {
        return DB::table('tbl_cetak')->insertGetId($data);
    }


}
