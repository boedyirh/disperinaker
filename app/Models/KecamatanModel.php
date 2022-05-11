<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KecamatanModel extends Model
{
    use HasFactory;
    protected $fillable = ['kecamatan_id', 'nama_kecamatan'];
    protected $table = 'tbl_kecamatan';
    protected $primaryKey = 'kecamatan_id';

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function dropdownKecamatan()
    {
        return DB::table('tbl_kecamatan')
        ->orderBy('nama_kecamatan', 'asc')
        ->get(['kecamatan_id','nama_kecamatan']);
    }



}
