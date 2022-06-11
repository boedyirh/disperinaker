<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ak1SlotWawancaraModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_slot_wawancara';
    protected $primaryKey = 'slot_wawancara_id';
    protected $guarded = ['slot_wawancara_id'];

    public function updateLibur($tanggal,$data)
    {
        // DB::table('tbl_slot_wawancara')
        // ->where('tanggal',$tanggal)
        // ->update($data);

        Ak1SlotWawancaraModel::where('tanggal',$tanggal)->update($data);
    }

}
