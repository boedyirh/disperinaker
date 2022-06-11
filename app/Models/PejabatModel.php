<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PejabatModel extends Model
{
    protected $table = 'tbl_pejabat';
    protected $primaryKey = 'id';
    use HasFactory;

    public function updatePejabat($data,$rand_ak1)
    {
        // DB::table('tbl_pejabat')
        // ->where('rand_ak1',$rand_ak1)
        // ->update($data);

        PejabatModel::where('rand_ak1',$rand_ak1)->update($data);
    }

    public function detailPejabat($pejabat_id)
    {
        // return DB::table('tbl_pejabat')->where('id', $pejabat_id)
        // ->get();
        return PejabatModel::find($pejabat_id)->get();
    }
}
