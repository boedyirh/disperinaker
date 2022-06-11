<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AplikasiModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_aplikasi';
    protected $primaryKey = 'id';


    public function detailData()
    {
        // return DB::table('tbl_aplikasi')->where('id', 1)->first();
        return AplikasiModel::where('id', 1)->first();
    }

    public function detailOPD()
    {
        // return DB::table('tbl_opd')->where('opd_id', 1)->first();
        return AplikasiModel::where('opd_id', 1)->first();
    }


    public function editData($data)
    {
        // DB::table('tbl_aplikasi')
        // ->where('id',1)
        // ->update($data);

        AplikasiModel::where('id',1)->update($data);
    }

}
