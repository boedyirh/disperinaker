<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class SeksiModel extends Model
{
    public function detailData($rand_seksi)
    {
        return DB::table('tbl_seksi')->where('rand_seksi', $rand_seksi)->first();
    }

    public function allData()
    {
        return DB::table('tbl_seksi')
        ->get();
    }
    public function editDataxx($data)
    {
        DB::table('tbl_seksi')
        ->where('id',1)
        ->update($data);
    }

    public function addData($data)
    {
        $random_string = [
            'rand_seksi' => Str::random(20),
        ];
        $gabungan = array_merge($data,$random_string);
    DB::table('tbl_seksi')->insert($gabungan);
    }

    public function updateSeksi($rand_seksi,$data)
    {
        DB::table('tbl_seksi')
        ->where('rand_seksi',$rand_seksi)
        ->update($data);
    }
//Ambil Seksi dari User
    public function getSeksi($rand_seksi)
    {
        return DB::table('users')
        ->where('rand_seksi',$rand_seksi)
        ->first();
    }

}
