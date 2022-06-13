<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PejabatModel extends Model
{
    protected $table = 'tbl_pejabat';
    protected $primaryKey = 'id';
    use HasFactory;

    public function updatePejabat($data,$rand_ak1)
    {
      PejabatModel::where('rand_ak1',$rand_ak1)->update($data);
    }

    public function detailPejabat($pejabat_id)
    {
       return PejabatModel::find($pejabat_id)->get();
    }
}
