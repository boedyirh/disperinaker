<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PeriodeModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_periode';
    protected $primaryKey = 'periode_id';


    public function allData()
    {
        // return DB::table('tbl_periode')
        // ->get();
        return PeriodeModel::get();

    }




    public function getPeriodeAktif()
    {
        $rand_user = Auth::user()->rand_user;
        $periode = DB::table('users')
        ->where('rand_user',$rand_user)
        ->first(['periode_aktif']);
        // $periode = PeriodeModel::where('rand_user',$rand_user)->first(['periode_aktif']);
        $user_periode = $periode->periode_aktif;
        return $user_periode;
    }



    public function addData($data)
    {
    // DB::table('tbl_periode')->insert($data);
    PeriodeModel::insert($data);
    }

    public function detailData($rand_periode)
    {
        // return DB::table('tbl_periode')->where('rand_periode', $rand_periode)->first();
        return PeriodeModel::where('rand_periode', $rand_periode)->first();
    }

    public function setPeriodeAktif($periode,$id)
    {

        DB::table('users')
        ->where('id',$id)
        ->update($periode);
        // PeriodeModel::where('id',$id)->update($periode);
    }


    public function updatePeriode($rand_periode,$data)
    {
        // DB::table('tbl_periode')
        // ->where('rand_periode',$rand_periode)
        // ->update($data);
        PeriodeModel::where('rand_periode',$rand_periode)->update($data);
    }

    public function cekTerhapus($rand_periode)
    {
        // $cekTerhapus=  DB::table('tbl_periode')
        // ->where('rand_periode',$rand_periode)
        // ->first();
        $cekTerhapus = PeriodeModel::where('rand_periode',$rand_periode)->first();

        if ($cekTerhapus->NA) {
            return 1;
        } else {return 0;}
    }

    public function cekAktif($rand_periode)
    {
        // $cekAktif=  DB::table('tbl_periode')
        // ->where('rand_periode',$rand_periode)
        // ->first();
        $cekAktif = PeriodeModel::where('rand_periode',$rand_periode)
        ->first();

        if ($cekAktif->status) {
            return 1;
        } else {return 0;}
    }





}
