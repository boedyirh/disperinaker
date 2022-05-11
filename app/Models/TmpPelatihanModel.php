<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TmpPelatihanModel extends Model
{
    use HasFactory;
    protected $table = 'tmp_ak1_pelatihan';
    protected $primaryKey = 'ak1_pelatihan_id';


    public function addPelatihan($data)
    {
    return DB::table('tmp_ak1_pelatihan')->insertGetId($data);
    }

    public function deletePelatihan($rand_ak1_pelatihan)
    {
        return DB::table('tmp_ak1_pelatihan')->where('rand_ak1_pelatihan', '=', $rand_ak1_pelatihan)->delete();
}

public function updatePelatihan($data,$rand_ak1_pelatihan)
{
    DB::table('tmp_ak1_pelatihan')
    ->where('rand_ak1_pelatihan',$rand_ak1_pelatihan)
    ->update($data);
}
}
