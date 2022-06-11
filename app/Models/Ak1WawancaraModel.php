<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ak1WawancaraModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_wawancara';
    protected $primaryKey = 'wawancara_id';
    protected $guarded = ['wawancara_id'];

    public function allData()
    {
        // return DB::table('tbl_wawancara')
        // ->limit(200)
        // ->get();

        return Ak1WawancaraModel::limit(200)->get();
    }

}
