<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ak1PengajuanModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_ak1';
    protected $primaryKey = 'ak1_id';
    protected $guarded = ['ak1_id'];

    public function allData()
    {
        return DB::table('tbl_ak1')
        ->limit(200)
        ->get();
    }

}
