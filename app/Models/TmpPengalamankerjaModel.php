<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TmpPengalamankerjaModel extends Model
{
    use HasFactory;
    protected $table = 'tmp_ak1_pekerjaan';
    protected $primaryKey = 'ak1_pekerjaan_id';


    public function addPengalamankerja($data)
    {
    return DB::table('tmp_ak1_pekerjaan')->insertGetId($data);
    }

    public function deletePengalamankerja($rand_ak1_pekerjaan)
    {
        return DB::table('tmp_ak1_pekerjaan')->where('rand_ak1_pekerjaan', '=', $rand_ak1_pekerjaan)->delete();
}

public function updatePengalamankerja($data,$rand_ak1_pekerjaan)
{
    DB::table('tmp_ak1_pekerjaan')
    ->where('rand_ak1_pekerjaan',$rand_ak1_pekerjaan)
    ->update($data);
}
}
