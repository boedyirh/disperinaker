<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimeDimensionModel extends Model
{
    use HasFactory;
    protected $table = 'time_dimension';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function updateData($db_date,$data)
    {

        DB::table('time_dimension')
        ->where('db_date',$db_date)
        ->update($data);
    }
}
