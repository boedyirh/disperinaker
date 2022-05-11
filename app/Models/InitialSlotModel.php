<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InitialSlotModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_slot';
    protected $primaryKey = 'slot_id';
    protected $guarded = ['slot_id'];

    public function getWaktuSlot($urutan,$kategori)
    {
        $slot_waktu = DB::table('tbl_slot')
        ->where('kategori',$kategori)
        ->where('urutan',$urutan)
        ->first();
        return $slot_waktu;
    }

    public function getAllWaktuSlot($kategori)
    {
        $slot_waktu = DB::table('tbl_slot')
        ->where('kategori',$kategori)
        ->get();
        return $slot_waktu;
    }

}
