<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SlotWawancaraModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_slot_wawancara';
    protected $primaryKey = 'slot_wawancara_id';
    protected $guarded = ['slot_wawancara_id'];


    public function detailSlot($slot_id)
    {
        return DB::table('tbl_slot_wawancara')->where('rand_slot_wwc', $slot_id)
        ->first();
    }
    public function getSlotMingguan($tahun,$minggu_ke,$urutan)
    {
        $slot_mingguan = DB::table('tbl_slot_wawancara')
        ->where('kategori','wawancara_ak1')
        ->where('tahun',$tahun)
        ->where('minggu_ke',$minggu_ke)
        ->where('urutan',$urutan)
        ->get();
        return $slot_mingguan;
    }
    public function getAllSlotMingguan($tahun,$minggu_ke)
    {
        $slot_mingguan = DB::table('tbl_slot_wawancara')
        ->where('kategori','wawancara_ak1')
        ->where('tahun',$tahun)
        ->where('minggu_ke',$minggu_ke)
        ->get();
        return $slot_mingguan;
    }

    public function updateSlotWawancara($data,$slot_id)
    {
        DB::table('tbl_slot_wawancara')
        ->where('rand_slot_wwc',$slot_id)
        ->update($data);
    }



    public function cekSudahAmbilJadwal($rand_ak1){

        if($rand_ak1){
            $cekSdhAmbil = DB::table('tbl_slot_wawancara')->where('sudah_dipesan', $rand_ak1)
            ->first();
            if (is_null($cekSdhAmbil)){
                return false;
            } else {
                return true;
            }
        }

    }


}
