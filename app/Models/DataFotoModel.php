<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DataFotoModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_ak1_foto';
    protected $primaryKey = 'ak1_berkas_id';

    public function detailFoto($rand_ak1)
    {
        // return DB::table('tbl_ak1_foto')->where('rand_ak1', $rand_ak1)
        // ->get();

        return DataFotoModel::where('rand_ak1', $rand_ak1)->get();
    }

    public function addFoto($data)
    {
    // return DB::table('tbl_ak1_foto')->insertGetId($data);
    return DataFotoModel::insertGetId($data);

    }



    public function cekFoto($rand_ak1){

        if($rand_ak1){
            // $cekfoto = DB::table('tbl_ak1_foto')->where('rand_ak1', $rand_ak1)->first();
            $cekfoto = DataFotoModel::where('rand_ak1', $rand_ak1)->first();

            if (is_null($cekfoto)){
                return false;
            } else {
                return true;
            }
        }

    }

    public function updateFoto($data,$rand_ak1)
    {
        // DB::table('tbl_ak1_foto')
        // ->where('rand_ak1',$rand_ak1)
        // ->update($data);

        DataFotoModel::where('rand_ak1',$rand_ak1)->update($data);

    }

    public function clearFoto($rand_ak1)
    {

        // DB::table('tbl_ak1_foto')
        // ->where('rand_ak1',$rand_ak1)
        // ->delete();

        DataFotoModel::where('rand_ak1',$rand_ak1)->delete();

    }

}
