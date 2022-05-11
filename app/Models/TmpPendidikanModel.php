<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TmpPendidikanModel extends Model
{
    use HasFactory;
    protected $table = 'tmp_ak1_pendidikan';
    protected $primaryKey = 'ak1_pendidikan_id';


    public function addPendidikan($data)
    {
    return DB::table('tmp_ak1_pendidikan')->insertGetId($data);
    }

    public function deletePendidikan($rand_ak1_pendidikan)
    {
        return DB::table('tmp_ak1_pendidikan')->where('rand_ak1_pendidikan', '=', $rand_ak1_pendidikan)->delete();
}

public function updatePendidikan($data,$rand_ak1_pendidikan)
{
    DB::table('tmp_ak1_pendidikan')
    ->where('rand_ak1_pendidikan',$rand_ak1_pendidikan)
    ->update($data);
}
}
