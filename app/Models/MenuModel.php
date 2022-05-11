<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuModel extends Model
{
    public function allData()
    {
        return DB::table('tbl_menu')
        ->where('NA',1)
        ->where('parent_id',0)
        ->orderBy('id')
        ->get();
    }
    public function allLayananData()
    {
        return DB::table('tbl_menu')
        ->where('NA',1)
        ->where('jenis','layanan')
        ->where('parent_id',0)
        ->orderBy('id')
        ->get();
    }
    public function allRekomData()
    {
        return DB::table('tbl_menu')
        ->where('NA',1)
        ->where('jenis','rekom')
        ->where('parent_id',0)
        ->orderBy('id')
        ->get();
    }
    public static function subMenu($id)
    {
        return DB::table('tbl_menu')
        ->where('NA',1)
        ->where('parent_id',$id)
        ->orderBy('id')
        ->get();
    }




    public function detailData($id_guru)
    {
        return DB::table('tbl_menu')->where('id_guru', $id_guru)->first();
    }
    public function addData($data)
    {
    DB::table('tbl_menu')->insert($data);
    }

    public function editData($id_guru,$data)
    {
        DB::table('tbl_menu')
        ->where('id_guru',$id_guru)
        ->update($data);
    }
    public function deleteData($id_guru)
    {
        DB::table('tbl_menu')
        ->where('id_guru',$id_guru)
        ->delete();
    }

}
