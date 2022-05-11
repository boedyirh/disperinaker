<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DropdownModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_dropdown';

    public function getTingkatPendidikan($tingkat_pendidikan_id)
    {
        $nama_tingkat = DB::table('tbl_dropdown')
        ->where('dropdown_type','tingkat_pendidikan')
        ->where('value_dropdown',$tingkat_pendidikan_id)
        ->first();
        return $nama_tingkat;
    }

    public function getJenisPelatihan($jenis_pelatihan_id)
    {
        $nama_tingkat = DB::table('tbl_dropdown')
        ->where('dropdown_type','jenis_pelatihan')
        ->where('value_dropdown',$jenis_pelatihan_id)
        ->first();
        return $nama_tingkat;
    }
    public function getBidangUsaha($bidang_usaha_id)
    {
        $nama_tingkat = DB::table('tbl_dropdown')
        ->where('dropdown_type','bidang_usaha')
        ->where('value_dropdown',$bidang_usaha_id)
        ->first();
        return $nama_tingkat;
    }


}
