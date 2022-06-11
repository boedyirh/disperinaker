<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ak1Model extends Model
{
    protected $table = 'tbl_ak1';
    protected $primaryKey = 'ak1_id';
    // protected $fillable = ['name'];

    use HasFactory;

    public function addData($data)
    {

    // return DB::table('tbl_ak1')->insertGetId($data);
    return Ak1Model::insertGetId($data);

    }

    public function updateData($data,$rand_ak1)
    {

        // DB::table('tbl_ak1')
        // ->where('rand_ak1',$rand_ak1)
        // ->update($data);

        Ak1Model::findOrFail($rand_ak1)->update($data);
    }

    public function detailFoto($rand_ak1)
     {
    //     return DB::table('tbl_ak1')->where('rand_ak1', $rand_ak1)
    //     ->get();
        return Ak1Model::where('rand_ak1', $rand_ak1)->get();


    }
    public function detailFotoxx($rand_ak1)
    {
        return DB::table('tbl_ak1_foto')->where('rand_ak1', $rand_ak1)
        ->first();

        return Ak1Model::where('rand_ak1', $rand_ak1)->first();
    }

    public function clearFoto($rand_ak1)
    {
        $data = [
            'foto_ktp' => '',
            'foto_diri' => '',
        ];
        // DB::table('tbl_ak1_foto')
        // ->where('rand_ak1',$rand_ak1)
        // ->update($data);
        Ak1Model::findOrFail($rand_ak1)->update($data);

    }


    public function allData()
    {
        // return DB::table('tbl_ak1')
        // ->limit(5)
        // ->get();

        return Ak1Model::limit(5)->get();
    }



    public function detailData($rand_ak1)
    {
        // return DB::table('tbl_ak1')->where('rand_ak1', $rand_ak1)
        // ->first();
        return Ak1Model::where('rand_ak1', $rand_ak1)->first();
    }



    public function detailDataGet($rand_ak1)
    {
        // return DB::table('tbl_ak1')->where('rand_ak1', $rand_ak1)
        // ->get();

        return Ak1Model::wherewhere('rand_ak1', $rand_ak1)->get();


    }













    public function addFoto($data)
    {
    return DB::table('tbl_ak1_foto')->insertGetId($data);

    }



    public function cekFoto($rand_ak1){

        if($rand_ak1){
            $cekfoto = DB::table('tbl_ak1')->where('rand_ak1', $rand_ak1)
            ->first();
            if (is_null($cekfoto->foto_ktp)){
                return false;
            } else {
                return true;
            }

        }

    }



    public function addPekerjaan($data)
    {
    return DB::table('tbl_ak1_pekerjaan')->insertGetId($data);
    }
    public function addPendidikan($data)
    {
    return DB::table('tbl_ak1_pendidikan')->insertGetId($data);
    }
    public function addPelatihan($data)
    {
    return DB::table('tbl_ak1_pelatihan')->insertGetId($data);
    }

    public function deletePendidikan($rand_ak1_pendidikan)
        {
            return DB::table('tbl_ak1_pendidikan')->where('rand_ak1_pendidikan', '=', $rand_ak1_pendidikan)->delete();
    }

    public function updatePendidikan($data,$rand_ak1_pendidikan)
    {
        DB::table('tbl_ak1_pendidikan')
        ->where('rand_ak1_pendidikan',$rand_ak1_pendidikan)
        ->update($data);
    }

    public function deletePelatihan($rand_ak1_pelatihan)
    {
        return DB::table('tbl_ak1_pelatihan')->where('rand_ak1_pelatihan', '=', $rand_ak1_pelatihan)->delete();
}

public function updatePelatihan($data,$rand_ak1_pelatihan)
{
    DB::table('tbl_ak1_pelatihan')
    ->where('rand_ak1_pelatihan',$rand_ak1_pelatihan)
    ->update($data);
}

public function updatePekerjaan($data,$rand_ak1_pekerjaan)
{
    DB::table('tbl_ak1_pekerjaan')
    ->where('rand_ak1_pekerjaan',$rand_ak1_pekerjaan)
    ->update($data);
}

public function deletePekerjaan($rand_ak1_pekerjaan)
{
    return DB::table('tbl_ak1_pekerjaan')->where('rand_ak1_pekerjaan', '=', $rand_ak1_pekerjaan)->delete();
}




//


}
