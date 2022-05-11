<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeldesaModel extends Model
{
    protected $table = 'tbl_keldesa';
    protected $primaryKey = 'id_keldesa_gabungan';
    use HasFactory;
}
