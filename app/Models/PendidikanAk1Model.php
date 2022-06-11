<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PendidikanAk1Model extends Model
{
    use HasFactory;
    protected $table = 'tbl_ak1_pendidikan';
    protected $primaryKey = 'ak1_pendidikan_id';


    public function addPendidikan($data)
    {
    // return DB::table('tbl_ak1_pendidikan')->insertGetId($data);
    return PendidikanAk1Model::insertGetId($data);
    }

    public function deletePendidikan($rand_ak1_pendidikan)
    {
        // return DB::table('tbl_ak1_pendidikan')->where('rand_ak1_pendidikan', '=', $rand_ak1_pendidikan)->delete();
        return PendidikanAk1Model::where('rand_ak1_pendidikan', '=', $rand_ak1_pendidikan)->delete();
    }

    public function updatePendidikan($data,$rand_ak1_pendidikan)
    {
        // DB::table('tbl_ak1_pendidikan')
        // ->where('rand_ak1_pendidikan',$rand_ak1_pendidikan)
        // ->update($data);
        PendidikanAk1Model::where('rand_ak1_pendidikan',$rand_ak1_pendidikan)->update($data);
    }

    public function allData($rand_ak1)
    {
        // if(DB::table('tbl_ak1_pendidikan')->where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty())
        if(PendidikanAk1Model::where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty())
        {
            // return DB::table('tbl_ak1_pendidikan')
            // ->where('rand_ak1',$rand_ak1)
            // ->where('NA',1)
            // ->get();
            return PendidikanAk1Model::where('rand_ak1',$rand_ak1)->where('NA',1)->get();
        }
        else{
            return NULL;
        }
    }

    public function pdfData($rand_ak1)
    {
        // if(DB::table('tbl_ak1_pendidikan')->where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty())
        if(PendidikanAk1Model::where('rand_ak1',$rand_ak1)->where('NA',1)->get()->isNotEmpty())
        {
            // return DB::table('tbl_ak1_pendidikan')
            // ->where('rand_ak1',$rand_ak1)
            // ->where('NA',1)
            // ->where('dipakai',1)
            // ->get();
            return PendidikanAk1Model::where('rand_ak1',$rand_ak1)->where('NA',1)->where('dipakai',1)->get();
        }
        else{
            return NULL;
        }
    }

    public function cekSudahIsiPendidikan($rand_ak1){

        if($rand_ak1){
            // $cekSdhAmbil = DB::table('tbl_ak1_pendidikan')->where('rand_ak1', $rand_ak1)->where('NA', 1)->whereNotNull('file_pendukung')
            // ->count();
            $cekSdhAmbil  = PendidikanAk1Model::where('rand_ak1', $rand_ak1)->where('NA', 1)->whereNotNull('file_pendukung')->count();
            if ($cekSdhAmbil>0){
                return true;
            } else {
                return false;
            }
        }

    }

}
